<?php

ini_set('display_errors', 1);

define('DSN', 'mysql:host=192.168.33.10;dbname=bbs');
define('DB_USERNAME', 'bbsadmin');
define('DB_PASSWORD', '12345678');

define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();
