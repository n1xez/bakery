<?php

namespace App\Models\Products;

use App\Models\BaseModel;

class Product extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string
     */
    public $view = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'article',
    ];
}
