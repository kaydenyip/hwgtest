<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDrinksTypeRequest;
use App\Http\Requests\StoreDrinksTypeRequest;
use App\Http\Requests\UpdateDrinksTypeRequest;
use App\Models\DrinksType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DrinksTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drinks_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drinksTypes = DrinksType::all();

        return view('admin.drinksTypes.index', compact('drinksTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('drinks_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drinksTypes.create');
    }

    public function store(StoreDrinksTypeRequest $request)
    {
        $drinksType = DrinksType::create($request->all());

        return redirect()->route('admin.drinks-types.index');
    }

    public function edit(DrinksType $drinksType)
    {
        abort_if(Gate::denies('drinks_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drinksTypes.edit', compact('drinksType'));
    }

    public function update(UpdateDrinksTypeRequest $request, DrinksType $drinksType)
    {
        $drinksType->update($request->all());

        return redirect()->route('admin.drinks-types.index');
    }

    public function show(DrinksType $drinksType)
    {
        abort_if(Gate::denies('drinks_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drinksTypes.show', compact('drinksType'));
    }

    public function destroy(DrinksType $drinksType)
    {
        abort_if(Gate::denies('drinks_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drinksType->delete();

        return back();
    }

    public function massDestroy(MassDestroyDrinksTypeRequest $request)
    {
        $drinksTypes = DrinksType::find(request('ids'));

        foreach ($drinksTypes as $drinksType) {
            $drinksType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
