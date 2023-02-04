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

namespace Longman\TelegramBot\Commands\UserCommands;

/**
 * User "/keyboard" command
 *
 * Display a keyboard with a few buttons.
 */

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Spatie\Emoji\Emoji;

class FalKeyboardCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'falkeyboard';

    /**
     * @var string
     */
    protected $description = 'منو فال حافظ';

    /**
     * @var string
     */
    protected $usage = '/falkeyboard';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     *
     * @throws TelegramException
     */
    const KEYBOARD_SHUFFLE = ' انتخاب بر هم ریخته '.Emoji::CHARACTER_COUNTERCLOCKWISE_ARROWS_BUTTON;

    const KEYBOARD_NUMBER = ' انتخاب با شماره '.Emoji::CHARACTER_COUNTERCLOCKWISE_ARROWS_BUTTON;

    public function execute(): ServerResponse
    {
        bot_change_state($this, 'fal');
        $keyboard = new Keyboard(
            [self::KEYBOARD_NUMBER, self::KEYBOARD_SHUFFLE],
            [HomeKeyboardCommand::KEYBOARD_HOME]
        );
        $keyboard = $keyboard
            ->setResizeKeyboard(true)
            ->setSelective(false);

        return $this->replyToChat('انتخاب گزینه: ', [
            'reply_markup' => $keyboard,
        ]);
    }
}
