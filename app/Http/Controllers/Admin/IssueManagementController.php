<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIssueManagementRequest;
use App\Http\Requests\StoreIssueManagementRequest;
use App\Http\Requests\UpdateIssueManagementRequest;
use App\Mail\MailNotify;
use App\Models\AssetLocation;
use App\Models\Department;
use App\Models\IssueManagement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class IssueManagementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('issue_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueManagements = IssueManagement::with(['issue_location', 'department_concerned', 'created_by'])->get();

        return view('admin.issueManagements.index', compact('issueManagements'));
    }

    public function create()
    {
        abort_if(Gate::denies('issue_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issue_locations = AssetLocation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $department_concerneds = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.issueManagements.create', compact('department_concerneds', 'issue_locations'));
    }

    public function store(StoreIssueManagementRequest $request)
    {
        $issueManagement = IssueManagement::create($request->all());

        $department = Department::with(['hod'])->where('id', $request->department_concerned_id)->first();


        $mailSeting = (new MailingSetupController);

        $template = $mailSeting->BuildEmailTemplate('9', 0);
        if($template == null || $template == '')  return redirect()->route('admin.issue-managements.index');
        $data['subject'] = 'Notification on Issue';
        $data['template'] = $template;

        try {
            Mail::to( $department->hod->email)->send(new MailNotify($data));
        } catch (Exception $th) {

        }

        return redirect()->route('admin.issue-managements.index');
    }

    public function edit(IssueManagement $issueManagement)
    {
        abort_if(Gate::denies('issue_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issue_locations = AssetLocation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $department_concerneds = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issueManagement->load('issue_location', 'department_concerned', 'created_by');

        return view('admin.issueManagements.edit', compact('department_concerneds', 'issueManagement', 'issue_locations'));
    }

    public function update(UpdateIssueManagementRequest $request, IssueManagement $issueManagement)
    {
        $issueManagement->update($request->all());

        return redirect()->route('admin.issue-managements.index');
    }

    public function show(IssueManagement $issueManagement)
    {
        abort_if(Gate::denies('issue_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueManagement->load('issue_location', 'department_concerned', 'created_by');

        return view('admin.issueManagements.show', compact('issueManagement'));
    }

    public function destroy(IssueManagement $issueManagement)
    {
        abort_if(Gate::denies('issue_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyIssueManagementRequest $request)
    {
        IssueManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
