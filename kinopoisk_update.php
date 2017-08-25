<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT_PATH', __DIR__.'/');

require_once ROOT_PATH.'/autoload.php';

$service = new Services\Kinopoisk();
$service->update();
