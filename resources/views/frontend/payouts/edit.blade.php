@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.payout.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payouts.update", [$payout->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.payout.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $payout->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payout.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="amount">{{ trans('cruds.payout.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $payout->amount) }}" step="0.01">
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payout.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_at">{{ trans('cruds.payout.fields.completed_at') }}</label>
                            <input class="form-control datetime" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at', $payout->completed_at) }}">
                            @if($errors->has('completed_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payout.fields.completed_at_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="commission">{{ trans('cruds.payout.fields.commission') }}</label>
                            <input class="form-control" type="number" name="commission" id="commission" value="{{ old('commission', $payout->commission) }}" step="0.01">
                            @if($errors->has('commission'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('commission') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payout.fields.commission_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection