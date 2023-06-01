@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.typeOfAppoinment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.type-of-appoinments.update", [$typeOfAppoinment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="type">{{ trans('cruds.typeOfAppoinment.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $typeOfAppoinment->type) }}">
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.typeOfAppoinment.fields.type_helper') }}</span>
            </div>



            <div class="form-group">
                <label class="required" for="members_in_attendances">Member To manage the type</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('members_list') ? 'is-invalid' : '' }}" name="members_list[]" id="members_list" multiple required onchange="onManage()">
                    @foreach($memberManageAppointmentType as $id => $members_item)
                        <option value="{{ $id }}" {{ (in_array($id, old('members_list', [])) || $typeOfAppoinment->memberManageAppointmentType->contains($id)) ? 'selected' : '' }}>{{ $members_item }}</option>
                    @endforeach
                </select>
                @if($errors->has('members_list'))
                    <div class="invalid-feedback">
                        {{ $errors->first('members_list') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.members_in_attendance_helper') }}</span>
            </div>
            <div class="form-group">
                <label>Default Member</label>
                <select class="form-control {{ $errors->has('default_members_id') ? 'is-invalid' : '' }}" name="default_members_id" id="default_members_id">
                    <option value disabled {{ old('default_members_id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($memberManageAppointmentType as $key => $label)
                        @if ($typeOfAppoinment->memberManageAppointmentType->contains($key))
                            <option value="{{ $key }}" {{ old('default_members_id', $typeOfAppoinment->default_members_id) ===  $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('age_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.age_category_helper') }}</span>
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

@section('scripts')
    <script>
        var memberList = JSON.parse('{{json_encode($memberManageAppointmentType)}}'.replace(/&quot;/g,'"'));
        function onManage(){
            var list = $('#members_list').toArray().map(item => item.value);
            $('#default_members_id').empty();
            $('#default_members_id').append($('<option>', { value: '', text: '{{ trans('global.pleaseSelect') }}' }))
            $.each(memberList, (index, value) => {
                const cke = list.find(x => x === index);
                if(cke !== null && cke !== undefined){
                    $('#default_members_id').append($('<option>', { value: index, text: value }))
                }
            });
        }
    </script>

@endsection
