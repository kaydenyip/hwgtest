@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.drinksType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drinks-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.drinksType.fields.id') }}
                        </th>
                        <td>
                            {{ $drinksType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drinksType.fields.name') }}
                        </th>
                        <td>
                            {{ $drinksType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drinksType.fields.price') }}
                        </th>
                        <td>
                            {{ $drinksType->price }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drinks-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection