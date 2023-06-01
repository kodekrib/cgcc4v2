<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMailingRequest;
use App\Http\Requests\StoreMailingRequest;
use App\Http\Requests\UpdateMailingRequest;
use App\Models\AreaOfSpecialization;
use App\Models\JobLevel;
use App\Models\Mailing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MailingsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('mailing_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Mailing::with(['area_of_specialization', 'job_level'])->select(sprintf('%s.*', (new Mailing())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'mailing_show';
                $editGate = 'mailing_edit';
                $deleteGate = 'mailing_delete';
                $crudRoutePart = 'mailings';

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
            $table->editColumn('job_mailing_list', function ($row) {
                return $row->job_mailing_list ? Mailing::JOB_MAILING_LIST_SELECT[$row->job_mailing_list] : '';
            });
            $table->addColumn('area_of_specialization_area_of_specialization', function ($row) {
                return $row->area_of_specialization ? $row->area_of_specialization->area_of_specialization : '';
            });

            $table->addColumn('job_level_job_level', function ($row) {
                return $row->job_level ? $row->job_level->job_level : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'area_of_specialization', 'job_level']);

            return $table->make(true);
        }

        return view('admin.mailings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mailing_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area_of_specializations = AreaOfSpecialization::pluck('area_of_specialization', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job_levels = JobLevel::pluck('job_level', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mailings.create', compact('area_of_specializations', 'job_levels'));
    }

    public function store(StoreMailingRequest $request)
    {
        $mailing = Mailing::create($request->all());

        return redirect()->route('admin.mailings.index');
    }

    public function edit(Mailing $mailing)
    {
        abort_if(Gate::denies('mailing_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area_of_specializations = AreaOfSpecialization::pluck('area_of_specialization', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job_levels = JobLevel::pluck('job_level', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mailing->load('area_of_specialization', 'job_level');

        return view('admin.mailings.edit', compact('area_of_specializations', 'job_levels', 'mailing'));
    }

    public function update(UpdateMailingRequest $request, Mailing $mailing)
    {
        $mailing->update($request->all());

        return redirect()->route('admin.mailings.index');
    }

    public function show(Mailing $mailing)
    {
        abort_if(Gate::denies('mailing_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mailing->load('area_of_specialization', 'job_level');

        return view('admin.mailings.show', compact('mailing'));
    }

    public function destroy(Mailing $mailing)
    {
        abort_if(Gate::denies('mailing_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mailing->delete();

        return back();
    }

    public function massDestroy(MassDestroyMailingRequest $request)
    {
        Mailing::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
