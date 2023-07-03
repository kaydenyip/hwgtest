@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.payout.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payouts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.payout.fields.id') }}
                        </th>
                        <td>
                            {{ $payout->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payout.fields.name') }}
                        </th>
                        <td>
                            {{ $payout->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payout.fields.amount') }}
                        </th>
                        <td>
                            {{ $payout->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payout.fields.date') }}
                        </th>
                        <td>
                            {{ $payout->date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payouts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection