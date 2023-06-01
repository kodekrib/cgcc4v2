<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEFlyerRequest;
use App\Http\Requests\StoreEFlyerRequest;
use App\Http\Requests\UpdateEFlyerRequest;
use App\Models\EFlyer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EFlyersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('e_flyer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eFlyers = EFlyer::with(['media'])->get();

        return view('admin.eFlyers.index', compact('eFlyers'));
    }

    public function create()
    {
        abort_if(Gate::denies('e_flyer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eFlyers.create');
    }

    public function store(StoreEFlyerRequest $request)
    {
        $eFlyer = EFlyer::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $eFlyer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $eFlyer->id]);
        }

        return redirect()->route('admin.e-flyers.index');
    }

    public function edit(EFlyer $eFlyer)
    {
        abort_if(Gate::denies('e_flyer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eFlyers.edit', compact('eFlyer'));
    }

    public function update(UpdateEFlyerRequest $request, EFlyer $eFlyer)
    {
        $eFlyer->update($request->all());

        if (count($eFlyer->image) > 0) {
            foreach ($eFlyer->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $eFlyer->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $eFlyer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.e-flyers.index');
    }

    public function show(EFlyer $eFlyer)
    {
        abort_if(Gate::denies('e_flyer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eFlyers.show', compact('eFlyer'));
    }

    public function destroy(EFlyer $eFlyer)
    {
        abort_if(Gate::denies('e_flyer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eFlyer->delete();

        return back();
    }

    public function massDestroy(MassDestroyEFlyerRequest $request)
    {
        EFlyer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('e_flyer_create') && Gate::denies('e_flyer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EFlyer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
