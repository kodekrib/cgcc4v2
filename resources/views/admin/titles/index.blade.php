@extends('layouts.admin')
@section('content')
@can('title_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.titles.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.title.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Title', 'route' => 'admin.titles.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.title.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Title">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.title.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.title.fields.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($titles as $key => $title)
                        <tr data-entry-id="{{ $title->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $title->id ?? '' }}
                            </td>
                            <td>
                                {{ $title->title ?? '' }}
                            </td>
                            <td>
                                @can('title_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.titles.show', $title->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('title_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.titles.edit', $title->id) }}">
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
  let table = $('.datatable-Title:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection