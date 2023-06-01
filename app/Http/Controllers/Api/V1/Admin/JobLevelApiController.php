<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobLevelRequest;
use App\Http\Requests\UpdateJobLevelRequest;
use App\Http\Resources\Admin\JobLevelResource;
use App\Models\JobLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobLevelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobLevelResource(JobLevel::all());
    }

    public function store(StoreJobLevelRequest $request)
    {
        $jobLevel = JobLevel::create($request->all());

        return (new JobLevelResource($jobLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JobLevel $jobLevel)
    {
        abort_if(Gate::denies('job_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobLevelResource($jobLevel);
    }

    public function update(UpdateJobLevelRequest $request, JobLevel $jobLevel)
    {
        $jobLevel->update($request->all());

        return (new JobLevelResource($jobLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JobLevel $jobLevel)
    {
        abort_if(Gate::denies('job_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
