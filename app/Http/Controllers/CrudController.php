<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

abstract class CrudController extends Controller
{
    /**
     * @var Model
     */
    private $model;

    /**
     * Controller constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = $this->model->all();

        return view($this->model->view . '.index', compact('models'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            abort(404, 'не нашел');
        }

        return view($this->model->view . '.detail', compact('model'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->model->view . '.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->model->create($request->all());

        return redirect(route($this->model->view . '.index'))->with('success', 'cool');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            abort(404, 'не нашел');
        }

        return view($this->model->view . '.edit', compact('model'));
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
        $model->update($request->all());

        return redirect(route($this->model->view . '.index'))->with('success', 'model');
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->delete();
        }
    }
}