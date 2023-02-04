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

class HomeKeyboardCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'homekeyboard';

    /**
     * @var string
     */
    protected $description = 'منو اصلی';

    /**
     * @var string
     */
    protected $usage = '/homekeyboard';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */

    const KEYBOARD_USER_DETAILS = 'اطلاعات کاربری ' . Emoji::CHARACTER_WOMAN;
    const KEYBOARD_HELP = 'راهنما ' . Emoji::CHARACTER_NOTEBOOK_WITH_DECORATIVE_COVER;
    const KEYBOARD_COMPRESS_IMAGE = 'فشرده سازی عکس ' . Emoji::CHARACTER_CLAMP;
    const KEYBOARD_ADD_WATERMARK_TO_IMAGE = 'افزودن واتر مارک به عکس ' . Emoji::CHARACTER_SAFETY_PIN;
    const KEYBOARD_ADD_TEXT_TO_IMAGE = 'افزودن متن به عکس ' . Emoji::CHARACTER_A_BUTTON_BLOOD_TYPE;
    const KEYBOARD_BUILD_PDF = 'ساخت pdf ' . Emoji::CHARACTER_PAGE_WITH_CURL . Emoji::CHARACTER_NATIONAL_PARK;
    const KEYBOARD_FAL_HAFEZ = 'فال حافظ ' . Emoji::CHARACTER_RAINBOW;
    const KEYBOARD_CALENDER = 'تقویم ' . Emoji::CHARACTER_CALENDAR;
    const KEYBOARD_HOME = 'بازگشت به خانه ' . Emoji::CHARACTER_HOUSE_WITH_GARDEN;

    public function execute(): ServerResponse
    {
        bot_change_state($this, 'home');
        $keyboard = new Keyboard(
            [self::KEYBOARD_USER_DETAILS, self::KEYBOARD_HELP],
            [self::KEYBOARD_COMPRESS_IMAGE, self::KEYBOARD_ADD_WATERMARK_TO_IMAGE, self::KEYBOARD_ADD_TEXT_TO_IMAGE],
            [self::KEYBOARD_BUILD_PDF, self::KEYBOARD_CALENDER, self::KEYBOARD_FAL_HAFEZ]
        );
        $keyboard = $keyboard
            ->setResizeKeyboard(true)
            ->setSelective(false);
        return $this->replyToChat('انتخاب گزینه: ', [
            'reply_markup' => $keyboard,
        ]);
    }
}
