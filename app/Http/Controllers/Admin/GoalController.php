<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGoalRequest;
use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Models\Goal;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GoalController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('goal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Goal::with(['created_by'])->select(sprintf('%s.*', (new Goal())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'goal_show';
                $editGate = 'goal_edit';
                $deleteGate = 'goal_delete';
                $crudRoutePart = 'goals';

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

            $table->editColumn('goal_name', function ($row) {
                return $row->goal_name ? $row->goal_name : '';
            });

            $table->editColumn('goal_kpi', function ($row) {
                return $row->goal_kpi ? $row->goal_kpi : '';
            });
            $table->editColumn('open', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->open ? 'checked' : null) . '>';
            });
            $table->editColumn('in_progress', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->in_progress ? 'checked' : null) . '>';
            });
            $table->editColumn('not_archieved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->not_archieved ? 'checked' : null) . '>';
            });
            $table->editColumn('closed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->closed ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'open', 'in_progress', 'not_archieved', 'closed']);

            return $table->make(true);
        }

        return view('admin.goals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('goal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.goals.create');
    }

    public function store(StoreGoalRequest $request)
    {
        $goal = Goal::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $goal->id]);
        }

        return redirect()->route('admin.goals.index');
    }

    public function edit(Goal $goal)
    {
        abort_if(Gate::denies('goal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goal->load('created_by');

        return view('admin.goals.edit', compact('goal'));
    }

    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $goal->update($request->all());

        return redirect()->route('admin.goals.index');
    }

    public function show(Goal $goal)
    {
        abort_if(Gate::denies('goal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goal->load('created_by');

        return view('admin.goals.show', compact('goal'));
    }

    public function destroy(Goal $goal)
    {
        abort_if(Gate::denies('goal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goal->delete();

        return back();
    }

    public function massDestroy(MassDestroyGoalRequest $request)
    {
        Goal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('goal_create') && Gate::denies('goal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Goal();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
