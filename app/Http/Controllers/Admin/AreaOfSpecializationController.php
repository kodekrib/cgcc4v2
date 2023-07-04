<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAreaOfSpecializationRequest;
use App\Http\Requests\StoreAreaOfSpecializationRequest;
use App\Http\Requests\UpdateAreaOfSpecializationRequest;
use App\Models\AreaOfSpecialization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AreaOfSpecializationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('area_of_specialization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AreaOfSpecialization::query()->select(sprintf('%s.*', (new AreaOfSpecialization())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'area_of_specialization_show';
                $editGate = 'area_of_specialization_edit';
                $deleteGate = 'area_of_specialization_delete';
                $crudRoutePart = 'area-of-specializations';

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
            $table->editColumn('area_of_specialization', function ($row) {
                return $row->area_of_specialization ? $row->area_of_specialization : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.areaOfSpecializations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('area_of_specialization_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.areaOfSpecializations.create');
    }

    public function store(StoreAreaOfSpecializationRequest $request)
    {
        $areaOfSpecialization = AreaOfSpecialization::create($request->all());

        return redirect()->route('admin.area-of-specializations.index');
    }

    public function edit(AreaOfSpecialization $areaOfSpecialization)
    {
        abort_if(Gate::denies('area_of_specialization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.areaOfSpecializations.edit', compact('areaOfSpecialization'));
    }

    public function update(UpdateAreaOfSpecializationRequest $request, AreaOfSpecialization $areaOfSpecialization)
    {
        $areaOfSpecialization->update($request->all());

        return redirect()->route('admin.area-of-specializations.index');
    }

    public function show(AreaOfSpecialization $areaOfSpecialization)
    {
        abort_if(Gate::denies('area_of_specialization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.areaOfSpecializations.show', compact('areaOfSpecialization'));
    }

    public function destroy(AreaOfSpecialization $areaOfSpecialization)
    {
        abort_if(Gate::denies('area_of_specialization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areaOfSpecialization->delete();

        return back();
    }

    public function massDestroy(MassDestroyAreaOfSpecializationRequest $request)
    {
        AreaOfSpecialization::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
