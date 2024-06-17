<?php
namespace GS3\Models;
use CoffeeCode\DataLayer\DataLayer;

class Supplier extends DataLayer
{
    public function __construct()
    {
        parent::__construct('supplier', ['name'], 'id', false);
    }
}
