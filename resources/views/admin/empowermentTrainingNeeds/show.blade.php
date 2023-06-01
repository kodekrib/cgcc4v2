@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.empowermentTrainingNeed.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empowerment-training-needs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.empowermentTrainingNeed.fields.id') }}
                        </th>
                        <td>
                            {{ $empowermentTrainingNeed->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowermentTrainingNeed.fields.training_needs') }}
                        </th>
                        <td>
                            {{ $empowermentTrainingNeed->training_needs }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empowerment-training-needs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection