@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.child.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.children.update", [$child->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="position_in_family">{{ trans('cruds.child.fields.position_in_family') }}</label>
                <input class="form-control {{ $errors->has('position_in_family') ? 'is-invalid' : '' }}" type="number" name="position_in_family" id="position_in_family" value="{{ old('position_in_family', $child->position_in_family) }}" step="1">
                @if($errors->has('position_in_family'))
                    <div class="invalid-feedback">
                        {{ $errors->first('position_in_family') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.position_in_family_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="full_names">{{ trans('cruds.child.fields.full_names') }}</label>
                <input class="form-control {{ $errors->has('full_names') ? 'is-invalid' : '' }}" type="text" name="full_names" id="full_names" value="{{ old('full_names', $child->full_names) }}" required>
                @if($errors->has('full_names'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_names') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.full_names_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.child.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $child->mobile) }}">
                @if($errors->has('mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.child.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $child->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.child.fields.relationship') }}</label>
                <select class="form-control {{ $errors->has('relationship') ? 'is-invalid' : '' }}" name="relationship" id="relationship" required>
                    <option value disabled {{ old('relationship', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Child::RELATIONSHIP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('relationship', $child->relationship) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('relationship'))
                    <div class="invalid-feedback">
                        {{ $errors->first('relationship') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.relationship_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="specify">{{ trans('cruds.child.fields.specify') }}</label>
                <input class="form-control {{ $errors->has('specify') ? 'is-invalid' : '' }}" type="text" name="specify" id="specify" value="{{ old('specify', $child->specify) }}">
                @if($errors->has('specify'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specify') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.specify_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.child.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Child::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $child->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_of_birth">{{ trans('cruds.child.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $child->date_of_birth) }}" required>
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="father_name_id">{{ trans('cruds.child.fields.father_name') }}</label>
                <select class="form-control select2 {{ $errors->has('father_name') ? 'is-invalid' : '' }}" name="father_name_id" id="father_name_id" required>
                    @foreach($father_names as $id => $entry)
                        <option value="{{ $id }}" {{ (old('father_name_id') ? old('father_name_id') : $child->father_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('father_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('father_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.father_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mothers_name_id">{{ trans('cruds.child.fields.mothers_name') }}</label>
                <select class="form-control select2 {{ $errors->has('mothers_name') ? 'is-invalid' : '' }}" name="mothers_name_id" id="mothers_name_id" required>
                    @foreach($mothers_names as $id => $entry)
                        <option value="{{ $id }}" {{ (old('mothers_name_id') ? old('mothers_name_id') : $child->mothers_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('mothers_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mothers_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.child.fields.mothers_name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add these scripts and styles to your HTML file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $(function () {
        // Get the current date
        const currentDate = new Date();

        // Calculate the date one year ago
        const oneYearAgo = new Date(currentDate);
        oneYearAgo.setFullYear(oneYearAgo.getFullYear() - 1);

        // Set the max date to one year ago (restrict future dates)
        const maxDate = oneYearAgo.toISOString().split('T')[0];
        $(".child-date-picker").attr("max", maxDate);

        // Set the default value for the input
        const formattedOneYearAgo = oneYearAgo.toISOString().split('T')[0];
        $(".child-date-picker").attr("value", formattedOneYearAgo);
    });
</script>

@endsection