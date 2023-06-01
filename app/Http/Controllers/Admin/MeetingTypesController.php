<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMeetingTypeRequest;
use App\Http\Requests\StoreMeetingTypeRequest;
use App\Http\Requests\UpdateMeetingTypeRequest;
use App\Models\MeetingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MeetingTypesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('meeting_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MeetingType::query()->select(sprintf('%s.*', (new MeetingType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'meeting_type_show';
                $editGate = 'meeting_type_edit';
                $deleteGate = 'meeting_type_delete';
                $crudRoutePart = 'meeting-types';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('types', function ($row) {
                return $row->types ? $row->types : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.meetingTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('meeting_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meetingTypes.create');
    }

    public function store(StoreMeetingTypeRequest $request)
    {
        $meetingType = MeetingType::create($request->all());

        return redirect()->route('admin.meeting-types.index');
    }

    public function edit(MeetingType $meetingType)
    {
        abort_if(Gate::denies('meeting_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meetingTypes.edit', compact('meetingType'));
    }

    public function update(UpdateMeetingTypeRequest $request, MeetingType $meetingType)
    {
        $meetingType->update($request->all());

        return redirect()->route('admin.meeting-types.index');
    }

    public function show(MeetingType $meetingType)
    {
        abort_if(Gate::denies('meeting_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meetingTypes.show', compact('meetingType'));
    }

    public function destroy(MeetingType $meetingType)
    {
        abort_if(Gate::denies('meeting_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meetingType->delete();

        return back();
    }

    public function massDestroy(MassDestroyMeetingTypeRequest $request)
    {
        MeetingType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
