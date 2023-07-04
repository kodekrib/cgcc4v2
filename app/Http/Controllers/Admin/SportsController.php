<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySportRequest;
use App\Http\Requests\StoreSportRequest;
use App\Http\Requests\UpdateSportRequest;
use App\Models\Sport;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SportsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('sport_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sport::query()->select(sprintf('%s.*', (new Sport())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sport_show';
                $editGate = 'sport_edit';
                $deleteGate = 'sport_delete';
                $crudRoutePart = 'sports';

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
            $table->editColumn('sports', function ($row) {
                return $row->sports ? $row->sports : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.sports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sport_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sports.create');
    }

    public function store(StoreSportRequest $request)
    {
        $sport = Sport::create($request->all());

        return redirect()->route('admin.sports.index');
    }

    public function edit(Sport $sport)
    {
        abort_if(Gate::denies('sport_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sports.edit', compact('sport'));
    }

    public function update(UpdateSportRequest $request, Sport $sport)
    {
        $sport->update($request->all());

        return redirect()->route('admin.sports.index');
    }

    public function show(Sport $sport)
    {
        abort_if(Gate::denies('sport_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sports.show', compact('sport'));
    }

    public function destroy(Sport $sport)
    {
        abort_if(Gate::denies('sport_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sport->delete();

        return back();
    }

    public function massDestroy(MassDestroySportRequest $request)
    {
        Sport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
