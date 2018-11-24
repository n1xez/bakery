<?php

namespace App\Http\Controllers;

use App\Models\Shops\Shop;
use App\Models\Assortments\Assortment;

/**
 * Class ShopsController
 * @package App\Http\Controllers\Shops
 */
class ShopsController extends CrudController
{
    /**
     * ShopsController constructor.
     * @param Shop $model
     */
    public function __construct(Shop $model)
    {
        parent::__construct($model);
    }

    public function show($id)
    {
        $assortments = Assortment::with(['shop', 'product'])
            ->whereColumn('quantity', '<', 'yellow_quantity')
            ->where('shop_id', $id)
            ->get()
            ->sortByDesc('countToCook');

        return view('shops.detail', compact('assortments'));
    }
}