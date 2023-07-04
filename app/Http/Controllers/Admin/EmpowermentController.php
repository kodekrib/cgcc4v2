<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpowermentRequest;
use App\Http\Requests\UpdateEmpowermentRequest;
use App\Models\AtsMembershipRecord;
use App\Models\Empowerment;
use App\Models\EmpowermentTrainingNeed;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpowermentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('empowerment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empowerments = Empowerment::with(['ats_membership_no', 'training_needs'])->get();

        return view('admin.empowerments.index', compact('empowerments'));
    }

    public function create()
    {
        abort_if(Gate::denies('empowerment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ats_membership_nos = AtsMembershipRecord::pluck('names', 'id')->prepend(trans('global.pleaseSelect'), '');

        $training_needs = EmpowermentTrainingNeed::pluck('training_needs', 'id');

        return view('admin.empowerments.create', compact('ats_membership_nos', 'training_needs'));
    }

    public function store(StoreEmpowermentRequest $request)
    {
        $empowerment = Empowerment::create($request->all());
        $empowerment->training_needs()->sync($request->input('training_needs', []));

        return redirect()->route('admin.empowerments.index');
    }

    public function edit(Empowerment $empowerment)
    {
        abort_if(Gate::denies('empowerment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ats_membership_nos = AtsMembershipRecord::pluck('names', 'id')->prepend(trans('global.pleaseSelect'), '');

        $training_needs = EmpowermentTrainingNeed::pluck('training_needs', 'id');

        $empowerment->load('ats_membership_no', 'training_needs');

        return view('admin.empowerments.edit', compact('ats_membership_nos', 'empowerment', 'training_needs'));
    }

    public function update(UpdateEmpowermentRequest $request, Empowerment $empowerment)
    {
        $empowerment->update($request->all());
        $empowerment->training_needs()->sync($request->input('training_needs', []));

        return redirect()->route('admin.empowerments.index');
    }

    public function show(Empowerment $empowerment)
    {
        abort_if(Gate::denies('empowerment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empowerment->load('ats_membership_no', 'training_needs');

        return view('admin.empowerments.show', compact('empowerment'));
    }
}
