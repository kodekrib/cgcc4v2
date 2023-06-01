<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCihzoneRequest;
use App\Http\Requests\StoreCihzoneRequest;
use App\Http\Requests\UpdateCihzoneRequest;
use App\Models\Cihzone;
use App\Models\Member;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihzonesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('cihzone_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihzones = Cihzone::with(['coordinator', 'created_by'])->get();

        return view('admin.cihzones.index', compact('cihzones'));
    }

    public function create()
    {
        abort_if(Gate::denies('cihzone_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coordinators = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cihzones.create', compact('coordinators'));
    }

    public function store(StoreCihzoneRequest $request)
    {
        $cihzone = Cihzone::create($request->all());

        return redirect()->route('admin.cihzones.index');
    }

    public function edit(Cihzone $cihzone)
    {
        abort_if(Gate::denies('cihzone_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coordinators = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cihzone->load('coordinator', 'created_by');

        return view('admin.cihzones.edit', compact('cihzone', 'coordinators'));
    }

    public function update(UpdateCihzoneRequest $request, Cihzone $cihzone)
    {
        $cihzone->update($request->all());

        return redirect()->route('admin.cihzones.index');
    }

    public function show(Cihzone $cihzone)
    {
        abort_if(Gate::denies('cihzone_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihzone->load('coordinator', 'created_by');

        return view('admin.cihzones.show', compact('cihzone'));
    }

    public function destroy(Cihzone $cihzone)
    {
        abort_if(Gate::denies('cihzone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihzone->delete();

        return back();
    }

    public function massDestroy(MassDestroyCihzoneRequest $request)
    {
        $cihzones = Cihzone::find(request('ids'));

        foreach ($cihzones as $cihzone) {
            $cihzone->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
