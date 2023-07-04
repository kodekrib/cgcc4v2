<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCihmemberRequest;
use App\Http\Requests\StoreCihmemberRequest;
use App\Http\Requests\UpdateCihmemberRequest;
use App\Models\Centre;
use App\Models\Cihmember;
use App\Models\Cihzone;
use App\Models\Member;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CihmemberController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('cihmember_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihmembers = Cihmember::with(['zone', 'cih', 'created_by'])->get();

        return view('admin.cihmembers.index', compact('cihmembers'));
    }

    public function create()
    {
        abort_if(Gate::denies('cihmember_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zones = Cihzone::pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cihs = Centre::pluck('cih_centre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cihmembers.create', compact('cihs', 'zones'));
    }

    public function store(StoreCihmemberRequest $request)
    {
        $member = Member::where('email', Auth::user()->email)->first();
        $request['created_by_id']= $member->id;
        $cihmember = Cihmember::create($request->all());

        return redirect()->route('admin.cihmembers.index');
    }

    public function edit(Cihmember $cihmember)
    {
        abort_if(Gate::denies('cihmember_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zones = Cihzone::pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cihs = Centre::pluck('cih_centre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cihmember->load('zone', 'cih', 'created_by');

        return view('admin.cihmembers.edit', compact('cihmember', 'cihs', 'zones'));
    }

    public function update(UpdateCihmemberRequest $request, Cihmember $cihmember)
    {
        $cihmember->update($request->all());

        return redirect()->route('admin.cihmembers.index');
    }

    public function show(Cihmember $cihmember)
    {
        abort_if(Gate::denies('cihmember_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihmember->load('zone', 'cih', 'created_by');

        return view('admin.cihmembers.show', compact('cihmember'));
    }

    public function destroy(Cihmember $cihmember)
    {
        abort_if(Gate::denies('cihmember_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihmember->delete();

        return back();
    }

    public function massDestroy(MassDestroyCihmemberRequest $request)
    {
        $cihmembers = Cihmember::find(request('ids'));

        foreach ($cihmembers as $cihmember) {
            $cihmember->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
