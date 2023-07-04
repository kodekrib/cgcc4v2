@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.child.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.children.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.id') }}
                        </th>
                        <td>
                            {{ $child->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.position_in_family') }}
                        </th>
                        <td>
                            {{ $child->position_in_family }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.full_names') }}
                        </th>
                        <td>
                            {{ $child->full_names }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.mobile') }}
                        </th>
                        <td>
                            {{ $child->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.email') }}
                        </th>
                        <td>
                            {{ $child->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.relationship') }}
                        </th>
                        <td>
                            {{ App\Models\Child::RELATIONSHIP_SELECT[$child->relationship] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.specify') }}
                        </th>
                        <td>
                            {{ $child->specify }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Child::GENDER_SELECT[$child->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $child->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.father_name') }}
                        </th>
                        <td>
                            {{ $child->father_name->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.mothers_name') }}
                        </th>
                        <td>
                            {{ $child->mothers_name->member_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.children.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection