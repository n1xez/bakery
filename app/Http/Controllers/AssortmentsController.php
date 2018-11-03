<?php

namespace App\Http\Controllers;

use App\Models\Assortments\Assortment;

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
}