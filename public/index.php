<?php
$dirSep = DIRECTORY_SEPARATOR;
$baseDir = require_once dirname(__DIR__) . "{$dirSep}vendor{$dirSep}autoload.php";
require_once dirname(__DIR__) . '/bootstrap/Bootstrap.php';
new \Bootstrap\Bootstrap();
