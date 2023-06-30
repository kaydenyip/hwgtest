<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppoitmentRequest;
use App\Http\Requests\StoreAppoitmentRequest;
use App\Http\Requests\UpdateAppoitmentRequest;
use App\Models\Appoitment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppoitmentsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('appoitment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Appoitment::with(['client', 'employee', 'services'])->select(sprintf('%s.*', (new Appoitment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appoitment_show';
                $editGate      = 'appoitment_edit';
                $deleteGate    = 'appoitment_delete';
                $crudRoutePart = 'appoitments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : '';
            });
            $table->editColumn('services', function ($row) {
                $labels = [];
                foreach ($row->services as $service) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'employee', 'services']);

            return $table->make(true);
        }

        return view('admin.appoitments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appoitment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        return view('admin.appoitments.create', compact('clients', 'employees', 'services'));
    }

    public function store(StoreAppoitmentRequest $request)
    {
        $appoitment = Appoitment::create($request->all());
        $appoitment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appoitments.index');
    }

    public function edit(Appoitment $appoitment)
    {
        abort_if(Gate::denies('appoitment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $appoitment->load('client', 'employee', 'services');

        return view('admin.appoitments.edit', compact('appoitment', 'clients', 'employees', 'services'));
    }

    public function update(UpdateAppoitmentRequest $request, Appoitment $appoitment)
    {
        $appoitment->update($request->all());
        $appoitment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appoitments.index');
    }

    public function show(Appoitment $appoitment)
    {
        abort_if(Gate::denies('appoitment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appoitment->load('client', 'employee', 'services');

        return view('admin.appoitments.show', compact('appoitment'));
    }

    public function destroy(Appoitment $appoitment)
    {
        abort_if(Gate::denies('appoitment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appoitment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppoitmentRequest $request)
    {
        $appoitments = Appoitment::find(request('ids'));

        foreach ($appoitments as $appoitment) {
            $appoitment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
