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

use Intervention\Image\ImageManager;
use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request as RequestBot;
use Spatie\Emoji\Emoji;
use Symfony\Component\Filesystem\Filesystem;

class CompressimageCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'compressimage';

    /**
     * @var string
     */
    protected $description = 'فشرده سازی عکس';

    /**
     * @var string
     */
    protected $usage = '/compressimage';

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
        if ($text == trim(HomeKeyboardCommand::KEYBOARD_COMPRESS_IMAGE))
            $text = '';

        $result = RequestBot::emptyResponse();

        RequestBot::sendChatAction([
            'chat_id' => $chat_id,
            'action'  => ChatAction::TYPING,
        ]);

        $filesystem = new Filesystem();

        // State machine
        // Every time a step is achieved the state is updated
        switch ($state) {
            case 0:
                if ($text === '' || !is_numeric($text) || (((int) $text) > 100 || ((int) $text) < 0)) {
                    $notes['state'] = 0;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_KEYCAP_0 . ' درصد فشرده سازی را بین 1 تا 100 وارد کنید. ';

                    if ($text !== '') {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE . 'درصد فشرده سازی را بصورت عدد وارد کنید.';
                    }

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                $notes['quality'] = (int) $text;
                $text          = '';

                // No break!
            case 1:
                if (!in_array($message->getType(), ['document', 'photo'], true) && $text !== '@fi') {
                    $notes['state'] = 1;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_LARGE_BLUE_DIAMOND . ' عکس ها را ارسال کنید. ' . PHP_EOL . PHP_EOL .
                        'فرمت ارسالی jpg, jpeg, png' . PHP_EOL .
                        'هنگام اتمام کار از `@fi` استفاده کنید.';

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                if ($text == "@fi") {
                    unset($notes['state']);
                    $this->conversation->stop();
                    $data['text'] = Emoji::CHARACTER_CHECK_MARK_BUTTON . ' عملیات پایان یافت.';
                    RequestBot::sendMessage($data);
                    break;
                }
                $message_type = $message->getType();
                $download_path = $this->telegram->getDownloadPath();
                $doc = $message->{'get' . ucfirst($message_type)}();
                ($message_type === 'photo') && $doc = end($doc);
                $file_id = $doc->getFileId();
                $file    = RequestBot::getFile(['file_id' => $file_id]);
                if ($file->isOk() && RequestBot::downloadFile($file->getResult())) {
                    $file_path = $download_path . '/' . $file->getResult()->getFilePath();
                    $ext = pathinfo($file_path, PATHINFO_EXTENSION);
                    if (!in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
                        $data['text'] = Emoji::CHARACTER_RED_SQUARE . ' فرمت ارسال صحیح نمیباشد.';
                        RequestBot::sendMessage($data);
                        $this->conversation->update();
                        $filesystem->remove($file_path);
                        break;
                    }
                    date_default_timezone_set("Asia/Tehran");
                    $userDirectory = bot_download_path() . '/' . $chat_id . '/' . 'compressimage';
                    if (!$filesystem->exists($userDirectory))
                        $filesystem->mkdir($userDirectory, 0777);
                    $fileName = $userDirectory . '/' . date("Y-m-d_h:i:sa") . '.' . $ext;
                    $driver = new ImageManager(['driver' => 'gd']);
                    $driver->make($file_path)->save($fileName, $notes['quality'], $ext);
                    $caption = Emoji::CHARACTER_CLAMP . ' فشرده شده توسط @alishahidinet_bot ' . PHP_EOL .
                        Emoji::CHARACTER_CALENDAR . ' تاریخ: ' . date("Y-m-d h:i:sa");
                    if ($message_type == 'document')
                        RequestBot::sendDocument([
                            'chat_id' => $chat_id,
                            'caption' => $caption,
                            'document' => RequestBot::encodeFile($fileName)
                        ]);
                    else
                        RequestBot::sendPhoto([
                            'chat_id' => $chat_id,
                            'caption' => $caption,
                            'photo' => RequestBot::encodeFile($fileName)
                        ]);
                    $filesystem->remove($fileName);
                    $filesystem->remove($file_path);
                }
                $this->conversation->update();
                break;
        }

        return $result;
    }
}
