<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Exception\TelegramLogException;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;
use System\Config\Config;

class BotController extends Controller
{
    private function verifyToken($token)
    {
        if ($token === Config::get('BOT_TOKEN')) {
            return true;
        }
        http_response_code(401);
        header($_SERVER['SERVER_PROTOCOL'].' 401 Unauthorized');
        $view401 = Config::get('app.ERRORS.401');
        if ($view401) {
            view($view401);
        } else {
            view('errors.401');
        }
        exit;
    }

    public function set($token)
    {
        $this->verifyToken($token);
        try {
            $telegram = new Telegram(Config::get('BOT_API_TOKEN'), Config::get('BOT_USERNAME'));
            $result = $telegram->setWebhook(Config::get('BOT_URL'));
            echo $result->getDescription();
        } catch (TelegramException $e) {
            echo $e->getMessage();
        }
    }

    public function unset($token)
    {
        $this->verifyToken($token);
        try {
            $telegram = new Telegram(Config::get('BOT_API_TOKEN'), Config::get('BOT_USERNAME'));
            $result = $telegram->deleteWebhook();
            echo $result->getDescription();
        } catch (TelegramException $e) {
            echo $e->getMessage();
        }
    }

    public function update($token)
    {
        $this->verifyToken($token);
        try {
            $telegram = new Telegram(Config::get('BOT_API_TOKEN'), Config::get('BOT_USERNAME'));
            $telegram->enableAdmins(explode(',', Config::get('BOT_ADMINS')));
            $telegram->addCommandsPaths(Config::get('bot.COMMANDS.PATHS'));
            $mysqlConf = [
                'host' => Config::get('DB_HOST'),
                'user' => Config::get('DB_USERNAME'),
                'password' => Config::get('DB_PASSWORD'),
                'database' => Config::get('DB_NAME'),
            ];
            $telegram->enableMySql($mysqlConf, 'bot_core_');
            $telegram->setDownloadPath(bot_download_path());
            $telegram->setUploadPath(bot_upload_path());
            // $telegram->enableLimiter(Config::get('bot.LIMITER'));
            $telegram->handle();
        } catch (TelegramException $e) {
            // Log telegram errors
            TelegramLog::error($e);

            // Uncomment this to output any errors (ONLY FOR DEVELOPMENT!)
            file_put_contents('test', $e);
            echo $e;
        } catch (TelegramLogException $e) {
            // Uncomment this to output log initialisation errors (ONLY FOR DEVELOPMENT!)
            file_put_contents('test1', $e);
            echo $e;
        }
    }
}
