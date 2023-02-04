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
 * Generic message command
 *
 * Gets executed when any type of message is sent.
 *
 * In this message-related context, we can handle any kind of message.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use App\Models\BotUser;
use App\Models\User;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Commands\UserCommands\FalKeyboardCommand;
use Longman\TelegramBot\Commands\UserCommands\HomeKeyboardCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class GenericmessageCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $user_id = $message->getFrom()->getId();
        $user = BotUser::where('user_id', $user_id)->get()[0];
        $state = $user->state;

        // If a conversation is busy, execute the conversation command after handling the message.
        $conversation = new Conversation(
            $message->getFrom()->getId(),
            $message->getChat()->getId()
        );

        // Fetch conversation command if it exists and execute it.
        if ($conversation->exists() && $command = $conversation->getCommand()) {
            return $this->telegram->executeCommand($command);
        }

        $text = trim($message->getText());

        if ($text === HomeKeyboardCommand::KEYBOARD_HOME) {
            return $this->telegram->executeCommand('homekeyboard');
        }

        switch ($state) {
            case 'home':
                switch ($text) {
                    case (trim(HomeKeyboardCommand::KEYBOARD_USER_DETAILS)):
                        $this->telegram->executeCommand('userdetails');
                        break;
                    case (trim(HomeKeyboardCommand::KEYBOARD_HELP)):
                        $this->telegram->executeCommand('help');
                        break;
                    case (trim(HomeKeyboardCommand::KEYBOARD_COMPRESS_IMAGE)):
                        $this->telegram->executeCommand('compressimage');
                        break;
                    case (trim(HomeKeyboardCommand::KEYBOARD_ADD_WATERMARK_TO_IMAGE)):
                        $this->telegram->executeCommand('watermarkimage');
                        break;
                    case (trim(HomeKeyboardCommand::KEYBOARD_ADD_TEXT_TO_IMAGE)):
                        $this->telegram->executeCommand('textimage');
                        break;
                    case (trim(HomeKeyboardCommand::KEYBOARD_BUILD_PDF)):
                        $this->telegram->executeCommand('buildpdf');
                        break;
                    case (trim(HomeKeyboardCommand::KEYBOARD_FAL_HAFEZ)):
                        $this->telegram->executeCommand('falkeyboard');
                        break;
                    case (trim(HomeKeyboardCommand::KEYBOARD_CALENDER)):
                        $this->telegram->executeCommand('calender');
                        break;
                }
                break;
            case 'fal':
                switch ($text) {
                    case (trim(FalKeyboardCommand::KEYBOARD_NUMBER)):
                        $this->telegram->executeCommand('falnumber');
                        break;
                    case (trim(FalKeyboardCommand::KEYBOARD_SHUFFLE)):
                        $this->telegram->executeCommand('falshuffle');
                        break;
                }
                break;
            default:
                $this->telegram->executeCommand('homekeyboard');
                break;
        }



        return Request::emptyResponse();
    }
}
