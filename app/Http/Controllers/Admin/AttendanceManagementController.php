<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAttendanceManagementRequest;
use App\Http\Requests\StoreAttendanceManagementRequest;
use App\Http\Requests\UpdateAttendanceManagementRequest;
use App\Mail\MailNotify;
use App\Models\AddictionalField;
use App\Models\AttendanceManagement;
use App\Models\Cihzone;
use App\Models\Meeting;
use App\Models\MeetingType;
use App\Models\Member;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use PhpParser\Node\Expr\Cast\Object_;

class AttendanceManagementController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('attendance_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceManagements = AttendanceManagement::with(['meeting_type', 'meeting_title', 'created_by', 'cih_centre', 'media'])->get();

        return view('admin.attendanceManagements.index', compact('attendanceManagements'));
    }

    public function create()
    {
        abort_if(Gate::denies('attendance_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting_types = MeetingType::pluck('types', 'id')->prepend(trans('global.pleaseSelect'), '');

        $meeting_titles = Meeting::where('approval_status', '2')->pluck('meeting_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members_in_attendances = Member::pluck('member_name', 'id');

        $cih_centres = Cihzone::pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.attendanceManagements.create', compact('cih_centres', 'meeting_titles', 'meeting_types', 'members_in_attendances'));
    }

    public function store(StoreAttendanceManagementRequest $request)
    {
        if($request['members_in_attendancesL'] != null){
            $request['members_in_attendancesL'] = json_encode($request['members_in_attendancesL']);
        }
        if($request['members_in_excuse'] != null){
            $request['members_in_excuse'] = json_encode($request['members_in_excuse']);
        }
        if($request['members_in_absence'] != null){
            $request['members_in_absence'] = json_encode($request['members_in_absence']);
        }
        $attendanceManagement = AttendanceManagement::create($request->all());
        //$attendanceManagement->members_in_attendances()->sync($request->input('members_in_attendances', []));
        foreach ($request->input('external_files', []) as $file) {
            $attendanceManagement->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $attendanceManagement->id]);
        }

        // $mailSeting = (new MailingSetupController);
        // $email = [];
        // foreach ($attendanceManagement->members_in_attendances() as $key => $value) {
        //     array_push($email, $value->email);
        // }

        // $data['subject'] = 'Notification For Meeting';
        // $usedefined = ['report' => $request['summary_report']];
        // $data['template'] =  $mailSeting->BuildEmailTemplate('8', 0, $usedefined, false);
        // try {
        //     Mail::to($email)->send(new MailNotify($data));
        // } catch (Exception $th) {

        // }
        return redirect()->route('admin.attendance-managements.index');
    }

    public function edit(AttendanceManagement $attendanceManagement)
    {
        abort_if(Gate::denies('attendance_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting_types = MeetingType::pluck('types', 'id')->prepend(trans('global.pleaseSelect'), '');

        $meeting_titles = Meeting::pluck('meeting_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members_in_attendances = Member::pluck('member_name', 'id');

        $cih_centres = Cihzone::pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendanceManagement->load('meeting_type', 'meeting_title', 'created_by', 'cih_centre');

        return view('admin.attendanceManagements.edit', compact('attendanceManagement', 'cih_centres', 'meeting_titles', 'meeting_types', 'members_in_attendances'));
    }

    public function update(UpdateAttendanceManagementRequest $request, AttendanceManagement $attendanceManagement)
    {
        if($request['members_in_attendancesL'] != null){
            $request['members_in_attendancesL'] = json_encode($request['members_in_attendancesL']);
        }
        if($request['members_in_excuse'] != null){
            $request['members_in_excuse'] = json_encode($request['members_in_excuse']);
        }
        if($request['members_in_absence'] != null){
            $request['members_in_absence'] = json_encode($request['members_in_absence']);
        }

        $attendanceManagement->update($request->all());
       // $attendanceManagement->members_in_attendances()->sync($request->input('members_in_attendances', []));
        if (count($attendanceManagement->external_files) > 0) {
            foreach ($attendanceManagement->external_files as $media) {
                if (!in_array($media->file_name, $request->input('external_files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $attendanceManagement->external_files->pluck('file_name')->toArray();
        foreach ($request->input('external_files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $attendanceManagement->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_files');
            }
        }

        return redirect()->route('admin.attendance-managements.index');
    }

    public function show(AttendanceManagement $attendanceManagement)
    {
        abort_if(Gate::denies('attendance_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceManagement->load('meeting_type', 'meeting_title',  'created_by', 'cih_centre');

        return view('admin.attendanceManagements.show', compact('attendanceManagement'));
    }

    public function destroy(AttendanceManagement $attendanceManagement)
    {
        abort_if(Gate::denies('attendance_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttendanceManagementRequest $request)
    {
        AttendanceManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('attendance_management_create') && Gate::denies('attendance_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AttendanceManagement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function updateStatus(Request $request){
        $attendeeId = $request['id'];
        $date = $request['date'];
        $time = $request['time'];
        $status = $request['status'];
        $data = Meeting::where('id',$attendeeId)->first();

        if($data != null){

            $dateList = json_decode($data->date_of_meeting);

            $check = collect($dateList)->where('date',$date )->where('time',$time )->first();

            if($check != null){
                $check->status = $status;

                collect($dateList)->where('date',$date )->replace($check);
                $date_of_meeting = json_encode($dateList);

               $data->update(['date_of_meeting'=> $date_of_meeting]);
            }
        }

        return response()->json('Save sussfully');

    }
    public function cancelStatus(Request $request){
        $attendeeId = $request['id'];
        $date = $request['date'];
        $time = $request['time'];
        $comment = $request['comment'];
        $data = Meeting::where('id',$attendeeId)->first();

        if($data != null){

            $dateList = json_decode($data->date_of_meeting);

            $check = collect($dateList)->where('date',$date )->where('time',$time )->first();

            if($check != null){
                $position = array_search($check, $dateList);

                $dateList[$position]->status = 'Canceled';
                if(count($dateList) - 1 >= $position){
                    $dateList[$position + 1]->status = 'awaiting';
                }
                //collect($dateList)->where('date',$date )->replace($check);
                $date_of_meeting = json_encode($dateList);
                $addictional_json = json_decode('{}');
                if($data->addictional_json != null){
                    $addictional_json = json_decode($data->addictional_json );
                }
                if($addictional_json->canceledList == null){
                    $addictional_json->canceledList = [];
                }
                $obj = json_decode('{}');
                $obj->dateAffected = $date;
                $obj->comment = $comment;
                $obj->dateCanceled = now()->toDateTimeString();
                array_push( $addictional_json->canceledList,$obj);
                $addictional_json2 = json_encode($addictional_json);
               $data->update(['date_of_meeting'=> $date_of_meeting, 'addictional_json' => $addictional_json2]);

               $attendee = Member::all()->whereIn('id',json_decode($data->attendees_id_list) );
               info(json_encode($attendee));
                $emailList = [];
                foreach ($attendee as $lable => $val) {
                    array_push($emailList, $val->email);
                }
                info(json_encode($emailList));
                $data->update(['date_of_meeting'=> $date_of_meeting, 'addictional_json' => $addictional_json2]);
                $mailing['subject'] = 'Meeting Canceled';
                $mailing['template'] = '<p>'.'this meeting for date: ' .$date. ' have been canceled </p>'; //$mailSeting->BuildEmailTemplate('8',  $val->id, [], false);

                try {
                    Mail::to($emailList)->send(new MailNotify($mailing));
                } catch (Exception $th) {

                }
            }
        }

        return response()->json('Save sussfully');

    }

    public function closeStatus(Request $request){
        $attendeeId = $request['id'];
        $date = $request['date'];
        $time = $request['time'];
        $comment = $request['comment'];
        $data = Meeting::where('id',$attendeeId)->first();

        if($data != null){

            $dateList = json_decode($data->date_of_meeting);

            $check = collect($dateList)->where('date',$date )->where('time',$time )->first();

            if($check != null){
                $position = array_search($check, $dateList);

                $dateList[$position]->status = 'Closed';

                if(count($dateList) - 1 >= $position){
                    $dateList[$position + 1]->status = 'awaiting';
                }

                $date_of_meeting = json_encode($dateList);

               $data->update(['date_of_meeting'=> $date_of_meeting]);
            }
        }

        return response()->json('Save sussfully');

    }
    public function rescheduleStatus(Request $request){
        $attendeeId = $request['id'];
        $previousdate = $request['previousdate'];
        $previoustime = $request['previoustime'];
        $currentdate = $request['currentdate'];
        $currenttime = $request['currenttime'];
        $comment = $request['comment'];
        $data = Meeting::where('id',$attendeeId)->first();

        if($data != null){

            $dateList = json_decode($data->date_of_meeting);

            $check = collect($dateList)->where('date',$previousdate )->where('time',$previoustime )->first();

            if($check != null){
                $position = array_search($check, $dateList);

                $dateList[$position]->date =  $currentdate;
                $dateList[$position]->time =  $currenttime;

                //collect($dateList)->where('date',$date )->replace($check);
                $date_of_meeting = json_encode($dateList);

                $addictional_json = new AddictionalField();
                if($data->addictional_json != null){
                    $addictional_json = json_decode($data->addictional_json);
                }
                if($addictional_json->scheduleList == null){
                    $addictional_json->scheduleList = [];
                }
                $obj = json_decode('{}');
                $obj->previousdate = $previousdate;
                $obj->previoustime = $previoustime;
                $obj->currentdate = $currentdate;
                $obj->currenttime =$currenttime;
                $obj->comment = $comment;
                $obj->dateCanceled = now()->toDateTimeString();
                array_push( $addictional_json->scheduleList,$obj);
                $addictional_json2 = json_encode($addictional_json);


                info($data->attendees_id_list);
               $attendee = Member::all()->whereIn('id',json_decode($data->attendees_id_list) );
               info(json_encode($attendee));
                $emailList = [];
                foreach ($attendee as $lable => $val) {
                    array_push($emailList, $val->email);
                }
                info(json_encode($emailList));
                $data->update(['date_of_meeting'=> $date_of_meeting, 'addictional_json' => $addictional_json2]);
                $mailing['subject'] = 'Meeting Reschedule';
                $mailing['template'] = '<p>'.'this meeting for date: ' .$previousdate. 'Time: '.$previoustime . ' have been reschedule to date: ' .$currentdate. 'Time: '.$currenttime .'</p>'; //$mailSeting->BuildEmailTemplate('8',  $val->id, [], false);

                try {
                    Mail::to($emailList)->send(new MailNotify($mailing));
                } catch (Exception $th) {

                }
            }
        }

        return response()->json('Successfully rescheduled');

    }

    public function GetAttendees($Id){
        $data = Meeting::where('id',$Id)->first();
        $attendee = Member::all()->whereIn('id',json_decode($data->attendees_id_list) );
        return $attendee;
    }

    public function GetAttendants($Id, $type){
        $data = AttendanceManagement::where('id',$Id)->first();
        $attendee = Member::all();
        if($type == 'attendee'){
            $attendee = $attendee->whereIn('id',json_decode($data->members_in_attendancesL) );
        } else if($type == 'excuse'){
            $attendee = $attendee->whereIn('id',json_decode($data->members_in_excuse));
        } else if($type == 'absence'){
            $attendee = $attendee->whereIn('id',json_decode($data->members_in_absence));
        }

        return $attendee;
    }

    public function GetMeetingAttendance($meeting_type_id,$meeting_title_id, $date,$time){
        $data = AttendanceManagement::where('meeting_title_id',$meeting_title_id)->where('meeting_type_id',$meeting_type_id)->where('dateData',$date)->where('timeData',$time)->first();
        return $data;
    }
}
