@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.drink.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.drinks.update", [$drink->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="barista_id">{{ trans('cruds.drink.fields.barista') }}</label>
                <select class="form-control select2 {{ $errors->has('barista') ? 'is-invalid' : '' }}" name="barista_id" id="barista_id">
                    @foreach($baristas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('barista_id') ? old('barista_id') : $drink->barista->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('barista'))
                    <div class="invalid-feedback">
                        {{ $errors->first('barista') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drink.fields.barista_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="drinks_types_id">{{ trans('cruds.drink.fields.drinks_types') }}</label>
                <select class="form-control select2 {{ $errors->has('drinks_types') ? 'is-invalid' : '' }}" name="drinks_types_id" id="drinks_types_id">
                    @foreach($drinks_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('drinks_types_id') ? old('drinks_types_id') : $drink->drinks_types->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('drinks_types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('drinks_types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drink.fields.drinks_types_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.drink.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $drink->price) }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drink.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_at">{{ trans('cruds.drink.fields.completed_at') }}</label>
                <input class="form-control datetime {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at', $drink->completed_at) }}">
                @if($errors->has('completed_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completed_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drink.fields.completed_at_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection