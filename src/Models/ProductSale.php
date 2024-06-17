<?php
namespace GS3\Models;
use CoffeeCode\DataLayer\DataLayer;

class ProductSale extends DataLayer
{
    public function __construct()
    {
        parent::__construct('product_sale', ['sale_id', 'product_id'], 'id', false);
    }
    public function showProductSales(): Sale
    {
        return (new Sale)->find('id = :sale_id', 
                                "sale_id={$this->id}",
                                "s.name, p.name, p.price, p.reference",
                                ['join' => true, 'clausure' => "s INNER JOIN product_sale ps ON ps.sale_id = s.id INNER JOIN product_supplier psp ON psp.product_id = p.id INNER JOIN supplier sp ON sp.id = psp.supplier_id"])->fetch(true);
    }

    public function add(Sale $sale, Product $product) :bool
    {
        $this->sale_id      = $sale->id;
        $this->product_id   = $product->id;
        $this->price        = $product->price;
        return $this->save();
    }
}
