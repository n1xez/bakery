<?php

namespace App\Http\Controllers;

use App\Models\Shops\Shop;
use App\Models\Assortments\Assortment;
use App\User;
use Illuminate\Http\Request;

/**
 * Class ShopsController
 * @package App\Http\Controllers\Shops
 */
class UsersController extends CrudController
{
    /**
     * ShopsController constructor.
     * @param User $model
     */
    public function __construct(User $model)
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
        $model = $this->model->find($id);
        if (!$model) {
            redirect()->back()->withErrors('error');
        }

        $isAdmin = $request->get('is_admin') ? true : false;
        $model->update(['is_admin' => $isAdmin]);

        return redirect(route($this->model->view . '.index'))->with('success', 'model');
    }
}