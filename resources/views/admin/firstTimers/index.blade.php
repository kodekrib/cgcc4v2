@extends('layouts.admin')
@section('content')
@can('first_timer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.first-timers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.firstTimer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.firstTimer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-FirstTimer">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.service') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.surname') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.middle_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.marital_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.occupation') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.age') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.residential_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.nearest_bus_stop') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.join_cgcc') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.start_ats') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.ats_mode') }}
                        </th>
                        <th>
                            {{ trans('cruds.firstTimer.fields.prayer_request') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($firstTimers as $key => $firstTimer)
                        <tr data-entry-id="{{ $firstTimer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $firstTimer->id ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->service ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->surname ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->middle_name ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->date_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->marital_status->marital_status ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->occupation ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FirstTimer::GENDER_SELECT[$firstTimer->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->age ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->email ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->residential_address ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->nearest_bus_stop ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FirstTimer::COUNTRY_SELECT[$firstTimer->country] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FirstTimer::STATE_SELECT[$firstTimer->state] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FirstTimer::CITY_SELECT[$firstTimer->city] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FirstTimer::JOIN_CGCC_SELECT[$firstTimer->join_cgcc] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FirstTimer::START_ATS_SELECT[$firstTimer->start_ats] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FirstTimer::ATS_MODE_SELECT[$firstTimer->ats_mode] ?? '' }}
                            </td>
                            <td>
                                {{ $firstTimer->prayer_request ?? '' }}
                            </td>
                            <td>
                                @can('first_timer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.first-timers.show', $firstTimer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('first_timer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.first-timers.edit', $firstTimer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('first_timer_delete')
                                    <form action="{{ route('admin.first-timers.destroy', $firstTimer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('first_timer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.first-timers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-FirstTimer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection