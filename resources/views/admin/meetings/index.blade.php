@extends('layouts.admin')
@section('content')
@can('meeting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.meetings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.meeting.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.meeting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Meeting">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.meeting_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.date_of_meeting') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.time_duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.meeting_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.venue') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.attendees') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.meeting_minutes') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.files') }}
                        </th>
                        <th>
                        Approval Status
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $key => $meeting)
                        <tr data-entry-id="{{ $meeting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $meeting->id ?? '' }}
                            </td>
                            <td>
                                {{ $meeting->meeting_type->types ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="#" onclick="loadDialog('{{$meeting->id }}')" >
                                        {{ trans('global.view') }}  Date List
                                </a>
                            </td>
                            <td>
                                {{ $meeting->time_duration ?? '' }}
                            </td>
                            <td>
                                {{ $meeting->meeting_title ?? '' }}
                            </td>
                            <td>
                                {{ $meeting->venue->venue_name ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="#" onclick="GetMeetingAttendee('{{$meeting->id }}')" >
                                        {{ trans('global.view') }}  Attendee List
                                </a>
                            </td>
                            <td>
                                @foreach($meeting->meeting_minutes as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach($meeting->files as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                            @if($meeting->approval_status == 0)
                                            <a class="btn btn-xs btn-secondary" >
                                                Pending
                                            </a>
                                        @endif
                                        @if($meeting->approval_status == 1)
                                            <a class="btn btn-xs btn-danger" style="color: white;">
                                                Disapproved
                                            </a>
                                        @endif
                                        @if($meeting->approval_status == 2)
                                            <a class="btn btn-xs btn-success" style="color: white;">
                                            Approved
                                            </a>
                                        @endif
                            </td>
                            <!-- <td>
                                <span style="display:none">{{ $meeting->approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $meeting->approved ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $meeting->disapproved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $meeting->disapproved ? 'checked' : '' }}>
                            </td> -->
                            <td>
                                @can('meeting_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.meetings.show', $meeting->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('meeting_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.meetings.edit', $meeting->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('meeting_delete')
                                    <form action="{{ route('admin.meetings.destroy', $meeting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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


<div class="modal fade" id="dateListmodal" tabindex="-1" role="dialog" aria-labelledby="dateListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModal">Date list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="table-responsive" style="width: 100% !important">
                    <table class="table table-bordered table-striped table-hover datatable" id="dateListTable">
                        <thead style="width: 100% !important;">
                            <tr>
                                <th>
                                    Sn
                                </th>
                                <th>
                                    Date(MM-DD-MMM)
                                </th>
                                <th>
                                    Day in a Week
                                </th>
                                <th>
                                    Time
                                </th>

                            </tr>
                        </thead>
                    </table>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary" onclick="onDelistAMember()">Delist Member</button> -->
        </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addMoreModal" tabindex="-1" role="dialog" aria-labelledby="addMoreModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMoreModal">Member list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="table-responsive" style="width: 100% !important">
                    <table class="table table-bordered table-striped table-hover datatable" id="memberListTable">
                        <thead style="width: 100% !important;">
                            <tr>
                                <th>
                                    Member Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Phone Number
                                </th>

                            </tr>
                        </thead>
                    </table>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary" onclick="onDelistAMember()">Delist Member</button> -->
        </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
@parent
<script>

    var dateListTable;
    var  tableList;
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('meeting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.meetings.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Meeting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  dateListTable =  $('#dateListTable').DataTable(
            {
                destroy: true,
                data: [],
                processing: true,
                buttons: [],
                pageLength: 10,
                responsive: true,
                columns: [
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            targets: 0,
                            render: function (data, type, full, meta) {
                                return (meta.row+ 1);
                            }
                    },
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            targets: 1,
                            render: function (data, type, full, meta) {

                                return `<span>${data.date}</span>`;
                            }
                    },
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            render: function (data, type, full, meta) {
                                return `<span>${GetDayinWeek(data.date)}</span>`;
                            }
                    },
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            render: function (data, type, full, meta) {
                                return `<span>${data.time}</span>`;
                            }
                    },
                ]

            });
            tableList =  $('#memberListTable').DataTable(
                            {
                                destroy: true,
                                processing: true,

                                data : [],
                                buttons: [

                                ],
                                processing: true,

                                columns: [

                                    {
                                        className: 'none',
                                        data: 'member_name',
                                        defaultContent: '',
                                        render: function (data, type, full, meta) {
                                            return data;
                                        }
                                    },

                                    { data: 'email', name: 'email' },
                                    { data: 'mobile', name: 'mobile' },
                                ],

                            });
})



</script>

<script>
    function GetMeetingAttendee(id){
        Get(`/admin/meetings/GetMeetingAttendee/${id}`,true).then(res => {
            tableList.clear().draw();
            tableList.rows.add(res).draw();
            $('#addMoreModal').modal('show');
            setTimeout(function(){
                tableList.columns.adjust()

            },300);
        })
    }
    function loadDialog(id){
        Get(`/admin/meetings/GetMeetingById/${id}`,true).then(res => {
            if(res == null) return;

            var dt = JSON.parse(res.date_of_meeting);
            $('#dateListmodal').modal('show');
            dateListTable.clear().draw();
            dateListTable.rows.add(dt).draw();

            setTimeout(function(){
                dateListTable.columns.adjust()

            },300);
        });

    }

    function GetDayinWeek(date){
        const weeks = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];
        var dt  = new Date(date);
        return weeks[dt.getDay()];
    }
</script>
@endsection
