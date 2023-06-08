<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAtsMembershipRequest;
use App\Http\Requests\StoreAtsMembershipRequest;
use App\Http\Requests\UpdateAtsMembershipRequest;
use App\Models\AtsMembership;
use App\Models\AtsMembershipRecord;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtsMembershipController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ats_membership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atsMemberships = AtsMembership::with(['created_by', 'ats_membership_number'])->get();

        return view('admin.atsMemberships.index', compact('atsMemberships'));
    }

    public function create()
    {
        abort_if(Gate::denies('ats_membership_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ats_membership_numbers = AtsMembershipRecord::pluck('names', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.atsMemberships.create', compact('ats_membership_numbers'));
    }

    public function store(StoreAtsMembershipRequest $request)
    {
        if (AtsMembership::count() > 0) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Only one ATS record is allowed']);
           }

        $atsMembership = AtsMembership::create($request->all());

        return redirect()->route('admin.ats-memberships.index');
    }

    public function edit(AtsMembership $atsMembership)
    {
        abort_if(Gate::denies('ats_membership_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ats_membership_numbers = AtsMembershipRecord::pluck('names', 'id')->prepend(trans('global.pleaseSelect'), '');

        $atsMembership->load('created_by', 'ats_membership_number');

        return view('admin.atsMemberships.edit', compact('atsMembership', 'ats_membership_numbers'));
    }

    public function update(UpdateAtsMembershipRequest $request, AtsMembership $atsMembership)
    {
        $atsMembership->update($request->all());

        return redirect()->route('admin.ats-memberships.index');
    }

    public function show(AtsMembership $atsMembership)
    {
        abort_if(Gate::denies('ats_membership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atsMembership->load('created_by', 'ats_membership_number');

        return view('admin.atsMemberships.show', compact('atsMembership'));
    }

    public function destroy(AtsMembership $atsMembership)
    {
        abort_if(Gate::denies('ats_membership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atsMembership->delete();

        return back();
    }

    public function massDestroy(MassDestroyAtsMembershipRequest $request)
    {
        $atsMemberships = AtsMembership::find(request('ids'));

        foreach ($atsMemberships as $atsMembership) {
            $atsMembership->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
