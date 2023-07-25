<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailingSetupRequest;
use App\Http\Resources\Admin\MailingSetupResources;
use App\Models\Department;
use App\Models\MailingSetup;
use App\Models\MailingTemplate;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Admin\from;
use App\Models\JoinDepartment;

class MailingSetupController extends Controller
{
    public $inbuiltParameter;

    public function __construct()
    {

        $this->inbuiltParameter = [
            'memberName',
            'email',
            'middlename',
            'mobile',
            'date_of_birth',
            'marital_status',
            'affinity_group',
            'department_name',
            'dept_code'
        ];
    }
    public function index()
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $inbuiltParameter = json_encode($this->inbuiltParameter);

        $emailList = MailingSetup::all(); //MailingSetup::with(['mailing_operation_code', 'category', 'level', 'number_email'])->get();
        $category = json_encode(Member::MAILING_SETUP_CATEGORY);
        return view('admin.mailingSetup.index', compact('inbuiltParameter','emailList', 'category'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = json_encode(Member::MAILING_SETUP_CATEGORY);

        return view('admin.mailingSetup.create', compact('category'));
    }

    public function getMailingSetupbyOperationCode(string $id){

        return new MailingSetupResources(MailingSetup::all()->where('mailing_operation_code', $id));
    }

    public function AddMailSetting(Request $request){

        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $input = (array) $request->input('data');

        foreach($input as $item){
            if( $item['id'] == 0){
                $create = MailingSetup::create($item);
            } else{
                MailingSetup::where('id', $item['id'] )->update($item);
            }
        }

       return response('Successfully Saved', Response::HTTP_CREATED);
    }

    public function CreateMailingTemplate(MailingSetupRequest $request){
        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request['id'] == 0){
            $create = MailingTemplate::create($request->all());
        } else {
            $create = MailingTemplate::where('id', $request['id'])->update(['template' => $request->template]);
        }


        return response('Successfully Saved', Response::HTTP_CREATED);

    }

    public function getMailingTemplaterationCode($id){

        return MailingTemplate::all()->where('mailing_operation_code', $id)->first();
    }

    public function GetEmailList($id, $userId, $departmentId = null){
        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emailist = [];
        $list = MailingSetup::all()->where('mailing_operation_code', $id);
        $dept = Department::with(['hod', 'organization_type', 'created_by'])->get();

        $member= User::all();
        foreach ($list as $item) {

          if($item->category== 'member'){

            if($item->member_ids != null){
                $memberMail= json_decode($item->member_ids);
                foreach($memberMail as $memberId){
                    $check =$member->where('id', $memberId)->first();

                    if($check != null){
                        if($item->number_email === 0){
                            $item->number_email = 10000;
                        }
                        if(in_array($check->email, $emailist ) == false && $item->number_email > count( $emailist)){
                            array_push($emailist, $check->email);
                        }
                        //$emailist->where('email', $check->email)->firstOrFail();

                    }
                }
            }
          } else if($item->category== 'department'){
            if($userId == 0) continue ;
            $dataUser = JoinDepartment::with(['department'])->get()->where('member_Id', $userId)->first();

            if($dataUser != null){
                //$deptMail= json_decode($item->member_ids);
                $check =$dept->where('id', $dataUser->department_id)->firstOrFail();
                if($item->number_email === 0){
                    $item->number_email = 10000;
                }
                if(in_array($check->hod->email, $emailist ) == false ){
                    array_push($emailist, $check->hod->email);
                }
                if(in_array($check->department_email, $emailist ) == false && $item->number_email > count( $emailist)){
                    array_push($emailist, $check->department_email);
                }
            }
          }
        }

        return $emailist;
    }

    public function VerifyEmailTemplate(string $operationCode){
        $template = $this->getMailingTemplaterationCode($operationCode);
        if($template == null){
            return false;
        } else {
            return true;
        }
    }

    public function BuildEmailTemplate(string $operationCode, $userId, $userParameter = [], $isMember = true){

        $template = $this->getMailingTemplaterationCode($operationCode);
        $html=view('partials.email')->render();
        $html = str_replace('{html}',(string)$template->template,$html) ;
        $members = Member::with(['title', 'employment_status', 'created_by', 'media'])->where('id', $userId)->first();
        if( $isMember == false){
            $members = User::where('id', $userId)->first();
        }
        $joinDepartments = JoinDepartment::with(['department', 'created_by'])->where('member_Id', $userId)->first();

        foreach ($this->inbuiltParameter as $value) {
            if($value == 'memberName' &&  $members != null){
                if($members['member_name'] != null){
                    $html = str_replace('{memberName}',$members['member_name'],$html);
                } else {
                    $html = str_replace('{memberName}',$members['name'],$html);
                }

            } else if($value == 'email' &&  $members != null){
                $html = str_replace('{email}',$members['email'],$html);
            } else if($value == 'middlename' &&  $members != null){
                $html = str_replace('{middlename}',$members['middlename'],$html);
            } else if($value == 'mobile' &&  $members != null){
                $html = str_replace('{mobile}',$members['mobile'],$html);
            } else if($value == 'date_of_birth' &&  $members != null){
                $html = str_replace('{date_of_birth}',$members['date_of_birth'],$html);
            } else if($value == 'marital_status' &&  $members != null){
                $html = str_replace('{marital_status}',$members['marital_status'],$html);
            } else if($value == 'affinity_group' &&  $members != null){
                $html = str_replace('{affinity_group}',$members['affinity_group'],$html);
            } else if($value == 'department_name' &&  $joinDepartments != null){
                $html = str_replace('{department_name}',$joinDepartments->department['department_name'],$html);
            } else if($value == 'dept_code' &&  $joinDepartments != null){
                $html = str_replace('{dept_code}',$joinDepartments->department['dept_code'],$html);
            }

        }

        foreach ($userParameter as $key => $value) {

            $html = str_replace( '{'.$key .'}' ,$value ,$html);
        }

        return $html;
    }


}
