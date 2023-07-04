<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIssueManagementRequest;
use App\Http\Requests\UpdateIssueManagementRequest;
use App\Http\Resources\Admin\IssueManagementResource;
use App\Models\IssueManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IssueManagementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('issue_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IssueManagementResource(IssueManagement::with(['issue_location', 'department_concerned', 'created_by'])->get());
    }

    public function store(StoreIssueManagementRequest $request)
    {
        $issueManagement = IssueManagement::create($request->all());

        return (new IssueManagementResource($issueManagement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IssueManagement $issueManagement)
    {
        abort_if(Gate::denies('issue_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IssueManagementResource($issueManagement->load(['issue_location', 'department_concerned', 'created_by']));
    }

    public function update(UpdateIssueManagementRequest $request, IssueManagement $issueManagement)
    {
        $issueManagement->update($request->all());

        return (new IssueManagementResource($issueManagement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IssueManagement $issueManagement)
    {
        abort_if(Gate::denies('issue_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $issueManagement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
