<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMfRequest;
use App\Http\Requests\StoreMfRequest;
use App\Http\Requests\UpdateMfRequest;
use App\Models\Mf;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MfController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mf_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mfs = Mf::with(['created_by'])->get();

        return view('admin.mfs.index', compact('mfs'));
    }

    public function create()
    {
        abort_if(Gate::denies('mf_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mfs.create');
    }

    public function store(StoreMfRequest $request)
    {
        $mf = Mf::create($request->all());

        return redirect()->route('admin.mfs.index');
    }

    public function edit(Mf $mf)
    {
        abort_if(Gate::denies('mf_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mf->load('created_by');

        return view('admin.mfs.edit', compact('mf'));
    }

    public function update(UpdateMfRequest $request, Mf $mf)
    {
        $mf->update($request->all());

        return redirect()->route('admin.mfs.index');
    }

    public function show(Mf $mf)
    {
        abort_if(Gate::denies('mf_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mf->load('created_by');

        return view('admin.mfs.show', compact('mf'));
    }

    public function destroy(Mf $mf)
    {
        abort_if(Gate::denies('mf_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mf->delete();

        return back();
    }

    public function massDestroy(MassDestroyMfRequest $request)
    {
        Mf::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
