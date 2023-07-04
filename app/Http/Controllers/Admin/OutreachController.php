<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOutreachRequest;
use App\Http\Requests\StoreOutreachRequest;
use App\Http\Requests\UpdateOutreachRequest;
use App\Models\Location;
use App\Models\Outreach;
use App\Models\OutreachType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutreachController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('outreach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outreaches = Outreach::with(['location', 'contact_person', 'type'])->get();

        return view('admin.outreaches.index', compact('outreaches'));
    }

    public function create()
    {
        abort_if(Gate::denies('outreach_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contact_people = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = OutreachType::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.outreaches.create', compact('contact_people', 'locations', 'types'));
    }

    public function store(StoreOutreachRequest $request)
    {
        $outreach = Outreach::create($request->all());

        return redirect()->route('admin.outreaches.index');
    }

    public function edit(Outreach $outreach)
    {
        abort_if(Gate::denies('outreach_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contact_people = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = OutreachType::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $outreach->load('location', 'contact_person', 'type');

        return view('admin.outreaches.edit', compact('contact_people', 'locations', 'outreach', 'types'));
    }

    public function update(UpdateOutreachRequest $request, Outreach $outreach)
    {
        $outreach->update($request->all());

        return redirect()->route('admin.outreaches.index');
    }

    public function show(Outreach $outreach)
    {
        abort_if(Gate::denies('outreach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outreach->load('location', 'contact_person', 'type');

        return view('admin.outreaches.show', compact('outreach'));
    }

    public function destroy(Outreach $outreach)
    {
        abort_if(Gate::denies('outreach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outreach->delete();

        return back();
    }

    public function massDestroy(MassDestroyOutreachRequest $request)
    {
        Outreach::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
