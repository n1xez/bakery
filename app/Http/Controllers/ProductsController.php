<?php

namespace App\Http\Controllers;

use App\Models\Products\Product;

/**
 * Class ProductsController
 * @package App\Http\Controllers\Products
 */
class ProductsController extends CrudController
{
    /**
     * ShopsController constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}