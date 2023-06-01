@can('affinity_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.affinity-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.affinityGroup.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.affinityGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-headOfGroupAffinityGroups">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.affinity_group') }}
                        </th>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.affinity_group_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.criteria') }}
                        </th>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.head_of_group') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($affinityGroups as $key => $affinityGroup)
                        <tr data-entry-id="{{ $affinityGroup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $affinityGroup->id ?? '' }}
                            </td>
                            <td>
                                {{ $affinityGroup->affinity_group ?? '' }}
                            </td>
                            <td>
                                {{ $affinityGroup->affinity_group_code ?? '' }}
                            </td>
                            <td>
                                {{ $affinityGroup->criteria ?? '' }}
                            </td>
                            <td>
                                {{ $affinityGroup->head_of_group->name ?? '' }}
                            </td>
                            <td>
                                {{ $affinityGroup->head_of_group->firstname ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AffinityGroup::STATUS_SELECT[$affinityGroup->status] ?? '' }}
                            </td>
                            <td>
                                @can('affinity_group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.affinity-groups.show', $affinityGroup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('affinity_group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.affinity-groups.edit', $affinityGroup->id) }}">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-headOfGroupAffinityGroups:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection