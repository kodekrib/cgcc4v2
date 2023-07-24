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

        $userId = Auth::user()->email;

        $member =Member::all()->where('email', $userId)->first();
        $jointDepartment =  null;
        if($member != null){
            $jointDepartment = JoinDepartment::with(['department', 'department.hod'])->where('member_Id', $member->id)->get();
        }

        return view('admin.joinDepartments.create', compact('departments', 'member', 'jointDepartment'));
    }

    public function store(StoreJoinDepartmentRequest $request)
    {


        $mailSeting = (new MailingSetupController);
        $verifyEmailTemplete = $mailSeting->VerifyEmailTemplate('1');
        if($verifyEmailTemplete == false){
            return redirect()->back()->withInput()->withErrors(['error' => 'Email template for joining department not set, please kindly contact the administrator']);
        }


        $userId = Auth::user()->email;

        $member =Member::all()->where('email', $userId)->first();
        //dd($member);
        if($member == null) return redirect()->back()->withInput()->withErrors(['error' => 'User can not join Department with become a member, please kindly join as member first']);

        $dept = Department::with(['hod', 'organization_type', 'created_by'])->where('id', $request['department_id'])->first();

        if($dept->hod() == null) return redirect()->back()->withInput()->withErrors(['error' => 'No HOD for the selected Department']);

        $request['member_Id']=$member->id;
        $request['status'] = 0;

        $verify = JoinDepartment::all()->where('member_Id', $request['member_Id'])->where('department_id', $request['department_id'])->where('approval_status', 2)->where('status', 1)->first();
        if( $verify != null){
            return redirect()->back()->withInput()->withErrors(['error' => 'You are part of the selected department, you can\'t join again']);
        }

        $joinDepartment = JoinDepartment::create($request->all());



        if($dept != null){


            $email = $mailSeting->GetEmailList(1, $member->id,$joinDepartment->department_id);
            $data['subject'] = 'Notification For Joining a Department';
            $data['template'] =  $mailSeting->BuildEmailTemplate('1', $member->id);
            info(json_encode($email));
            try {
                Mail::to($email)->send(new MailNotify($data));
            } catch (Exception $th) {
                info($th);
            }
        }

        return redirect()->route('admin.join-departments.index');
    }

    public function edit(JoinDepartment $joinDepartment)
    {
        abort_if(Gate::denies('join_department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $departments = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $joinDepartment->load('department', 'created_by', 'member');

        $userId = Auth::user()->email;

        $member =Member::all()->where('email', $userId)->first();
        $jointDepartment =  null;
        if($member != null){
            $jointDepartment = JoinDepartment::with(['department', 'department.hod'])->where('member_Id', $member->id)->get();
        }


        return view('admin.joinDepartments.edit', compact('departments', 'joinDepartment', 'jointDepartment'));
    }

    public function update(UpdateJoinDepartmentRequest $request, JoinDepartment $joinDepartment)
    {

        $mailSeting = (new MailingSetupController);
        $verifyEmailTemplete = $mailSeting->VerifyEmailTemplate('2');
        $verifyEmailTempleteD = $mailSeting->VerifyEmailTemplate('3');
        if($verifyEmailTemplete == false || $verifyEmailTempleteD == false){
            return redirect()->back()->withInput()->withErrors(['error' => 'Email template for Approved/Disapproved joining department not set, please kindly contact the administrator']);
        }

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

        $template = $mailSeting->BuildEmailTemplate('4', $dept['created_by_id'], $userDefined);
        $data['template'] =   $template;//'<p>'.(string)$request['reason'] . '</p>';//$mailSeting->BuildEmailTemplate('1', $member->id);

        try {
            Mail::to($dept['member']->email)->send(new MailNotify($data));
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
