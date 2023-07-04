<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDedicationRequest;
use App\Http\Requests\StoreDedicationRequest;
use App\Http\Requests\UpdateDedicationRequest;
use App\Models\Dedication;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DedicationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dedication_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dedications = Dedication::with(['created_by'])->get();

        return view('admin.dedications.index', compact('dedications'));
    }

    public function create()
    {
        abort_if(Gate::denies('dedication_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dedications.create');
    }

    public function store(StoreDedicationRequest $request)
    {
        $dedication = Dedication::create($request->all());

        return redirect()->route('admin.dedications.index');
    }

    public function edit(Dedication $dedication)
    {
        abort_if(Gate::denies('dedication_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dedication->load('created_by');

        return view('admin.dedications.edit', compact('dedication'));
    }

    public function update(UpdateDedicationRequest $request, Dedication $dedication)
    {
        $dedication->update($request->all());

        return redirect()->route('admin.dedications.index');
    }

    public function show(Dedication $dedication)
    {
        abort_if(Gate::denies('dedication_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dedication->load('created_by');

        return view('admin.dedications.show', compact('dedication'));
    }

    public function destroy(Dedication $dedication)
    {
        abort_if(Gate::denies('dedication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dedication->delete();

        return back();
    }

    public function massDestroy(MassDestroyDedicationRequest $request)
    {
        $dedications = Dedication::find(request('ids'));

        foreach ($dedications as $dedication) {
            $dedication->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
