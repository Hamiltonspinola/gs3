<?php

namespace GS3\Http\Controller;

use CoffeeCode\Router\Router;
use League\Plates\Engine;
use GS3\Models\Product;

class ProductController
{
    private $templates;
    private Router $router;

    public function __construct($router)
    {
        $this->router = $router;
        $this->templates = new Engine(BASE_URL_TEMPLATES);
    }
    public function show(): void
    {
        $products = (new Product())->findNameOrReferenceOrAll((isset($_POST['value'])) ? $_POST['value'] : "");
        $arr = array();
        foreach($products as $product){
            array_push($arr, $product->data);
        }
        echo json_encode(['success' => true, 'products'=> $arr]);
    }
}