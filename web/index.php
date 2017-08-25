<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT_PATH', realpath(__DIR__.'/..').'/');

require_once ROOT_PATH.'/autoload.php';
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$films = Models\FilmMapper::findTop10($date);
require_once ROOT_PATH.'Views/index.tpl';