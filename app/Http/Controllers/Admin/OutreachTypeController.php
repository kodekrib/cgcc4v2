<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOutreachTypeRequest;
use App\Http\Requests\StoreOutreachTypeRequest;
use App\Http\Requests\UpdateOutreachTypeRequest;
use App\Models\OutreachType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OutreachTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('outreach_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OutreachType::query()->select(sprintf('%s.*', (new OutreachType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'outreach_type_show';
                $editGate = 'outreach_type_edit';
                $deleteGate = 'outreach_type_delete';
                $crudRoutePart = 'outreach-types';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.outreachTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('outreach_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.outreachTypes.create');
    }

    public function store(StoreOutreachTypeRequest $request)
    {
        $outreachType = OutreachType::create($request->all());

        return redirect()->route('admin.outreach-types.index');
    }

    public function edit(OutreachType $outreachType)
    {
        abort_if(Gate::denies('outreach_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.outreachTypes.edit', compact('outreachType'));
    }

    public function update(UpdateOutreachTypeRequest $request, OutreachType $outreachType)
    {
        $outreachType->update($request->all());

        return redirect()->route('admin.outreach-types.index');
    }

    public function show(OutreachType $outreachType)
    {
        abort_if(Gate::denies('outreach_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.outreachTypes.show', compact('outreachType'));
    }

    public function destroy(OutreachType $outreachType)
    {
        abort_if(Gate::denies('outreach_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outreachType->delete();

        return back();
    }

    public function massDestroy(MassDestroyOutreachTypeRequest $request)
    {
        $outreachTypes = OutreachType::find(request('ids'));

        foreach ($outreachTypes as $outreachType) {
            $outreachType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
