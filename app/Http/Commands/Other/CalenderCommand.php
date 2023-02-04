<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request as RequestBot;
use Spatie\Emoji\Emoji;

class CalenderCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'calender';

    /**
     * @var string
     */
    protected $description = 'مشاهده تاریخ زمان با جزئیات';

    /**
     * @var string
     */
    protected $usage = '/calender';

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
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();

        // Send chat action "typing..."
        RequestBot::sendChatAction([
            'chat_id' => $chat_id,
            'action' => ChatAction::TYPING,
        ]);

        $response = json_decode(file_get_contents('https://api.keybit.ir/time'), true);

        function withPre($string)
        {
            return "`$string`";
        }

        $text = '------ تاریخ ------'.PHP_EOL.PHP_EOL.
            '*1*. '.Emoji::CHARACTER_TEAR_OFF_CALENDAR.' تاریخ شمسی: '.withPre($response['date']['full']['official']['iso']['en']).PHP_EOL.
            '*2*. '.Emoji::CHARACTER_TEAR_OFF_CALENDAR.' تاریخ کامل جلالی: '.withPre($response['date']['other']['gregorian']['iso']['en']).PHP_EOL.
            '*3*. '.Emoji::CHARACTER_TEAR_OFF_CALENDAR.' سال به حروف: '.withPre($response['date']['year']['name']).PHP_EOL.
            '*4*. '.Emoji::CHARACTER_TEAR_OFF_CALENDAR.' سال به عدد: '.withPre($response['date']['year']['number']['en']).PHP_EOL.
            '*5*. '.Emoji::CHARACTER_EAGLE.' حیوان سال: '.withPre($response['date']['year']['animal']).PHP_EOL.
            '*6*. '.Emoji::CHARACTER_TEAR_OFF_CALENDAR.' سال کبیسه: '.withPre($response['date']['year']['leapyear']).PHP_EOL.
            '*7*. '.Emoji::CHARACTER_LEFT_ARROW.' روز سپری شده: '.withPre($response['date']['year']['agone']['days']['en']).' ( '.withPre($response['date']['year']['agone']['percent']['en']).' )'.PHP_EOL.
            '*8*. '.Emoji::CHARACTER_RIGHT_ARROW.' روز مانده: '.withPre($response['date']['year']['left']['days']['en']).' ( '.withPre($response['date']['year']['left']['percent']['en']).' )'.PHP_EOL.
            '*9*. '.Emoji::CHARACTER_MOON_VIEWING_CEREMONY.' ماه: '.withPre($response['date']['month']['name']).PHP_EOL.
            '*10*. '.Emoji::CHARACTER_STAR.' ستاره شناسی ماه: '.withPre($response['date']['month']['asterism']).PHP_EOL.
            '*11*. '.Emoji::CHARACTER_FULL_MOON_FACE.' روز هفته: '.withPre($response['date']['weekday']['name']).PHP_EOL.PHP_EOL.
            '------ زمان ------'.PHP_EOL.PHP_EOL.
            '*1*. '.Emoji::CHARACTER_ALARM_CLOCK.' زمان در ۲۴ ساعت: '.withPre($response['time24']['full']['en']).PHP_EOL.
            '*2*. '.Emoji::CHARACTER_ALARM_CLOCK.' زمان در ۱۲ ساعت: '.withPre($response['time12']['full']['full']['en']).PHP_EOL.
            '*3*. '.Emoji::CHARACTER_GLOBE_SHOWING_ASIA_AUSTRALIA.' منطقه زمانی: '.withPre($response['timezone']['name']).' '.withPre($response['timezone']['number']['en']).PHP_EOL.
            '*4*. '.Emoji::CHARACTER_GLOBE_WITH_MERIDIANS.' مهر زمانی: '.withPre($response['timestamp']['en']).PHP_EOL.PHP_EOL.
            '------ فصل ------'.PHP_EOL.PHP_EOL.
            '*1*. '.Emoji::CHARACTER_SUNRISE_OVER_MOUNTAINS.' فصل: '.withPre($response['season']['name']).PHP_EOL.
            '*2*. '.Emoji::CHARACTER_SUNRISE_OVER_MOUNTAINS.' عدد فصل: '.withPre($response['season']['number']['en']);

        return $this->replyToChat($text, ['parse_mode' => 'markdown']);
    }
}
