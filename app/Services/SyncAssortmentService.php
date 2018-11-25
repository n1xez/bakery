<?php

namespace App\Services;


use App\Services\Imports\ImportManager;
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
     * @var ImportManager
     */
    private $importManager;

    /**
     * @var ActivityManager
     */
    private $activityManager;

    /**
     * SyncAssortmentService constructor.
     * @param Assortment $assortment
     * @param Factory $factory
     * @param ImportManager $importManager
     * @param ActivityManager $activityManager
     */
    public function __construct(
        Assortment $assortment,
        Factory $factory,
        ImportManager $importManager,
        ActivityManager $activityManager
    ){
        $this->assortment = $assortment;
        $this->factory =  $factory::create();
        $this->importManager = $importManager;
        $this->activityManager = $activityManager;
    }

    /**
     *
     */
    public function handel()
    {
        $dishes = $this->importManager->getDishes();

        $this->createShops($dishes);
        $this->createProducts($dishes);
        $this->setAssortment($dishes);

        $this->activityManager->calculate();
    }

    private function createShops($dishes)
    {
        $oldShops = Shop::all()->pluck('article');
        $shops = $dishes->groupBy('storage')->except($oldShops);

        foreach ($shops as $article => $shop) {
            $title = $shop->first()['storageName'];
            Shop::create(compact('article', 'title'));
        }
    }

    private function createProducts($dishes)
    {
        $oldProducts = Product::all()->pluck('article');
        $products = $dishes->groupBy('product')->except($oldProducts);

        foreach ($products as $article => $product) {
            $title = $product->first()['productName'];
            Product::create(compact('article', 'title'));
        }
    }

    private function setAssortment($dishes)
    {
        foreach ($dishes as $dish) {
            $assortment = $this->getAssortment($dish['storage'], $dish['product']);
            if (!$assortment) {
                $this->createAssortment($dish['storage'], $dish['product'], $dish['quantity']);
            } else {
                $assortment->update(['quantity' => $dish['quantity']]);
            }
        }
    }

    private function getAssortment($shopArticle, $productArticle)
    {
        return $this->assortment
            ->whereHas('shop', function ($query) use($shopArticle) {
                $query->where('article', $shopArticle);
            })
            ->whereHas('product', function ($query) use($productArticle) {
                $query->where('article', $productArticle);
            })
            ->first();
    }

    private function createAssortment($shopArticle, $productArticle, $quantity)
    {
        $shop = Shop::where('article', $shopArticle)->first();
        $product = Product::where('article', $productArticle)->first();

        $prepare = [
            'shop_id' => $shop->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ];

        $this->assortment->create($prepare);
    }

    //
    //============================================================
    // TEST functions
    //============================================================
    //


    private function makeTestCase()
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