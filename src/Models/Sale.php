<?php

namespace GS3\Models;

use CoffeeCode\DataLayer\DataLayer;
use GS3\Interfaces\SaleInterface;

class Sale extends DataLayer implements SaleInterface
{
    public function __construct()
    {
        parent::__construct('sale', ['delivery', 'address'], 'id', false);
    }
    public function show()
    {
        return (new Sale())->find(
            null,
            null,
            'p.name, ps.price, s.delivery, s.address, s.created_at',
            ['join' => false],
            ['active' => true, 'query' => 's INNER JOIN product_sale ps ON ps.sale_id = s.id INNER JOIN product p ON p.id = ps.product_id']
        )->fetch(true);
    }

    public function add(Sale $sale): Sale
    {
        $this->delivery         = $sale->delivery;
        $this->address          = $sale->address;
        $this->save();
        return $this;
    }
}
