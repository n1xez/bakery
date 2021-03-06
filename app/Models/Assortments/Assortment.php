<?php

namespace App\Models\Assortments;

use App\Models\Activities\Activity;
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
        'yellow_quantity',
        'warning_quantity',
        'volume_production',
    ];

    public function getCountToCookAttribute()
    {
        return $this->volume_production && $this->volume_production > ($this->yellow_quantity - $this->quantity)
            ?  $this->volume_production
            : $this->yellow_quantity - $this->quantity;
    }

    public function getWarningColorAttribute()
    {
        return $this->yellow_quantity >= $this->quantity
            ? ($this->warning_quantity >= $this->quantity ? 'red' : 'yellow')
            : '';
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}