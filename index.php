<?php
require __DIR__ . "/vendor/autoload.php";
require_once __DIR__ .  '/src/Config.php';

use CoffeeCode\Router\Router;

$router = new Router(BASE_URL);
$router->namespace('GS3\Http\Controller');
$router->group('sale');
$router->get('/', 'SaleController:index', 'sale.index');
$router->post('/store', 'SaleController:store', 'sale.store');

$router->group('product');
$router->post('/show', 'ProductController:show', 'product.show');

$router->group('error');
$router->get("/{errcode}", "ErrorController:error");
$router->dispatch();