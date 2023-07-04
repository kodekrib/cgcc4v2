@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mailing.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mailings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mailing.fields.id') }}
                        </th>
                        <td>
                            {{ $mailing->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailing.fields.job_mailing_list') }}
                        </th>
                        <td>
                            {{ App\Models\Mailing::JOB_MAILING_LIST_SELECT[$mailing->job_mailing_list] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailing.fields.area_of_specialization') }}
                        </th>
                        <td>
                            {{ $mailing->area_of_specialization->area_of_specialization ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailing.fields.job_level') }}
                        </th>
                        <td>
                            {{ $mailing->job_level->job_level ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mailings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection