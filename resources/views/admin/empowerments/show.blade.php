@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.empowerment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empowerments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.id') }}
                        </th>
                        <td>
                            {{ $empowerment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.ats_membership_no') }}
                        </th>
                        <td>
                            {{ $empowerment->ats_membership_no->names ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.cooperative') }}
                        </th>
                        <td>
                            {{ App\Models\Empowerment::COOPERATIVE_SELECT[$empowerment->cooperative] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.contribution_amount') }}
                        </th>
                        <td>
                            {{ $empowerment->contribution_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.contribution_frequency') }}
                        </th>
                        <td>
                            {{ App\Models\Empowerment::CONTRIBUTION_FREQUENCY_SELECT[$empowerment->contribution_frequency] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.start_year') }}
                        </th>
                        <td>
                            {{ $empowerment->start_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.start_month') }}
                        </th>
                        <td>
                            {{ App\Models\Empowerment::START_MONTH_SELECT[$empowerment->start_month] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.business_advisory') }}
                        </th>
                        <td>
                            {{ App\Models\Empowerment::BUSINESS_ADVISORY_SELECT[$empowerment->business_advisory] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.advisory_team') }}
                        </th>
                        <td>
                            {{ $empowerment->advisory_team }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.trainings') }}
                        </th>
                        <td>
                            {{ App\Models\Empowerment::TRAININGS_SELECT[$empowerment->trainings] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.training_needs') }}
                        </th>
                        <td>
                            @foreach($empowerment->training_needs as $key => $training_needs)
                                <span class="label label-info">{{ $training_needs->training_needs }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empowerments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection