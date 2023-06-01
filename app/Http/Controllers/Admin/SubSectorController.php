<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySubSectorRequest;
use App\Http\Requests\StoreSubSectorRequest;
use App\Http\Requests\UpdateSubSectorRequest;
use App\Models\IndustrySector;
use App\Models\SubSector;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubSectorController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sub_sector_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubSector::with(['industry'])->select(sprintf('%s.*', (new SubSector())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sub_sector_show';
                $editGate = 'sub_sector_edit';
                $deleteGate = 'sub_sector_delete';
                $crudRoutePart = 'sub-sectors';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('industry_industry', function ($row) {
                return $row->industry ? $row->industry->industry : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'industry']);

            return $table->make(true);
        }

        return view('admin.subSectors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sub_sector_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industries = IndustrySector::pluck('industry', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subSectors.create', compact('industries'));
    }

    public function store(StoreSubSectorRequest $request)
    {
        $subSector = SubSector::create($request->all());

        return redirect()->route('admin.sub-sectors.index');
    }

    public function edit(SubSector $subSector)
    {
        abort_if(Gate::denies('sub_sector_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industries = IndustrySector::pluck('industry', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subSector->load('industry');

        return view('admin.subSectors.edit', compact('industries', 'subSector'));
    }

    public function update(UpdateSubSectorRequest $request, SubSector $subSector)
    {
        $subSector->update($request->all());

        return redirect()->route('admin.sub-sectors.index');
    }

    public function show(SubSector $subSector)
    {
        abort_if(Gate::denies('sub_sector_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subSector->load('industry');

        return view('admin.subSectors.show', compact('subSector'));
    }

    public function destroy(SubSector $subSector)
    {
        abort_if(Gate::denies('sub_sector_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subSector->delete();

        return back();
    }

    public function massDestroy(MassDestroySubSectorRequest $request)
    {
        SubSector::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
