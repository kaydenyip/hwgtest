<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDrinkRequest;
use App\Http\Requests\StoreDrinkRequest;
use App\Http\Requests\UpdateDrinkRequest;
use App\Models\Drink;
use App\Models\DrinksType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DrinksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drink_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drinks = Drink::with(['barista', 'drinks_types'])->get();

        return view('admin.drinks.index', compact('drinks'));
    }

    public function create()
    {
        abort_if(Gate::denies('drink_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baristas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $drinks_types = DrinksType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.drinks.create', compact('baristas', 'drinks_types'));
    }

    public function store(StoreDrinkRequest $request)
    {
        $drink = Drink::create($request->all());

        return redirect()->route('admin.drinks.index');
    }

    public function edit(Drink $drink)
    {
        abort_if(Gate::denies('drink_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baristas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $drinks_types = DrinksType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $drink->load('barista', 'drinks_types');

        return view('admin.drinks.edit', compact('baristas', 'drink', 'drinks_types'));
    }

    public function update(UpdateDrinkRequest $request, Drink $drink)
    {
        $drink->update($request->all());

        return redirect()->route('admin.drinks.index');
    }

    public function show(Drink $drink)
    {
        abort_if(Gate::denies('drink_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drink->load('barista', 'drinks_types');

        return view('admin.drinks.show', compact('drink'));
    }

    public function destroy(Drink $drink)
    {
        abort_if(Gate::denies('drink_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drink->delete();

        return back();
    }

    public function massDestroy(MassDestroyDrinkRequest $request)
    {
        $drinks = Drink::find(request('ids'));

        foreach ($drinks as $drink) {
            $drink->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
