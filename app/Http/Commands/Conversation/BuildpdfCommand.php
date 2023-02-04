<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * User "/survey" command
 *
 * Example of the Conversation functionality in form of a simple survey.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use App\Models\BotPhoto;
use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request as RequestBot;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Spatie\Emoji\Emoji;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

class BuildpdfCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'buildpdf';

    /**
     * @var string
     */
    protected $description = 'ساخت pdf';

    /**
     * @var string
     */
    protected $usage = '/buildpdf';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @var bool
     */
    protected $need_mysql = true;

    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * Conversation Object
     *
     * @var Conversation
     */
    protected $conversation;

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chat    = $message->getChat();
        $user    = $message->getFrom();
        $text    = trim($message->getText(true));
        $chat_id = $chat->getId();
        $user_id = $user->getId();

        // Preparing response
        $data = [
            'chat_id'      => $chat_id,
            'parse_mode' => 'markdown',
        ];

        if ($chat->isGroupChat() || $chat->isSuperGroup()) {
            // Force reply is applied by default so it can work with privacy on
            $data['reply_markup'] = Keyboard::forceReply(['selective' => true]);
        }

        // Conversation start
        $this->conversation = new Conversation($user_id, $chat_id, $this->getName());

        // Load any existing notes from this conversation
        $notes = &$this->conversation->notes;
        !is_array($notes) && $notes = [];

        // Load the current state of the conversation
        $state = $notes['state'] ?? 0;
        if ($text == trim(HomeKeyboardCommand::KEYBOARD_BUILD_PDF))
            $text = '';

        $result = RequestBot::emptyResponse();

        // Send chat action "typing..."
        RequestBot::sendChatAction([
            'chat_id' => $chat_id,
            'action'  => ChatAction::TYPING,
        ]);

        // State machine
        // Every time a step is achieved the state is updated
        switch ($state) {
            case 0:
                if ($text === '' || !is_numeric($text)) {
                    $notes['state'] = 0;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_0 . ' عدد نوع چیدمان را وارد کنید: ' . PHP_EOL . PHP_EOL .
                        '*1*. rtl' . PHP_EOL .
                        '*2*. ltr';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE . 'باید عدد چیدمان را وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['direction'] = $text;
                $notes['text'] = "";
                $text          = '';

                // No break!
            case 1:
                if ($text === '' || !is_numeric($text)) {
                    $notes['state'] = 1;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_1 . ' عدد نوع فونت وارد کنید: ' . PHP_EOL . PHP_EOL .
                        '*1*. Vazirmatn' . PHP_EOL .
                        '*2*. Robot' . PHP_EOL .
                        '*3*. Source Code Pro' . PHP_EOL .
                        '*4*. JetBrains Mono';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE . 'باید عدد فونت را وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['font'] = $text;
                $text             = '';

                // No break!
            case 2:
                if ($text === '' && !in_array($message->getType(), ['document', 'photo'], true)) {
                    $notes['state'] = 2;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_LARGE_BLUE_DIAMOND . ' متن را وارد کنید: ' . PHP_EOL . PHP_EOL .
                        'متن را میتوانید جدا جدا ارسال کنید.' . PHP_EOL .
                        'عکس های فرمت jpg, jpeg, png با کپشن پشتیبانی میشوند' . PHP_EOL .
                        'emoji موقتا پشتیبانی نمیشود' . PHP_EOL .
                        'هنگام اتمام متن از `@fi` استفاده کنید.';

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                if ($text == "@fi") {
                    ini_set('max_execution_time', '300');
                    ini_set("pcre.backtrack_limit", "5000000");
                    unset($notes['state']);
                    $filesystem = new Filesystem();
                    $defaultConfig = (new ConfigVariables())->getDefaults();
                    $fontDirs = $defaultConfig['fontDir'];
                    $defaultFontConfig = (new FontVariables())->getDefaults();
                    $fontData = $defaultFontConfig['fontdata'];
                    $mpdf = new Mpdf([
                        'mode' => 'utf-8',
                        'format' => 'A4',
                        'setAutoTopMargin' => 'stretch',
                        'autoMarginPadding' => 10,
                        'fontDir' => array_merge($fontDirs, [
                            bot_upload_path() . '/' . 'fonts'
                        ]),
                        'fontdata' => $fontData + [ // lowercase letters only in font key
                            'vazirmatn' => [
                                'R' => 'vazirmatn/medium.ttf',
                            ],
                            'roboto' => [
                                'R' => 'roboto/medium.ttf',
                            ],
                            'source_code_pro' => [
                                'R' => 'source_code_pro/medium.ttf',
                            ],
                            'jetbrains_mono' => [
                                'R' => 'jetbrains_mono/medium.ttf',
                            ],
                        ],
                    ]);
                    $mpdf->SetHTMLFooter('
<table width="100%" style="text-align: center; font-weight: regular; font-family: sorce_code_pro; margin-top: 6px; border-top: 1px solid #333;">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">@alishahidinet_bot</td>
    </tr>
</table>');
                    $mpdf->autoScriptToLang = true;
                    $mpdf->autoLangToFont = true;
                    $font = "vazirmatn";
                    switch ($notes['font']) {
                        case '1':
                            $font = 'vazirmatn';
                            break;
                        case '2':
                            $font = 'roboto';
                            break;
                        case '3':
                            $font = 'source_code_pro';
                            break;
                        case '4':
                            $font = 'jetbrains_mono';
                            break;
                    }
                    $direction = "rtl";
                    $textAlign = "right";
                    switch ($notes['direction']) {
                        case '1':
                            $direction = 'rtl';
                            $textAlign = "right";
                            $mpdf->SetDirectionality('rtl');
                            break;
                        case '2':
                            $direction = 'ltr';
                            $textAlign = "left";
                            break;
                    }
                    $css = "body{" .
                        "direction: " . $direction . ";" .
                        "text-align: " . $textAlign . " ;" .
                        "font-family: " . $font . ";" .
                        "border: 3px solid #333;" .
                        "}";
                    $html =  str_replace("\n", "<br />", $notes["text"]);
                    foreach (BotPhoto::where('user_id', $user_id)->get() as $photoRaw) {
                        $fileUrlData = "data:image/" . $photoRaw->extension . ";base64," . $photoRaw->base64_data;
                        $html = str_replace('<data:' . env('REPLACE_KEY') . ',photo:' . $photoRaw->id . '>', "<img src=" . $fileUrlData . " style=\"max-width: 80%;\" />", $html);
                        // $photoRaw->delete();
                    }
                    $mpdf->WriteHTML($css, HTMLParserMode::HEADER_CSS);
                    $mpdf->WriteHTML($html, HTMLParserMode::HTML_BODY);
                    date_default_timezone_set("Asia/Tehran");
                    $userDirectory = bot_download_path() . '/' . $chat_id . '/' . 'buildpdf';

                    if (!$filesystem->exists($userDirectory))
                        $filesystem->mkdir($userDirectory, 0777, true);
                    $fileName = $userDirectory . '/' . date("Y-m-d_h:i:sa") . '.pdf';
                    $mpdf->Output($fileName, "F");
                    $caption = 'ساخته شده توسط @alishahidinet_bot' . PHP_EOL .
                        'تاریخ: ' . date("Y-m-d h:i:sa");

                    RequestBot::sendDocument([
                        'chat_id' => $chat_id,
                        'caption' => $caption,
                        'document' => RequestBot::encodeFile($fileName)
                    ]);
                    $this->conversation->stop();


                    $filesystem->remove($fileName);
                    break;
                }
                $message_type = $message->getType();
                if (in_array($message->getType(), ['document', 'photo'], true)) {
                    $download_path = $this->telegram->getDownloadPath();
                    $doc = $message->{'get' . ucfirst($message_type)}();
                    ($message_type === 'photo') && $doc = end($doc);
                    $file_id = $doc->getFileId();
                    $file    = RequestBot::getFile(['file_id' => $file_id]);
                    if ($file->isOk() && RequestBot::downloadFile($file->getResult())) {
                        $filesystem = new Filesystem();
                        $file_path = $download_path . '/' . $file->getResult()->getFilePath();
                        $ext = pathinfo($file_path, PATHINFO_EXTENSION);
                        if (!in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
                            $data['text'] = Emoji::CHARACTER_RED_SQUARE . ' فرمت ارسال صحیح نمیباشد.';
                            RequestBot::sendMessage($data);
                            $this->conversation->update();
                            $filesystem->remove($file_path);
                            break;
                        }
                        $photo = new BotPhoto();
                        $photo->user_id = $user_id;
                        $photo->base64_data = base64_encode(file_get_contents($file_path));
                        $photo->extension = $ext;
                        $photo->save();
                        $notes['text'] .= '<br />' . '<data:' . env('REPLACE_KEY') . ',photo:' . $photo->id . '>' . '<br/>' . $message->getCaption() . '<br />';
                        $filesystem->remove($file_path);
                    }
                } else {
                    $notes['text'] .= $text . '<br/>';
                }

                $this->conversation->update();
                RequestBot::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => Emoji::CHARACTER_UP_ARROW . ' آپدیت شد.'
                ]);
                break;
        }

        return $result;
    }
}
