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
                <label for="drink_type_id">{{ trans('cruds.drink.fields.drink_type') }}</label>
                <select class="form-control select2 {{ $errors->has('drink_type') ? 'is-invalid' : '' }}" name="drink_type_id" id="drink_type_id">
                    @foreach($drink_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('drink_type_id') ? old('drink_type_id') : $drink->drink_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('drink_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('drink_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drink.fields.drink_type_helper') }}</span>
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
                <label for="after_discount">{{ trans('cruds.drink.fields.after_discount') }}</label>
                <input class="form-control {{ $errors->has('after_discount') ? 'is-invalid' : '' }}" type="number" name="after_discount" id="after_discount" value="{{ old('after_discount', $drink->after_discount) }}" step="0.01">
                @if($errors->has('after_discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('after_discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drink.fields.after_discount_helper') }}</span>
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