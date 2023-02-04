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

use Exception;
use Intervention\Image\Gd\Font;
use Intervention\Image\ImageManagerStatic as Image;
use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request as RequestBot;
use Spatie\Emoji\Emoji;
use Symfony\Component\Filesystem\Filesystem;

class textimageCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'textimage';

    /**
     * @var string
     */
    protected $description = 'افزودن متن به عکس';

    /**
     * @var string
     */
    protected $usage = '/textimage';

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
     *
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chat = $message->getChat();
        $user = $message->getFrom();
        $text = trim($message->getText(true));
        $chat_id = $chat->getId();
        $user_id = $user->getId();

        // Preparing response
        $data = [
            'chat_id' => $chat_id,
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
        ! is_array($notes) && $notes = [];

        // Load the current state of the conversation
        $state = $notes['state'] ?? 0;
        if ($text == trim(HomeKeyboardCommand::KEYBOARD_ADD_TEXT_TO_IMAGE)) {
            $text = '';
        }

        $result = RequestBot::emptyResponse();

        // Send chat action "typing..."
        RequestBot::sendChatAction([
            'chat_id' => $chat_id,
            'action' => ChatAction::TYPING,
        ]);

        $filesystem = new Filesystem();

        // State machine
        // Every time a step is achieved the state is updated
        switch ($state) {
            case 0:
                if ($text === '' || ! is_numeric($text)) {
                    $notes['state'] = 0;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_0.' اندازه فونت را وارد کنید.';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE.'اندازه فونت را بصورت عدد وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['size'] = (int) $text;
                $text = '';

                // No break!
            case 1:
                if ($text === '') {
                    $notes['state'] = 1;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_1.' کد رنگ را وارد کنید. #ffffff';

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['color'] = $text;
                $text = '';

                // No break!
            case 2:
                if ($text === '' || ! is_numeric($text)) {
                    $notes['state'] = 2;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_2.' عدد موقعیت متن را وارد کنید:'.PHP_EOL.PHP_EOL.
                        '*1*. top-right'.PHP_EOL.
                        '*2*. top-left'.PHP_EOL.
                        '*3*. bottom-right'.PHP_EOL.
                        '*4*. bottom-left';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE.'باید عدد موقعیت متن را وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['pos'] = $text;
                $text = '';

                // No break!
            case 3:
                if ($text === '' || ! is_numeric($text)) {
                    $notes['state'] = 3;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_3.' زاویه را وارد کنید.';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE.'زاویه را بصورت عدد وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['angle'] = (int) $text;
                $text = '';

                // No break!
            case 4:
                if ($text === '' || ! is_numeric($text)) {
                    $notes['state'] = 4;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_4.' عدد نوع فونت وارد کنید:'.PHP_EOL.PHP_EOL.
                        '*1*. Vazirmatn'.PHP_EOL.
                        '*2*. Robot'.PHP_EOL.
                        '*3*. Source Code Pro'.PHP_EOL.
                        '*4*. JetBrains Mono';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE.'باید عدد فونت را وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['font'] = $text;
                $text = '';

                // No break!

            case 5:
                if ($text === '' || ! is_numeric($text)) {
                    $notes['state'] = 5;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_5.' مقدار x را وارد کنید'.PHP_EOL.
                        'به معنی فاصله از طرفین';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE.'مقدار x را بصورت عدد وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['x'] = (int) $text;
                $text = '';

                // No break!
            case 6:
                if ($text === '' || ! is_numeric($text)) {
                    $notes['state'] = 6;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_6.' مقدار y را وارد کنید'.PHP_EOL.
                        'به معنی فاصله از طرفین';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE.'مقدار y را بصورت عدد وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['y'] = (int) $text;
                $text = '';

                // No break!
            case 7:
                if ($text === '') {
                    $notes['state'] = 7;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_7.' متن را وارد کنید.';

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['text'] = $text;
                $text = '';

                // No break!
            case 8:
                if ((! in_array($message->getType(), ['document', 'photo'], true) && $text !== '@fi') || $notes['state'] == 7) {
                    $notes['state'] = 8;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_LARGE_BLUE_DIAMOND.' عکس ها را ارسال کنید.'.PHP_EOL.PHP_EOL.
                        'فرمت ارسالی jpg, jpeg, png'.PHP_EOL.
                        'هنگام اتمام کار از `@fi` استفاده کنید.';

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                if ($text == '@fi') {
                    unset($notes['state']);
                    $this->conversation->stop();
                    $data['text'] = Emoji::CHARACTER_CHECK_MARK_BUTTON.' عملیات پایان یافت.';
                    RequestBot::sendMessage($data);
                    break;
                }

                $fontDirectory = bot_upload_path().'/'.'fonts'.'/';
                $font = $fontDirectory.'vazirmatn/medium.ttf';
                switch ($notes['font']) {
                    case '1':
                        $font = $fontDirectory.'vazirmatn/medium.ttf';
                        break;
                    case '2':
                        $font = $fontDirectory.'roboto/medium.ttf';
                        break;
                    case '3':
                        $font = $fontDirectory.'source_code_pro/medium.ttf';
                        break;
                    case '4':
                        $font = $fontDirectory.'jetbrains_mono/medium.ttf';
                        break;
                }

                $pos = 'bottom-right';
                switch ($notes['pos']) {
                    case '1':
                        $pos = 'top-right';
                        break;
                    case '2':
                        $pos = 'top-left';
                        break;
                    case '3':
                        $pos = 'bottom-right';
                        break;
                    case '4':
                        $pos = 'bottom-left';
                        break;
                }
                $message_type = $message->getType();
                $download_path = $this->telegram->getDownloadPath();
                $doc = $message->{'get'.ucfirst($message_type)}();
                ($message_type === 'photo') && $doc = end($doc);
                $file_id = $doc->getFileId();
                $file = RequestBot::getFile(['file_id' => $file_id]);
                if ($file->isOk() && RequestBot::downloadFile($file->getResult())) {
                    $file_path = $download_path.'/'.$file->getResult()->getFilePath();
                    $ext = pathinfo($file_path, PATHINFO_EXTENSION);
                    if (! in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE.' فرمت ارسال صحیح نمیباشد.';
                        RequestBot::sendMessage($data);
                        $this->conversation->update();
                        $filesystem->remove($file_path);
                        break;
                    }
                    date_default_timezone_set('Asia/Tehran');
                    $userDirectory = bot_download_path().'/'.$chat_id.'/'.'textimage';
                    if (! $filesystem->exists($userDirectory)) {
                        $filesystem->mkdir($userDirectory, 0777);
                    }
                    $fileName = $userDirectory.'/'.date('Y-m-d_h:i:sa').'.'.$ext;
                    try {
                        $bbox = imagettfbbox($notes['size'], $notes['angle'], $font, $notes['text']);
                        $width = abs($bbox[2] - $bbox[0]) - 30;
                        $height = abs($bbox[7] - $bbox[1]);
                        $fontText = new Font($notes['text']);
                        $fontText->file($font);
                        $fontText->size($notes['size']);
                        $fontText->color($notes['color']);
                        $fontText->valign('top');
                        $fontText->angle($notes['angle']);
                        Image::configure(['driver' => 'gd']);
                        $textImage = Image::canvas($width, $height);
                        $fontText->applyToImage($textImage);
                        $image = Image::make($file_path);
                        $image->insert($textImage, $pos, $notes['x'], $notes['y'])->save($fileName, format: $ext);
                    } catch (Exception $e) {
                        file_put_contents('errorlog', $e->getMessage());
                    }
                    $caption = Emoji::CHARACTER_CLAMP.' ایجاد شده توسط @alishahidinet_bot'.PHP_EOL.
                        'تاریخ: '.date('Y-m-d h:i:sa');
                    if ($message_type == 'document') {
                        RequestBot::sendDocument([
                            'chat_id' => $chat_id,
                            'caption' => $caption,
                            'document' => RequestBot::encodeFile($fileName),
                        ]);
                    } else {
                        RequestBot::sendPhoto([
                            'chat_id' => $chat_id,
                            'caption' => $caption,
                            'photo' => RequestBot::encodeFile($fileName),
                        ]);
                    }
                    $filesystem->remove($fileName);
                    $filesystem->remove($file_path);
                }
                $this->conversation->update();
                break;
        }

        return $result;
    }
}
