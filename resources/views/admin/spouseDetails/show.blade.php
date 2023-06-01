@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.spouseDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.spouse-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $spouseDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.title') }}
                        </th>
                        <td>
                            {{ App\Models\SpouseDetail::TITLE_SELECT[$spouseDetail->title] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.last_name') }}
                        </th>
                        <td>
                            {{ $spouseDetail->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.first_name') }}
                        </th>
                        <td>
                            {{ $spouseDetail->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.maiden_name') }}
                        </th>
                        <td>
                            {{ $spouseDetail->maiden_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.relationship') }}
                        </th>
                        <td>
                            {{ App\Models\SpouseDetail::RELATIONSHIP_SELECT[$spouseDetail->relationship] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $spouseDetail->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.wedding_anniv') }}
                        </th>
                        <td>
                            {{ $spouseDetail->wedding_anniv }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.spouse-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection