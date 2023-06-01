<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccessibilityFeatureRequest;
use App\Http\Requests\StoreAccessibilityFeatureRequest;
use App\Http\Requests\UpdateAccessibilityFeatureRequest;
use App\Models\AccessibilityFeature;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccessibilityFeaturesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('accessibility_feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AccessibilityFeature::query()->select(sprintf('%s.*', (new AccessibilityFeature())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'accessibility_feature_show';
                $editGate = 'accessibility_feature_edit';
                $deleteGate = 'accessibility_feature_delete';
                $crudRoutePart = 'accessibility-features';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.accessibilityFeatures.index');
    }

    public function create()
    {
        abort_if(Gate::denies('accessibility_feature_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accessibilityFeatures.create');
    }

    public function store(StoreAccessibilityFeatureRequest $request)
    {
        $accessibilityFeature = AccessibilityFeature::create($request->all());

        return redirect()->route('admin.accessibility-features.index');
    }

    public function edit(AccessibilityFeature $accessibilityFeature)
    {
        abort_if(Gate::denies('accessibility_feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accessibilityFeatures.edit', compact('accessibilityFeature'));
    }

    public function update(UpdateAccessibilityFeatureRequest $request, AccessibilityFeature $accessibilityFeature)
    {
        $accessibilityFeature->update($request->all());

        return redirect()->route('admin.accessibility-features.index');
    }

    public function show(AccessibilityFeature $accessibilityFeature)
    {
        abort_if(Gate::denies('accessibility_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accessibilityFeatures.show', compact('accessibilityFeature'));
    }

    public function destroy(AccessibilityFeature $accessibilityFeature)
    {
        abort_if(Gate::denies('accessibility_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessibilityFeature->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccessibilityFeatureRequest $request)
    {
        AccessibilityFeature::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
