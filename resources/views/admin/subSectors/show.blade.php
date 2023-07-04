@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subSector.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-sectors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subSector.fields.id') }}
                        </th>
                        <td>
                            {{ $subSector->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subSector.fields.name') }}
                        </th>
                        <td>
                            {{ $subSector->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subSector.fields.industry') }}
                        </th>
                        <td>
                            {{ $subSector->industry->industry ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-sectors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection