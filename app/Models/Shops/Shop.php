<?php

namespace App\Models\Shops;

use App\Models\BaseModel;

class Shop extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'shops';

    /**
     * @var string
     */
    public $view = 'shops';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'address',
        'article',
    ];
}
