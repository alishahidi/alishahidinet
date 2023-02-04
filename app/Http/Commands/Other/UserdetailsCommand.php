<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\UserProfilePhotos;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Spatie\Emoji\Emoji;

class UserdetailsCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'userdetails';

    /**
     * @var string
     */
    protected $description = 'دریافت اطلاعات کاربری';

    /**
     * @var string
     */
    protected $usage = '/userdetails';

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

        $from       = $message->getFrom();
        $user_id    = $from->getId();
        $chat_id    = $message->getChat()->getId();
        $message_id = $message->getMessageId();

        $data = [
            'chat_id'             => $chat_id,
            'reply_to_message_id' => $message_id,
            'parse_mode' => 'markdown',
        ];

        // Send chat action "typing..."
        Request::sendChatAction([
            'chat_id' => $chat_id,
            'action'  => ChatAction::TYPING,
        ]);

        function withPre($string)
        {
            return "`$string`";
        }

        $caption = '*1*. ' . Emoji::CHARACTER_ID_BUTTON . ' آیدی: ' . withPre($user_id) . PHP_EOL .
            '*2*. ' . Emoji::CHARACTER_BUST_IN_SILHOUETTE . ' نام: ' . withPre($from->getFirstName()) . PHP_EOL .
            '*3*. ' . Emoji::CHARACTER_BUSTS_IN_SILHOUETTE . ' نام خانوادگی: ' . withPre($from->getLastName()) . PHP_EOL .
            '*4*. ' . Emoji::CHARACTER_IDENTIFICATION_CARD . ' نام کاربری: ' . withPre($from->getUsername()) . PHP_EOL .
            '*5*. ' . Emoji::CHARACTER_GEM_STONE . ' اکانت پرمیوم: ' . ($from->getIsPremium() ? 'دارد' : 'ندارد') . PHP_EOL .
            '*6*. ' . Emoji::CHARACTER_BUSTS_IN_SILHOUETTE . ' کد زبانی: ' . withPre($from->getLanguageCode());

        // Fetch the most recent user profile photo
        $limit  = 1;
        $offset = null;

        $user_profile_photos_response = Request::getUserProfilePhotos([
            'user_id' => $user_id,
            'limit'   => $limit,
            'offset'  => $offset,
        ]);

        if ($user_profile_photos_response->isOk()) {
            /** @var UserProfilePhotos $user_profile_photos */
            $user_profile_photos = $user_profile_photos_response->getResult();

            if ($user_profile_photos->getTotalCount() > 0) {
                $photos = $user_profile_photos->getPhotos();

                // Get the best quality of the profile photo
                $photo   = end($photos[0]);
                $file_id = $photo->getFileId();

                $data['photo']   = $file_id;
                $data['caption'] = $caption;

                return Request::sendPhoto($data);
            }
        }

        // No Photo just send text
        $data['text'] = $caption;

        return Request::sendMessage($data);
    }
}
