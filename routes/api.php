<?php

use System\Router\Api\Route;

Route::get('/bot/set/{token}', 'Api\BotController@set', 'api.bot.set');
Route::get('/bot/unset/{token}', 'Api\BotController@unset', 'api.bot.unset');
Route::post('/bot/update/{token}', 'Api\BotController@update', 'api.bot.update');
