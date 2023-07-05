@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.drinksType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.drinks-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.drinksType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drinksType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.drinksType.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.drinksType.fields.price_helper') }}</span>
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