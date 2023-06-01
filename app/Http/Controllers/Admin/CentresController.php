<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCentreRequest;
use App\Http\Requests\StoreCentreRequest;
use App\Http\Requests\UpdateCentreRequest;
use App\Models\Centre;
use App\Models\Member;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CentresController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('centre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $centres = Centre::with(['name', 'role', 'created_by'])->get();

        return view('admin.centres.index', compact('centres'));
    }

    public function create()
    {
        abort_if(Gate::denies('centre_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.centres.create', compact('names', 'roles'));
    }

    public function store(StoreCentreRequest $request)
    {
        $centre = Centre::create($request->all());

        return redirect()->route('admin.centres.index');
    }

    public function edit(Centre $centre)
    {
        abort_if(Gate::denies('centre_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $centre->load('name', 'role', 'created_by');

        return view('admin.centres.edit', compact('centre', 'names', 'roles'));
    }

    public function update(UpdateCentreRequest $request, Centre $centre)
    {
        $centre->update($request->all());

        return redirect()->route('admin.centres.index');
    }

    public function show(Centre $centre)
    {
        abort_if(Gate::denies('centre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $centre->load('name', 'role', 'created_by');

        return view('admin.centres.show', compact('centre'));
    }

    public function destroy(Centre $centre)
    {
        abort_if(Gate::denies('centre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $centre->delete();

        return back();
    }

    public function massDestroy(MassDestroyCentreRequest $request)
    {
        $centres = Centre::find(request('ids'));

        foreach ($centres as $centre) {
            $centre->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
