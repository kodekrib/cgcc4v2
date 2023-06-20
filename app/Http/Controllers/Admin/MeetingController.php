<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMeetingRequest;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Mail\MailNotify;
use App\Models\Department;
use App\Models\JoinDepartment;
use App\Models\Meeting;
use App\Models\MeetingType;
use App\Models\Member;
use App\Models\Venue;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Exception;
class MeetingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meetings = Meeting::with(['meeting_type', 'venue', 'created_by', 'media'])->get();

        return view('admin.meetings.index', compact('meetings'));
    }

    public function create()
    {
        abort_if(Gate::denies('meeting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting_types = MeetingType::pluck('types', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('venue_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendees = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $department = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.meetings.create', compact('attendees', 'meeting_types', 'venues', 'department'));
    }

    public function store(StoreMeetingRequest $request)
    {
        $meeting = Meeting::create($request->all());

        foreach ($request->input('meeting_minutes', []) as $file) {
            $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('meeting_minutes');
        }

        foreach ($request->input('files', []) as $file) {
            $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $meeting->id]);
        }

        return redirect()->route('admin.meetings.index');
    }

    public function edit(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting_types = MeetingType::pluck('types', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('venue_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendees = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $department = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $meeting->load('meeting_type', 'venue', 'created_by');

        return view('admin.meetings.edit', compact('attendees', 'meeting', 'meeting_types', 'venues', 'department'));
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
       $date_of_meeting = json_decode($request['date_of_meeting']);
       $date_of_meeting[0]->status = "awaiting";
       $request['date_of_meeting'] = json_encode($date_of_meeting);
        $meeting->update($request->all());

        if (count($meeting->meeting_minutes) > 0) {
            foreach ($meeting->meeting_minutes as $media) {
                if (!in_array($media->file_name, $request->input('meeting_minutes', []))) {
                    $media->delete();
                }
            }
        }
        $media = $meeting->meeting_minutes->pluck('file_name')->toArray();
        foreach ($request->input('meeting_minutes', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('meeting_minutes');
            }
        }

        if (count($meeting->files) > 0) {
            foreach ($meeting->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $meeting->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.meetings.index');
    }

    public function show(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting->load('meeting_type', 'venue', 'attendees', 'created_by');

        return view('admin.meetings.show', compact('meeting'));
    }

    public function destroy(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting->delete();

        return back();
    }

    public function massDestroy(MassDestroyMeetingRequest $request)
    {
        $meetings = Meeting::find(request('ids'));

        foreach ($meetings as $meeting) {
            $meeting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('meeting_create') && Gate::denies('meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Meeting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function GetMemberList($member_group, $member_type){
        $member = [];
        if($member_group == 'all'){
            $member = Member::all();
        }elseif($member_group == 'department'){
            $member =JoinDepartment::with(['created_by', 'member'])->where('department_id',$member_type)->where('approval_status', '!=', 3)->get()->map(function($mem){
               return $mem->member;
            });
        }elseif($member_group == 'affinity_group'){

            $member = Member::where('affinity_group', 'like', '%'.$member_type.'%')->get();//Member::whereHas('affinity_group',$member_type);
        }elseif($member_group == 'hod'){

            $member = Department::with(['hod'])->get()->pluck('hod')->flatten();
        }


        return  response()->json($member, Response::HTTP_CREATED);
    }

    public function GetMeetingAttendee($id){

        $meeting = Meeting::where('id', $id)->first();

        $member = Member::all() ->whereIn('id', json_decode($meeting->attendees_id_list));
        return  $member;
    }

    public function GetMeetingById($id){
        $meeting = Meeting::where('id', $id)->first();
        return $meeting;
    }



}
