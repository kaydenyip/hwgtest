@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.drink.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drinks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.drink.fields.id') }}
                        </th>
                        <td>
                            {{ $drink->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drink.fields.barista') }}
                        </th>
                        <td>
                            {{ $drink->barista->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drink.fields.drink_type') }}
                        </th>
                        <td>
                            {{ $drink->drink_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drink.fields.price') }}
                        </th>
                        <td>
                            {{ $drink->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drink.fields.completed_at') }}
                        </th>
                        <td>
                            {{ $drink->completed_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drink.fields.after_discount') }}
                        </th>
                        <td>
                            {{ $drink->after_discount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drinks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection