<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAtsMembershipRecordRequest;
use App\Http\Requests\StoreAtsMembershipRecordRequest;
use App\Http\Requests\UpdateAtsMembershipRecordRequest;
use App\Models\AtsMembershipRecord;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtsMembershipRecordsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('ats_membership_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atsMembershipRecords = AtsMembershipRecord::all();

        return view('admin.atsMembershipRecords.index', compact('atsMembershipRecords'));
    }

    public function create()
    {
        abort_if(Gate::denies('ats_membership_record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.atsMembershipRecords.create');
    }

    public function store(StoreAtsMembershipRecordRequest $request)
    {
        $atsMembershipRecord = AtsMembershipRecord::create($request->all());

        return redirect()->route('admin.ats-membership-records.index');
    }

    public function edit(AtsMembershipRecord $atsMembershipRecord)
    {
        abort_if(Gate::denies('ats_membership_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.atsMembershipRecords.edit', compact('atsMembershipRecord'));
    }

    public function update(UpdateAtsMembershipRecordRequest $request, AtsMembershipRecord $atsMembershipRecord)
    {
        $atsMembershipRecord->update($request->all());

        return redirect()->route('admin.ats-membership-records.index');
    }

    public function show(AtsMembershipRecord $atsMembershipRecord)
    {
        abort_if(Gate::denies('ats_membership_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.atsMembershipRecords.show', compact('atsMembershipRecord'));
    }

    public function destroy(AtsMembershipRecord $atsMembershipRecord)
    {
        abort_if(Gate::denies('ats_membership_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atsMembershipRecord->delete();

        return back();
    }

    public function massDestroy(MassDestroyAtsMembershipRecordRequest $request)
    {
        $atsMembershipRecords = AtsMembershipRecord::find(request('ids'));

        foreach ($atsMembershipRecords as $atsMembershipRecord) {
            $atsMembershipRecord->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
