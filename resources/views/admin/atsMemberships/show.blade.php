@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.atsMembership.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ats-memberships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembership.fields.id') }}
                        </th>
                        <td>
                            {{ $atsMembership->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembership.fields.ats_membership_number') }}
                        </th>
                        <td>
                            {{ $atsMembership->ats_membership_number->names ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ats-memberships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection