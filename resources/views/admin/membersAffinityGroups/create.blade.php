@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.membersAffinityGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.members-affinity-groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="affinity_group">{{ trans('cruds.membersAffinityGroup.fields.affinity_group') }}</label>
                <input class="form-control {{ $errors->has('affinity_group') ? 'is-invalid' : '' }}" type="text" name="affinity_group" id="affinity_group" value="{{ old('affinity_group', '') }}">
                @if($errors->has('affinity_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('affinity_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membersAffinityGroup.fields.affinity_group_helper') }}</span>
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
