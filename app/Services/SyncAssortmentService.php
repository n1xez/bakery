<?php

namespace App\Services;


use Faker\Factory;
use App\Models\Shops\Shop;
use App\Models\Products\Product;
use App\Models\Assortments\Assortment;

class SyncAssortmentService
{
    /**
     * @var Assortment
     */
    private $assortment;
    /**
     * @var Factory
     */
    private $factory;

    /**
     * SyncAssortmentService constructor.
     * @param Assortment $assortment
     * @param Factory $factory
     */
    public function __construct(Assortment $assortment, Factory $factory)
    {
        $this->assortment = $assortment;
        $this->factory =  $factory::create();
    }

    /**
     *
     */
    public function handel()
    {
        $shops = Shop::all();
        $products = Product::all();
        $assortments = $this->makeAssortment($shops, $products);

        foreach ($assortments as $assortmentFields) {
            $assortment = $this->assortment->where($assortmentFields)->first();
            if (!$assortment) {
                $assortmentFields['quantity'] = $this->factory->numberBetween(0, 20);
                $assortmentFields['warning_quantity'] = $this->factory->numberBetween(5, 10);
                $this->assortment->create($assortmentFields);
            }
        }
    }

    /**
     * @param $shops
     * @param $products
     * @return \Illuminate\Support\Collection
     */
    private function makeAssortment($shops, $products)
    {
        $assortments = collect();
        foreach ($shops as $shop) {
            foreach ($products as $product) {
                $assortments->push([
                    'shop_id' => $shop->id,
                    'product_id' => $product->id,
                ]);
            }
        }

        return $assortments;
    }
}