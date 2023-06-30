@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appoitment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appoitments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.id') }}
                        </th>
                        <td>
                            {{ $appoitment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.client') }}
                        </th>
                        <td>
                            {{ $appoitment->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.employee') }}
                        </th>
                        <td>
                            {{ $appoitment->employee->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.start_time') }}
                        </th>
                        <td>
                            {{ $appoitment->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.finish_time') }}
                        </th>
                        <td>
                            {{ $appoitment->finish_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.price') }}
                        </th>
                        <td>
                            {{ $appoitment->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.comments') }}
                        </th>
                        <td>
                            {{ $appoitment->comments }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appoitment.fields.services') }}
                        </th>
                        <td>
                            @foreach($appoitment->services as $key => $services)
                                <span class="label label-info">{{ $services->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appoitments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection