<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmpowermentTrainingNeedRequest;
use App\Http\Requests\StoreEmpowermentTrainingNeedRequest;
use App\Http\Requests\UpdateEmpowermentTrainingNeedRequest;
use App\Models\EmpowermentTrainingNeed;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmpowermentTrainingNeedController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('empowerment_training_need_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EmpowermentTrainingNeed::query()->select(sprintf('%s.*', (new EmpowermentTrainingNeed())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'empowerment_training_need_show';
                $editGate = 'empowerment_training_need_edit';
                $deleteGate = 'empowerment_training_need_delete';
                $crudRoutePart = 'empowerment-training-needs';

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
            $table->editColumn('training_needs', function ($row) {
                return $row->training_needs ? $row->training_needs : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.empowermentTrainingNeeds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('empowerment_training_need_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empowermentTrainingNeeds.create');
    }

    public function store(StoreEmpowermentTrainingNeedRequest $request)
    {
        $empowermentTrainingNeed = EmpowermentTrainingNeed::create($request->all());

        return redirect()->route('admin.empowerment-training-needs.index');
    }

    public function edit(EmpowermentTrainingNeed $empowermentTrainingNeed)
    {
        abort_if(Gate::denies('empowerment_training_need_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empowermentTrainingNeeds.edit', compact('empowermentTrainingNeed'));
    }

    public function update(UpdateEmpowermentTrainingNeedRequest $request, EmpowermentTrainingNeed $empowermentTrainingNeed)
    {
        $empowermentTrainingNeed->update($request->all());

        return redirect()->route('admin.empowerment-training-needs.index');
    }

    public function show(EmpowermentTrainingNeed $empowermentTrainingNeed)
    {
        abort_if(Gate::denies('empowerment_training_need_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empowermentTrainingNeeds.show', compact('empowermentTrainingNeed'));
    }

    public function destroy(EmpowermentTrainingNeed $empowermentTrainingNeed)
    {
        abort_if(Gate::denies('empowerment_training_need_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empowermentTrainingNeed->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmpowermentTrainingNeedRequest $request)
    {
        EmpowermentTrainingNeed::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
