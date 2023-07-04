<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCihCentersInspectionRequest;
use App\Http\Requests\StoreCihCentersInspectionRequest;
use App\Http\Requests\UpdateCihCentersInspectionRequest;
use App\Models\Centre;
use App\Models\CihCentersInspection;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CihCentersInspectionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cih_centers_inspection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihCentersInspections = CihCentersInspection::with(['center_visited'])->get();

        return view('admin.cihCentersInspections.index', compact('cihCentersInspections'));
    }

    public function create()
    {
        abort_if(Gate::denies('cih_centers_inspection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $center_visiteds = Centre::pluck('cih_centre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cihCentersInspections.create', compact('center_visiteds'));
    }

    public function store(StoreCihCentersInspectionRequest $request)
    {
        $cihCentersInspection = CihCentersInspection::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cihCentersInspection->id]);
        }

        return redirect()->route('admin.cih-centers-inspections.index');
    }

    public function edit(CihCentersInspection $cihCentersInspection)
    {
        abort_if(Gate::denies('cih_centers_inspection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $center_visiteds = Centre::pluck('cih_centre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cihCentersInspection->load('center_visited');

        return view('admin.cihCentersInspections.edit', compact('center_visiteds', 'cihCentersInspection'));
    }

    public function update(UpdateCihCentersInspectionRequest $request, CihCentersInspection $cihCentersInspection)
    {
        $cihCentersInspection->update($request->all());

        return redirect()->route('admin.cih-centers-inspections.index');
    }

    public function show(CihCentersInspection $cihCentersInspection)
    {
        abort_if(Gate::denies('cih_centers_inspection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihCentersInspection->load('center_visited');

        return view('admin.cihCentersInspections.show', compact('cihCentersInspection'));
    }

    public function destroy(CihCentersInspection $cihCentersInspection)
    {
        abort_if(Gate::denies('cih_centers_inspection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihCentersInspection->delete();

        return back();
    }

    public function massDestroy(MassDestroyCihCentersInspectionRequest $request)
    {
        $cihCentersInspections = CihCentersInspection::find(request('ids'));

        foreach ($cihCentersInspections as $cihCentersInspection) {
            $cihCentersInspection->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cih_centers_inspection_create') && Gate::denies('cih_centers_inspection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CihCentersInspection();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
