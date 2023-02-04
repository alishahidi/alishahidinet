<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use App\Models\Fal;
use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request as RequestBot;
use Spatie\Emoji\Emoji;

class FalnumberCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'falnumber';

    /**
     * @var string
     */
    protected $description = 'فال حافظ با شماره غزل';

    /**
     * @var string
     */
    protected $usage = '/falnumber';

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
            // Remove any keyboard by default
            'reply_markup' => Keyboard::remove(['selective' => true]),
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
        if ($text == trim(FalKeyboardCommand::KEYBOARD_NUMBER))
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
                if ($text === '') {
                    $notes['state'] = 0;
                    $this->conversation->update();

                    $data['text'] = Emoji::CHARACTER_LARGE_BLUE_DIAMOND . ' شماره فال را وارد کنید:';

                    $result = RequestBot::sendMessage($data);
                    break;
                }

                unset($notes['state']);
                $this->conversation->stop();
                $fal = Fal::find((int) $text);

                if (!$fal) {
                    RequestBot::sendMessage([
                        'chat_id' => $chat_id,
                        'text' => Emoji::CHARACTER_RED_CIRCLE . " غزل پیدا نشد."
                    ]);
                    break;
                }
                $caption = Emoji::CHARACTER_NATIONAL_PARK . " غزل شماره : " . $fal->id . PHP_EOL . PHP_EOL .
                    "------ " . Emoji::CHARACTER_SPIRAL_NOTEPAD . "شعر" . Emoji::CHARACTER_SPIRAL_NOTEPAD . " ------" . PHP_EOL . PHP_EOL .
                    $fal->poem . PHP_EOL . PHP_EOL .
                    "------ " . Emoji::CHARACTER_SPARKLES . "تفسیر" . Emoji::CHARACTER_SPARKLES . " ------" . PHP_EOL . PHP_EOL .
                    $fal->interpretation . PHP_EOL . PHP_EOL .
                    '@alishahidi_bot';
                $result = RequestBot::sendAudio([
                    'chat_id' => $chat_id,
                    'caption' => $caption,
                    'audio'   => RequestBot::encodeFile(bot_fal_path($fal->id)),
                ]);
                break;
        }

        return $result;
    }
}
