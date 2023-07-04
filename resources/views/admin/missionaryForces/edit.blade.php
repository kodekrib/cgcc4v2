@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.missionaryForce.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.missionary-forces.update", [$missionaryForce->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('missionary_force') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="missionary_force" value="0">
                    <input class="form-check-input" type="checkbox" name="missionary_force" id="missionary_force" value="1" {{ $missionaryForce->missionary_force || old('missionary_force', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="missionary_force">{{ trans('cruds.missionaryForce.fields.missionary_force') }}</label>
                </div>
                @if($errors->has('missionary_force'))
                    <div class="invalid-feedback">
                        {{ $errors->first('missionary_force') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.missionaryForce.fields.missionary_force_helper') }}</span>
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