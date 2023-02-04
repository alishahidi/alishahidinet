<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use App\Models\BotUser;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request as RequestBot;
use Spatie\Emoji\Emoji;

class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {

        $message = $this->getMessage();
        $user    = $message->getFrom();
        $user_id = $user->getId();
        $result = RequestBot::sendMessage([
            'chat_id' => $user_id,
            'text' => Emoji::CHARACTER_MAGNIFYING_GLASS_TILTED_LEFT . ' در حال برسی وضعیت اکانت شما'
        ]);
        $message_id = $result->getResult()->message_id;
        $findUser = BotUser::where('user_id', $user_id)->get()[0];
        $text = $findUser ? '.اکانت شما تایید شد.' : 'در حال ساخت اکانت جدید';
        RequestBot::editMessageText([
            'chat_id' => $user_id,
            'message_id' => $message_id,
            'text' => $text
        ]);
        if (!$findUser)
            BotUser::create([
                'user_id' => $user_id
            ]);
        RequestBot::editMessageText([
            'chat_id' => $user_id,
            'message_id' => $message_id,
            'text' => 'برسی اکانت شما با موفقیت انجام شد. خوش آمدید' . Emoji::CHARACTER_SUN
        ]);
        $text = '*سلام* ' . Emoji::CHARACTER_WAVING_HAND . PHP_EOL . PHP_EOL .
            'به ربات شخصی من خوش آمدی' . PHP_EOL .
            'میتوانید از قابلیت های مفید این ربات استفاده کنید' . PHP_EOL . PHP_EOL .
            'برخی از قابلیت های این ربات :' . PHP_EOL .
            '   *1*. فشرده سازی عکس ' . Emoji::CHARACTER_CLAMP . PHP_EOL .
            '   *2*. افزودن متن به عکس ' . Emoji::CHARACTER_A_BUTTON_BLOOD_TYPE . PHP_EOL .
            '   *3*. افزودن واتر مارک به عکس ' . Emoji::CHARACTER_SAFETY_PIN . PHP_EOL .
            '   *4*. ساخت pdf ' . Emoji::CHARACTER_PAGE_WITH_CURL . Emoji::CHARACTER_NATIONAL_PARK . PHP_EOL .
            '   *5*. فال حافظ ' . Emoji::CHARACTER_RAINBOW . PHP_EOL .
            '   *6*. تقویم ' . Emoji::CHARACTER_CALENDAR . PHP_EOL .
            '   *7*. اطلاعات کاربری ' . Emoji::CHARACTER_WOMAN . PHP_EOL .
            '   *8*. و موارد دیگر ' . PHP_EOL . PHP_EOL .
            'اطلاعات شخصی من: ' . PHP_EOL .
            '   *1*. [وبسایت](http://www.alishahidinet.ir)' . PHP_EOL .
            '   *2*. [گیت هاب](http://www.github.com/alishahidi)' . PHP_EOL .
            '   *3*. [اینستاگرام](http://www.instagram.com/alishahidi_insta)' . PHP_EOL .
            '   *4*. ایمیل: `alishahidi1376@gmail.com`' . PHP_EOL;
        $this->replyToChat($text, ['parse_mode' => 'markdown']);
        $this->telegram->executeCommand('homekeyboard');
        return RequestBot::emptyResponse();
    }
}
