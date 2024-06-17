<?php

namespace GS3\Models;

use CoffeeCode\DataLayer\DataLayer;
use GS3\QueryBuilder\QueryBuilder;

class Product extends DataLayer
{
    public function __construct()
    {
        parent::__construct('product', ['name', 'reference', 'price'], 'id', false);
    }

    public function supplier(): Supplier
    {
        return (new Supplier())->find("id = :supplier_id", "supplier_id={$this->id}");
    }

    public function findNameOrReferenceOrAll(string $value = "")
    {
        $params = http_build_query(['value' => "%$value%"]);
        $terms = "p.name LIKE :value OR p.reference LIKE :value";
        if (empty($value)) {
            $terms = null;
            $params = null;
            return (new Product)->find(
                $terms,
                "{$params}",
                "p.name product, p.reference, p.price, s.name supplier, p.id",
                ['join' => false],
                ['active' => true, 'query' => "p INNER JOIN product_supplier ps ON ps.product_id=p.id INNER JOIN supplier s ON s.id=ps.supplier_id"]
            )->fetch(true);
        }
        return (new Product())->find(
            'p.name LIKE :value OR p.reference LIKE :value',
            $params,
            "p.name product, p.reference, p.price, s.name supplier",
            ['join' => true, 'clausure' => 'p INNER JOIN product_supplier ps ON ps.product_id=p.id INNER JOIN supplier s ON s.id=ps.supplier_id ']
        )->fetch(true);
    }
}
