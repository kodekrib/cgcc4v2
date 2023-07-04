<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJobLevelRequest;
use App\Http\Requests\StoreJobLevelRequest;
use App\Http\Requests\UpdateJobLevelRequest;
use App\Models\JobLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JobLevelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('job_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JobLevel::query()->select(sprintf('%s.*', (new JobLevel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'job_level_show';
                $editGate = 'job_level_edit';
                $deleteGate = 'job_level_delete';
                $crudRoutePart = 'job-levels';

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
            $table->editColumn('job_level', function ($row) {
                return $row->job_level ? $row->job_level : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.jobLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('job_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jobLevels.create');
    }

    public function store(StoreJobLevelRequest $request)
    {
        $jobLevel = JobLevel::create($request->all());

        return redirect()->route('admin.job-levels.index');
    }

    public function edit(JobLevel $jobLevel)
    {
        abort_if(Gate::denies('job_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jobLevels.edit', compact('jobLevel'));
    }

    public function update(UpdateJobLevelRequest $request, JobLevel $jobLevel)
    {
        $jobLevel->update($request->all());

        return redirect()->route('admin.job-levels.index');
    }

    public function show(JobLevel $jobLevel)
    {
        abort_if(Gate::denies('job_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jobLevels.show', compact('jobLevel'));
    }

    public function destroy(JobLevel $jobLevel)
    {
        abort_if(Gate::denies('job_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobLevelRequest $request)
    {
        JobLevel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
