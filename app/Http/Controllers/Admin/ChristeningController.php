<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChristeningRequest;
use App\Http\Requests\StoreChristeningRequest;
use App\Http\Requests\UpdateChristeningRequest;
use App\Models\Christening;
use App\Models\Cihzone;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChristeningController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('christening_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $christenings = Christening::with(['zone', 'created_by'])->get();

        return view('admin.christenings.index', compact('christenings'));
    }

    public function create()
    {
        abort_if(Gate::denies('christening_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zones = Cihzone::pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.christenings.create', compact('zones'));
    }

    public function store(StoreChristeningRequest $request)
    {
        $christening = Christening::create($request->all());

        return redirect()->route('admin.christenings.index');
    }

    public function edit(Christening $christening)
    {
        abort_if(Gate::denies('christening_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zones = Cihzone::pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $christening->load('zone', 'created_by');

        return view('admin.christenings.edit', compact('christening', 'zones'));
    }

    public function update(UpdateChristeningRequest $request, Christening $christening)
    {
        $christening->update($request->all());

        return redirect()->route('admin.christenings.index');
    }

    public function show(Christening $christening)
    {
        abort_if(Gate::denies('christening_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $christening->load('zone', 'created_by');

        return view('admin.christenings.show', compact('christening'));
    }

    public function destroy(Christening $christening)
    {
        abort_if(Gate::denies('christening_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $christening->delete();

        return back();
    }

    public function massDestroy(MassDestroyChristeningRequest $request)
    {
        $christenings = Christening::find(request('ids'));

        foreach ($christenings as $christening) {
            $christening->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
