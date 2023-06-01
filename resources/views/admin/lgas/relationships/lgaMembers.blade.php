@can('member_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.members.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.member.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.member.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-lgaMembers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.member.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.surname') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.middlename') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.mobile_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.mobile_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.date_of_birth') }}
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
                            {{ trans('cruds.member.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.lga') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.marital_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.nationality') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.state_of_origin') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.born_in_nigeria') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.place_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.employment_status') }}
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
                            <td>
                                {{ $member->id ?? '' }}
                            </td>
                            <td>
                                @if($member->image)
                                    <a href="{{ $member->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $member->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $member->title->title ?? '' }}
                            </td>
                            <td>
                                {{ $member->surname->name ?? '' }}
                            </td>
                            <td>
                                {{ $member->firstname->firstname ?? '' }}
                            </td>
                            <td>
                                {{ $member->middlename ?? '' }}
                            </td>
                            <td>
                                {{ $member->email->email ?? '' }}
                            </td>
                            <td>
                                {{ $member->mobile_1->mobile ?? '' }}
                            </td>
                            <td>
                                {{ $member->mobile_2 ?? '' }}
                            </td>
                            <td>
                                {{ $member->gender->gender ?? '' }}
                            </td>
                            <td>
                                {{ $member->date_of_birth ?? '' }}
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
                                {{ $member->state->state ?? '' }}
                            </td>
                            <td>
                                {{ $member->lga->lga ?? '' }}
                            </td>
                            <td>
                                {{ $member->marital_status->marital_status ?? '' }}
                            </td>
                            <td>
                                {{ $member->nationality->name ?? '' }}
                            </td>
                            <td>
                                {{ $member->state_of_origin->state ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $member->born_in_nigeria ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $member->born_in_nigeria ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $member->place_of_birth->state ?? '' }}
                            </td>
                            <td>
                                {{ $member->employment_status->employment_status ?? '' }}
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
  let table = $('.datatable-lgaMembers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection