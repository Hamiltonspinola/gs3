<?php
session_start();
$DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "gs3",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

define('DATA_LAYER_CONFIG', $DATA_LAYER_CONFIG);
define('BASE_URL_LOG', 'C:\xampp\htdocs\gs3\log');
define('BASE_URL', 'http://localhost/gs3');
define('BASE_URL_TEMPLATES', 'C:\xampp\htdocs\gs3\resource\views');

function url(string $uri = null): string
{
    if ($uri) {
        return BASE_URL . "/{$uri}";
    }
    return BASE_URL;
}