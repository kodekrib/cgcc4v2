@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cihCentersInspection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cih-centers-inspections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cihCentersInspection.fields.id') }}
                        </th>
                        <td>
                            {{ $cihCentersInspection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihCentersInspection.fields.date_of_inspection') }}
                        </th>
                        <td>
                            {{ $cihCentersInspection->date_of_inspection }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihCentersInspection.fields.center_visited') }}
                        </th>
                        <td>
                            {{ $cihCentersInspection->center_visited->cih_centre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihCentersInspection.fields.summary_of_visit') }}
                        </th>
                        <td>
                            {!! $cihCentersInspection->summary_of_visit !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cih-centers-inspections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection