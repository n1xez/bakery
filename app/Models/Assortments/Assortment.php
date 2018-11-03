<?php

namespace App\Models\Assortments;

use App\Models\BaseModel;
use App\Models\Products\Product;
use App\Models\Shops\Shop;

class Assortment extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'assortments';

    /**
     * @var string
     */
    public $view = 'assortments';

    /**
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'product_id',
        'quantity',
        'warning_quantity',
    ];

    public function getCountToCookAttribute()
    {
        return $this->warning_quantity - $this->quantity;
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}