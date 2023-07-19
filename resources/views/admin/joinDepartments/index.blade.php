@extends('layouts.admin')
@section('content')
@can('join_department_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.join-departments.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.joinDepartment.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{-- {{ trans('cruds.joinDepartment.title_singular') }} {{ trans('global.list') }} --}}
        <h4>Department: {{ Auth::user()->department->department_name ?? 'No Department' }}</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <ul class="nav nav-tabs" id="myTab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#membersList" role="tab"
                        style="color: black !important;">{{ trans('cruds.joinDepartment.title_singular') }}
                        {{ trans('global.list') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#membersDelist" role="tab"
                        style="color: black !important;">Delisted Member</a>
                </li>

            </ul>

            <div class="tab-content" style="padding-top: 30px;">
                <div class="tab-pane active" id="membersList" role="tabpanel">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-JoinDepartment">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                {{-- <th>
                                    {{ trans('cruds.joinDepartment.fields.id') }}
                                </th> --}}

                                <th style="width: 150px">
                                    {{ trans('cruds.joinDepartment.fields.member_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.member_Email') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.member_phoneNumber') }}
                                </th>


                                <th>
                                    {{ trans('cruds.joinDepartment.fields.department') }}
                                </th>
                                {{-- <th>
                                    {{ trans('cruds.department.fields.department_email') }}
                                </th> --}}
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.member_type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.primary_function') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.approval_status') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.delisted') }}
                                </th>

                                </th>
                                <!-- <th>
                                    {{ trans('cruds.joinDepartment.fields.reason') }}
                                </th> -->
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($joinDepartmentsList as $key => $joinDepartment)
                            <tr data-entry-id="{{ $joinDepartment->id }}">
                                <td>

                                </td>
                                {{-- <td>
                                    {{ $joinDepartment->id ?? '' }}
                                </td> --}}


                                <td style="width: 150px">
                                    {{ $joinDepartment->member->member_name ?? '' }}
                                </td>
                                <td>
                                    {{ $joinDepartment->member->email ?? '' }}
                                </td>
                                <td>
                                    {{ $joinDepartment->member->mobile ?? '' }}
                                </td>


                                <td>
                                    {{ $joinDepartment->department->department_name ?? '' }}
                                </td>
                                {{-- <td>
                                    {{ $joinDepartment->department->department_email ?? '' }}
                                </td> --}}
                                <td>
                                    {{ App\Models\JoinDepartment::MEMBER_TYPE_SELECT[$joinDepartment->member_type] ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ App\Models\JoinDepartment::PRIMARY_FUNCTION_SELECT[$joinDepartment->primary_function] ?? '' }}
                                </td>
                                <td>
                                    @if($joinDepartment->approval_status == 0)
                                    <a class="btn btn-xs btn-secondary">
                                        Pending
                                    </a>
                                    @endif
                                    @if($joinDepartment->approval_status == 1)
                                    <a class="btn btn-xs btn-danger" style="color: white;">
                                        Disapproved
                                    </a>
                                    @endif
                                    @if($joinDepartment->approval_status == 2)
                                    <a class="btn btn-xs btn-success" style="color: white;">
                                        Approved
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($joinDepartment->status == 0)
                                    <a class="btn btn-xs btn-danger" style="color: white;">
                                        Inactive
                                    </a>
                                    @endif
                                    @if($joinDepartment->status == 1)
                                    <a class="btn btn-xs btn-success" style="color: white;">
                                        Active
                                    </a>
                                    @endif

                                    <!-- <td>
                                        {{ $joinDepartment->reason ?? '' }}
                                    </td> -->
                                <td>
                                    @can('join_department_show')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.join-departments.show', $joinDepartment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    @endcan

                                    @can('join_department_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.join-departments.edit', $joinDepartment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    @endcan

                                    @if($joinDepartment->status == 1)
                                    @can('join_department_edit')
                                    <button class="btn btn-xs btn-warning" data-memberId="{{$joinDepartment->id}}"
                                        onclick="ShownDialog('{{$joinDepartment->id}}')">
                                        Delist
                                    </button>
                                    @endcan
                                    @endif
                                    @can('join_department_delete')
                                    <form action="{{ route('admin.join-departments.destroy', $joinDepartment->id) }}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>
                                    @endcan

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane " id="membersDelist" role="tabpanel">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-JoinDepartment">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                {{-- <th>
                                    {{ trans('cruds.joinDepartment.fields.id') }}
                                </th> --}}

                                <th style="width: 150px">
                                    {{ trans('cruds.joinDepartment.fields.member_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.member_Email') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.member_phoneNumber') }}
                                </th>


                                <th>
                                    {{ trans('cruds.joinDepartment.fields.department') }}
                                </th>
                                {{-- <th>
                                    {{ trans('cruds.department.fields.department_email') }}
                                </th> --}}
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.member_type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.primary_function') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.approval_status') }}
                                </th>
                                <th>
                                    {{ trans('cruds.joinDepartment.fields.delisted') }}
                                </th>

                                </th>
                                <!-- <th>
                                    {{ trans('cruds.joinDepartment.fields.reason') }}
                                </th> -->
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($joinDepartmentsDelist as $key => $joinDepartment)
                            <tr data-entry-id="{{ $joinDepartment->id }}">
                                <td>

                                </td>
                                {{-- <td>
                                    {{ $joinDepartment->id ?? '' }}
                                </td> --}}


                                <td style="width: 150px">
                                    {{ $joinDepartment->member->member_name ?? '' }}
                                </td>
                                {{-- <td>
                                    {{ $joinDepartment->member->email ?? '' }}
                                </td> --}}
                                <td>
                                    {{ $joinDepartment->member->mobile ?? '' }}
                                </td>


                                <td>
                                    {{ $joinDepartment->department->department_name ?? '' }}
                                </td>
                                {{-- <td>
                                    {{ $joinDepartment->department->department_email ?? '' }}
                                </td> --}}
                                <td>
                                    {{ App\Models\JoinDepartment::MEMBER_TYPE_SELECT[$joinDepartment->member_type] ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ App\Models\JoinDepartment::PRIMARY_FUNCTION_SELECT[$joinDepartment->primary_function] ?? '' }}
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-danger" style="color: white;">
                                        Delist
                                    </a>
                                </td>
                                <td>
                                    @if($joinDepartment->status == 0)
                                    <a class="btn btn-xs btn-danger" style="color: white;">
                                        Inactive
                                    </a>
                                    @endif
                                    @if($joinDepartment->status == 1)
                                    <a class="btn btn-xs btn-success" style="color: white;">
                                        Active
                                    </a>
                                    @endif


                                <td>
                                    @can('join_department_show')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.join-departments.show', $joinDepartment->id) }}">
                                        {{ trans('global.view') }}
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
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Member Delist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="reason">{{ trans('cruds.joinDepartment.fields.reason') }}</label>
                    <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" name="reason"
                        id="reason"></textarea>
                    @if($errors->has('reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.joinDepartment.fields.reason_helper') }}</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="onDelistAMember()">Delist Member</button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
var selectMemberTodDelist;
//window._token = $('#_token').val();

function onDelistAMember() {
    const txt = $('#reason').val();
    AskQuestion('Do want to delist this department member').then(ask => {
        if (ask) {
            debugger;
            this.Post("{{ route('admin.join-departments.delist-member') }}", {
                    id: selectMemberTodDelist,
                    reason: txt
                }, true)
                .then(res => {
                    console.log(res);
                    selectMemberTodDelist = null;
                    $('#exampleModal').modal('hide');
                    NotificationWithAction(res).then(() => {
                        window.location.reload();
                    });

                });
        }
    })

}

function ShownDialog(Id) {
    $('#exampleModal').modal('show');
    selectMemberTodDelist = Id;
}


$('#exampleModal').on('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var Id = button.dataset['memberid'];
    selectMemberTodDelist = Id;

});
$(function() {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('join_department_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.join-departments.massDestroy') }}",
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).nodes(), function(entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
            }

            if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                        headers: {
                            'x-csrf-token': _token
                        },
                        method: 'POST',
                        url: config.url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        }
                    })
                    .done(function() {
                        location.reload()
                    })
            }
        }
    }
    dtButtons.push(deleteButton)
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [
            [2, 'desc']
        ],
        pageLength: 50,
    });
    let table = $('.datatable-JoinDepartment:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

})
</script>
@endsection
