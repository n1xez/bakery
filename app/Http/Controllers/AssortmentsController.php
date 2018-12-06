<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function index()
    {
        if ($this->model->canNotUseModel) {
            abort(401, 'Залогинтесь');
        }
        $query = $this->model->newQuery();

        $shop_id = app(Request::class)->get('shop_id');
        if ($shop_id) {
            $query->where('shop_id', $shop_id);
        }

        $models = $query->get();

        return view($this->model->view . '.index', compact('models'));
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