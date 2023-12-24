<?php
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/libs/phpexcel/BasicExcel/Reader.php');
\BasicExcel\Reader::registerAutoloader();

foreach (glob("src/*.php") as $filename) {
    include $filename;
}
date_default_timezone_set("UTC");

function getConnection()
{
    $database = DbManager::getInstance();
    return $database->getConnection();
}
$router = new Router();
$router->proccess();
