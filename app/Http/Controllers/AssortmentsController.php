<?php

namespace App\Http\Controllers;

use App\Models\Assortments\Assortment;
use Illuminate\Http\Request;

/**
 * Class AssortmentsController
 * @package App\Http\Controllers\Assortments
 */
class AssortmentsController extends CrudController
{
    /**
     * ShopsController constructor.
     * @param Assortment $model
     */
    public function __construct(Assortment $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'yellow_quantity' => 'min:0|gte:warning_quantity',
            'warning_quantity' => 'min:0',
        ]);

        return parent::update($request, $id);
    }
}