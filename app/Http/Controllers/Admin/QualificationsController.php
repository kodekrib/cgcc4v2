<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQualificationRequest;
use App\Http\Requests\StoreQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Models\Qualification;
use App\Models\QualificationSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QualificationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qualification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualifications = Qualification::with(['highest_qualifications', 'created_by'])->get();

        return view('admin.qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        abort_if(Gate::denies('qualification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $highest_qualifications = QualificationSetting::pluck('highest_qualification', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.qualifications.create', compact('highest_qualifications'));
    }

    public function store(StoreQualificationRequest $request)
    {
        $qualification = Qualification::create($request->all());

        return redirect()->route('admin.qualifications.index');
    }

    public function edit(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $highest_qualifications = QualificationSetting::pluck('highest_qualification', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qualification->load('highest_qualifications', 'created_by');

        return view('admin.qualifications.edit', compact('highest_qualifications', 'qualification'));
    }

    public function update(UpdateQualificationRequest $request, Qualification $qualification)
    {
        $qualification->update($request->all());

        return redirect()->route('admin.qualifications.index');
    }

    public function show(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualification->load('highest_qualifications', 'created_by');

        return view('admin.qualifications.show', compact('qualification'));
    }

    public function destroy(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualification->delete();

        return back();
    }

    public function massDestroy(MassDestroyQualificationRequest $request)
    {
        Qualification::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
