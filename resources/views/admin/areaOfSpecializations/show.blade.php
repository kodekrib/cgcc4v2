@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.areaOfSpecialization.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.area-of-specializations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.areaOfSpecialization.fields.id') }}
                        </th>
                        <td>
                            {{ $areaOfSpecialization->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.areaOfSpecialization.fields.area_of_specialization') }}
                        </th>
                        <td>
                            {{ $areaOfSpecialization->area_of_specialization }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.area-of-specializations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection