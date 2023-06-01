@extends('layouts.admin')
@section('content')
@can('missionary_force_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.missionary-forces.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.missionaryForce.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.missionaryForce.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MissionaryForce">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.missionaryForce.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.missionaryForce.fields.missionary_force') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($missionaryForces as $key => $missionaryForce)
                        <tr data-entry-id="{{ $missionaryForce->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $missionaryForce->id ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $missionaryForce->missionary_force ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $missionaryForce->missionary_force ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('missionary_force_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.missionary-forces.show', $missionaryForce->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('missionary_force_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.missionary-forces.edit', $missionaryForce->id) }}">
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
    pageLength: 100,
  });
  let table = $('.datatable-MissionaryForce:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection