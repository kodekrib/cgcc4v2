@can('mountains_of_influence_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mountains-of-influences.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mountainsOfInfluence.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.mountainsOfInfluence.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-mountainLeaderMountainsOfInfluences">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.nation') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.corresponding_mountain') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.prevailing_culture') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.counter_culture') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.counter_culture_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.attributes_of_christ') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.motivational_gifts') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.mountain_leader') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mountainsOfInfluences as $key => $mountainsOfInfluence)
                        <tr data-entry-id="{{ $mountainsOfInfluence->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $mountainsOfInfluence->id ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->nation ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->corresponding_mountain ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->prevailing_culture ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->counter_culture ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->counter_culture_text ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->attributes_of_christ ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->motivational_gifts ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->mountain_leader->name ?? '' }}
                            </td>
                            <td>
                                {{ $mountainsOfInfluence->mountain_leader->firstname ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\MountainsOfInfluence::STATUS_SELECT[$mountainsOfInfluence->status] ?? '' }}
                            </td>
                            <td>
                                @can('mountains_of_influence_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.mountains-of-influences.show', $mountainsOfInfluence->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('mountains_of_influence_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.mountains-of-influences.edit', $mountainsOfInfluence->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('mountains_of_influence_delete')
                                    <form action="{{ route('admin.mountains-of-influences.destroy', $mountainsOfInfluence->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('mountains_of_influence_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mountains-of-influences.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-mountainLeaderMountainsOfInfluences:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection