@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.interest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.interests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.interest.fields.id') }}
                        </th>
                        <td>
                            {{ $interest->id }}
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.interest.fields.interests') }}
                        </th>
                        <td>
                            @foreach($interest->interests as $key => $interests)
                                <span class="label label-info">{{ $interests->sports }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.interest.fields.other_sports') }}
                        </th>
                        <td>
                            {{ $interest->other_sports }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.interest.fields.social_causes') }}
                        </th>
                        <td>
                            {{ $interest->social_causes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.interest.fields.entrepreneurial_interests') }}
                        </th>
                        <td>
                            {{ $interest->entrepreneurial_interests }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.interest.fields.industry_sector') }}
                        </th>
                        <td>
                            {{ $interest->industry_sector->industry ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.interests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection