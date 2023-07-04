@extends('layouts.admin')
@section('content')
@can('empowerment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.empowerments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.empowerment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.empowerment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Empowerment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.ats_membership_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.ats_membership_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.cooperative') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.contribution_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.contribution_frequency') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.start_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.start_month') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.business_advisory') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.advisory_team') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.trainings') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.training_needs') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empowerments as $key => $empowerment)
                        <tr data-entry-id="{{ $empowerment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $empowerment->id ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->ats_membership_no->names ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->ats_membership_no->ats_membership_no ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Empowerment::COOPERATIVE_SELECT[$empowerment->cooperative] ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->contribution_amount  ?? 'N/A' }}
                            </td>
                            <td>
                                {{ App\Models\Empowerment::CONTRIBUTION_FREQUENCY_SELECT[$empowerment->contribution_frequency] ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $empowerment->start_year ?? 'N/A' }}
                            </td>
                            <td>
                                {{ App\Models\Empowerment::START_MONTH_SELECT[$empowerment->start_month] ?? 'N/A' }}
                            </td>
                            <td>
                                {{ App\Models\Empowerment::BUSINESS_ADVISORY_SELECT[$empowerment->business_advisory] ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->advisory_team ?? 'N/A' }}
                            </td>
                            <td>
                                {{ App\Models\Empowerment::TRAININGS_SELECT[$empowerment->trainings] ?? '' }}
                            </td>
                            <td>
                                @foreach($empowerment->training_needs as $key => $item)
                                    <span class="badge badge-info">{{ $item->training_needs }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('empowerment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.empowerments.show', $empowerment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('empowerment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.empowerments.edit', $empowerment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Empowerment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
