@extends('layouts.admin')
@section('content')
@can('member_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.members.create') }}">
                {{-- {{ trans('global.add') }} {{ trans('cruds.member.title_singular') }} --}}
                Add Biodata
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Member', 'route' => 'admin.members.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
     {{-- {{ trans('cruds.member.title_singular') }} {{ trans('global.list') }} --}}
        My Biodata List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Member">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        {{-- <th>
                            {{ trans('cruds.member.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.image') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.member.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.member_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.middlename') }}
                        </th>
                        <th>
                            {{-- {{ trans('cruds.member.fields.maiden_name') }} --}}
                            Maiden Name
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.mobile') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.age') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.marital_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.affinity_group') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.employment_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.born_in_nigeria') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.place_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.country_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.nationality') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.state_of_origin') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.lga') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.address_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.nearest_bus_stop') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $key => $member)
                        <tr data-entry-id="{{ $member->id }}">
                            <td>

                            </td>
                            {{-- <td>
                                {{ $member->id ?? '' }}
                            </td>
                            <td>
                                @if($member->image)
                                    <a href="{{ $member->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $member->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td> --}}
                            <td>
                                {{ $member->title->title ?? '' }}
                            </td>
                            <td>
                                {{ $member->member_name ?? '' }}
                            </td>
                            <td>
                                {{ $member->middlename ?? '' }}
                            </td>
                            <td>
                                {{ $member->maiden_name ?? '' }}
                            </td>
                            <td>
                                {{ $member->mobile ?? '' }}
                            </td>
                            <td>
                                {{ $member->email ?? '' }}
                            </td>
                            <td>
                                {{ $member->date_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $member->age ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Member::GENDER_SELECT[$member->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $member->marital_status?? '' }}
                            </td>
                            <td>
                                {{ $member->affinity_group ?? '' }}
                            </td>
                            <td>
                                {{ $member->employment_status->employment_status ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $member->born_in_nigeria ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $member->born_in_nigeria ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $member->place_of_birth?? '' }}
                            </td>
                            <td>
                                {{ $member->country_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $member->nationality ?? '' }}
                            </td>
                            <td>
                                {{ $member->state_of_origin ?? '' }}
                            </td>
                            <td>
                                {{ $member->lga ?? '' }}
                            </td>
                            <td>
                                {{ $member->address_1 ?? '' }}
                            </td>
                            <td>
                                {{ $member->address_2 ?? '' }}
                            </td>
                            <td>
                                {{ $member->nearest_bus_stop ?? '' }}
                            </td>
                            <td>
                                @can('member_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.members.show', $member->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('member_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.members.edit', $member->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('member_delete')
                                    <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('member_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.members.massDestroy') }}",
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
    order: [[ 4, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Member:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
