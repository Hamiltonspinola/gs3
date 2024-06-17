<?php
namespace GS3\Interfaces;

use GS3\Models\Product;
use GS3\Models\Sale;

interface SaleInterface
{
   public function show();
   public function add(Sale $sale): Sale;
}