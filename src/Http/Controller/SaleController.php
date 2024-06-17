<?php

namespace GS3\Http\Controller;

use CoffeeCode\Router\Router;
use GS3\Models\Product;
use GS3\Models\ProductSale;
use GS3\Models\Sale;
use League\Plates\Engine;

class SaleController
{
    private $templates;
    private Router $router;

    public function __construct($router)
    {
        $this->router = $router;
        $this->templates = new Engine(BASE_URL_TEMPLATES);
    }
    public function index(): void
    {
        $sales = (new Sale())->show();
        $templates = $this->templates->render('sale/index', ['sales'=>$sales]);
        echo $templates;
    }
    public function store()
    {
        $sale = new Sale();
        $sale->address = "$_POST[endereco] $_POST[bairro] $_POST[cidade] $_POST[uf]";
        $sale->delivery = $_POST['dataVenda'];
        $sale = $sale->add($sale);
        foreach ($_POST['produtos'] as $key => $value) {
            $product = (new Product())->findById($value['id']);
            $productSale = (new ProductSale())->add($sale, $product);
        }
        echo json_encode(['status' => 'success', 'msg' => "Venda realizada com sucesso!"]);
        die();
    }
}
