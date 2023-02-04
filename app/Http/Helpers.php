<?php

use App\Models\BotUser;
use System\Config\Config;

function errorClass($name)
{
    return errorExists($name) ? 'is-invalid' : null;
}

function errorText($name)
{
    return errorExists($name) ? '<div><small class="text-danger">' . error($name) . '</small></div>' : null;
}

function sidebarActive($routeName, $contain = false)
{
    return equalUrl(route($routeName), $contain) ? 'active' : null;
}

function navActive($routeName)
{
    return equalUrl(route($routeName)) ? 'active' : null;
}

function sidebarAngle($routeName, $contain = true)
{
    return equalUrl(route($routeName), $contain) ? 'bi-chevron-down' : 'bi-chevron-left';
}

function sidebarLinkActive($routeName)
{
    return equalUrl(route($routeName)) ? 'sidebar-link-active' : null;
}

function sidebarDropDownActive($routeNames, $contain = false)
{
    foreach ($routeNames as $routeName) {
        if (equalUrl(route($routeName), $contain)) {
            return 'sidebar-group-link-active';
        }
    }

    return null;
}

function trim_url($url)
{
    return '/' . str_replace(currentDomain() . '/', '', $url);
}

if (!function_exists('bot_download_path')) {
    function bot_download_path()
    {
        return dirname(Config::get('app.BASE_DIR')) . '/' . 'bot' . '/' . 'download';
    }
}

if (!function_exists('bot_upload_path')) {
    function bot_upload_path()
    {
        return dirname(Config::get('app.BASE_DIR')) . '/' . 'bot' . '/' . 'upload';
    }
}

if (!function_exists('bot_fal_path')) {
    function bot_fal_path($number)
    {
        $number = str_pad($number, 3, '0', STR_PAD_LEFT);
        $prefix = 'Hafez - ';
        $suffix = '.mp3';
        $fullName = $prefix . $number . $suffix;
        return bot_upload_path() . '/' . 'fal' . '/' . $fullName;
    }
}

if (!function_exists('bot_change_state')) {
    function bot_change_state($telegram, $state)
    {
        $message = $telegram->getMessage();
        $user_id = $message->getFrom()->getId();
        $user = BotUser::where('user_id', $user_id)->get()[0];
        $user->state = $state;
        $user->save();
        return true;
    }
}

if (!function_exists('bot_check_state')) {
    function bot_check_state($telegram, $state)
    {
        $message = $telegram->getMessage();
        $user_id = $message->getFrom()->getId();
        $user = BotUser::where('user_id', $user_id)->get()[0];
        return $user->state === $state ? true : false;
    }
}
