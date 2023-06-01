<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJoinDepartmentRequest;
use App\Http\Requests\StoreJoinDepartmentRequest;
use App\Http\Requests\UpdateJoinDepartmentRequest;
use App\Models\Department;
use App\Models\JoinDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Admin\MailingSetupController;
use App\Models\Member;
use Exception;
use Illuminate\Contracts\Session\Session;

class JoinDepartmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('join_department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $joinDepartmentsList = JoinDepartment::with(['department', 'created_by'])->where('approval_status', '!=', 3)->get();
        $joinDepartmentsDelist = JoinDepartment::with(['department', 'created_by', 'member'])->where('approval_status', 3)->get();
        return view('admin.joinDepartments.index', compact('joinDepartmentsList', 'joinDepartmentsDelist'));
    }

    public function create()
    {
        abort_if(Gate::denies('join_department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.joinDepartments.create', compact('departments'));
    }

    public function store(StoreJoinDepartmentRequest $request)
    {
        $userId = Auth::user()->email;

        $member =Member::all()->where('email', $userId)->first();

        if($member == null) return redirect()->route('admin.join-departments.index');

        $dept = Department::with(['hod', 'organization_type', 'created_by'])->where('id', $request['department_id'])->first();

        $request['member_Id']=$member->id;
        $request['status'] = 0;

        $joinDepartment = JoinDepartment::create($request->all());



        if($dept != null){

            $mailSeting = (new MailingSetupController);
            $email = $mailSeting->GetEmailList(1, $member->id,$joinDepartment->department_id);
            $data['subject'] = 'Notification For Joining a Department';
            $data['template'] =  $mailSeting->BuildEmailTemplate('1', $member->id);

            try {
                Mail::to($email)->send(new MailNotify($data));
            } catch (Exception $th) {

            }
        }

        return redirect()->route('admin.join-departments.index');
    }

    public function edit(JoinDepartment $joinDepartment)
    {
        abort_if(Gate::denies('join_department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $departments = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $joinDepartment->load('department', 'created_by', 'member');

        return view('admin.joinDepartments.edit', compact('departments', 'joinDepartment'));
    }

    public function update(UpdateJoinDepartmentRequest $request, JoinDepartment $joinDepartment)
    {

        $member =Member::all()->where('id', $joinDepartment['member_Id'])->first();

        if($member == null) return redirect()->route('admin.join-departments.index');
        $check = JoinDepartment::all()->where('id', $joinDepartment->id)->first();

        if($request['approval_status'] == '2' && $check->approval_status  == 0){
            $mailSeting = (new MailingSetupController);
            $template = $mailSeting->BuildEmailTemplate('2', $member->id);
            $data['subject'] = 'Notification For Approval';
            $data['template'] = $template;//'<p>'.(string)$request['reason']. '</p>';//$mailSeting->BuildEmailTemplate('1', $member->id);

            try {
                Mail::to($member->email)->send(new MailNotify($data));
            } catch (Exception $th) {

            }
            $request['status'] = 1;
        } else if($request['approval_status']== '1' && $check->approval_status  == 0){
                $data['subject'] = 'Notification For Disapprove';
                $mailSeting = (new MailingSetupController);
                $template = $mailSeting->BuildEmailTemplate('3', $member->id);
                $data['template'] =   $template;//'<p>'.(string)$request['reason'] . '</p>';//$mailSeting->BuildEmailTemplate('1', $member->id);

                try {
                    Mail::to($member->email)->send(new MailNotify($data));
                } catch (Exception $th) {

                }
                $request['status'] = 0;

        }
        $joinDepartment->update($request->all());

        return redirect()->route('admin.join-departments.index');
    }

    public function DelistMember(Request $resquest){
        abort_if(Gate::denies('join_department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dept = JoinDepartment::with(['created_by', 'member'])->where('id',$resquest->input('id'))->first();
        $send = JoinDepartment::where('id',$resquest->input('id'))->update(['status' => 0, 'reason' => $resquest->input('reason'), 'approval_status' => 3]);
        $data['subject'] = 'Notification For Delist';
        $mailSeting = (new MailingSetupController);
        $userDefined = [
               'reason' => (string)$resquest['reason'],
        ];

        $template = $mailSeting->BuildEmailTemplate('4', $dept->created_by_id, $userDefined);
        $data['template'] =   $template;//'<p>'.(string)$request['reason'] . '</p>';//$mailSeting->BuildEmailTemplate('1', $member->id);

        try {
            Mail::to($dept->created_by->email)->send(new MailNotify($data));
        } catch (Exception $th) {

        }
        return response("Member is delisted Successfully", Response::HTTP_OK);
    }

    public function show(JoinDepartment $joinDepartment)
    {
        abort_if(Gate::denies('join_department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $joinDepartment->load('department', 'created_by', 'member');

        return view('admin.joinDepartments.show', compact('joinDepartment'));
    }

    public function destroy(JoinDepartment $joinDepartment)
    {
        abort_if(Gate::denies('join_department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $joinDepartment->delete();

        return back();
    }

    public function massDestroy(MassDestroyJoinDepartmentRequest $request)
    {
        $joinDepartments = JoinDepartment::find(request('ids'));

        foreach ($joinDepartments as $joinDepartment) {
            $joinDepartment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
