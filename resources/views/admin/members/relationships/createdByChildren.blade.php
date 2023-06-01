@can('child_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.children.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.child.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.child.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-createdByChildren">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.child.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.position_in_family') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.full_names') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.mobile') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.relationship') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.specify') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.father_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.child.fields.mothers_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($children as $key => $child)
                        <tr data-entry-id="{{ $child->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $child->id ?? '' }}
                            </td>
                            <td>
                                {{ $child->position_in_family ?? '' }}
                            </td>
                            <td>
                                {{ $child->full_names ?? '' }}
                            </td>
                            <td>
                                {{ $child->mobile ?? '' }}
                            </td>
                            <td>
                                {{ $child->email ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Child::RELATIONSHIP_SELECT[$child->relationship] ?? '' }}
                            </td>
                            <td>
                                {{ $child->specify ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Child::GENDER_SELECT[$child->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $child->date_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $child->father_name->member_name ?? '' }}
                            </td>
                            <td>
                                {{ $child->mothers_name->member_name ?? '' }}
                            </td>
                            <td>
                                @can('child_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.children.show', $child->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('child_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.children.edit', $child->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('child_delete')
                                    <form action="{{ route('admin.children.destroy', $child->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('child_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.children.massDestroy') }}",
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
    pageLength: 50,
  });
  let table = $('.datatable-createdByChildren:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection