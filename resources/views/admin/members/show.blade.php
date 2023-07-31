@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.member.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.member.fields.id') }}
                        </th>
                        <td>
                            {{ $member->id }}
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.member.fields.image') }}
                        </th>
                        <td>
                            @if($member->image)
                                <a href="{{ $member->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $member->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.title') }}
                        </th>
                        <td>
                            {{ $member->title->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.member_name') }}
                        </th>
                        <td>
                            {{ $member->member_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.middlename') }}
                        </th>
                        <td>
                            {{ $member->middlename }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.maiden_name') }}
                        </th>
                        <td>
                            {{ $member->maiden_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.mobile') }}
                        </th>
                        <td>
                            {{ $member->mobile??'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <td>
                            {{ $member->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $member->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.age') }}
                        </th>
                        <td>
                            {{ $member->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Member::GENDER_SELECT[$member->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.marital_status') }}
                        </th>
                        <td>
                            {{ App\Models\Member::MARITAL_STATUS_SELECT[$member->marital_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.employment_status') }}
                        </th>
                        <td>
                            {{ $member->employment_status->employment_status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.born_in_nigeria') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $member->born_in_nigeria ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.place_of_birth') }}
                        </th>
                        <td>
                        {{ $member->place_of_birth ?? 'N/A' }}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.country_of_birth') }}
                        </th>
                        <td>
                            {{ $member->country_of_birth ?? 'N/A' }}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.nationality') }}
                        </th>
                        <td>
                        {{ $member->nationality ?? 'N/A' }}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.state_of_origin') }}
                        </th>
                        <td>
                        {{ $member->state_of_origin ?? 'N/A' }}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.lga') }}
                        </th>
                        <td>
                            {{ $member->lga ?? 'N/A' }}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.address_1') }}
                        </th>
                        <td>
                            {{ $member->address_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.address_2') }}
                        </th>
                        <td>
                            {{ $member->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.nearest_bus_stop') }}
                        </th>
                        <td>
                            {{ $member->nearest_bus_stop }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.affinity_group') }}
                        </th>
                        <td>
                            {{ $member->affinity_group }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#created_by_children" role="tab" data-toggle="tab">
                {{ trans('cruds.child.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#created_by_members_affinity_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.membersAffinityGroup.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#father_name_children" role="tab" data-toggle="tab">
                {{ trans('cruds.child.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#mothers_name_children" role="tab" data-toggle="tab">
                {{ trans('cruds.child.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#members_in_attendance_attendance_managements" role="tab" data-toggle="tab">
                {{ trans('cruds.attendanceManagement.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="created_by_children">
            @includeIf('admin.members.relationships.createdByChildren', ['children' => $member->createdByChildren])
        </div>
        <div class="tab-pane" role="tabpanel" id="created_by_members_affinity_groups">
            @includeIf('admin.members.relationships.createdByMembersAffinityGroups', ['membersAffinityGroups' => $member->createdByMembersAffinityGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="father_name_children">
            @includeIf('admin.members.relationships.fatherNameChildren', ['children' => $member->fatherNameChildren])
        </div>
        <div class="tab-pane" role="tabpanel" id="mothers_name_children">
            @includeIf('admin.members.relationships.mothersNameChildren', ['children' => $member->mothersNameChildren])
        </div>
        <div class="tab-pane" role="tabpanel" id="members_in_attendance_attendance_managements">
            @includeIf('admin.members.relationships.membersInAttendanceAttendanceManagements', ['attendanceManagements' => $member->membersInAttendanceAttendanceManagements])
        </div>
    </div>
</div>

@endsection
