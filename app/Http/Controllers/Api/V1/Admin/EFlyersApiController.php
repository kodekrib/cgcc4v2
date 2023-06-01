<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEFlyerRequest;
use App\Http\Requests\UpdateEFlyerRequest;
use App\Http\Resources\Admin\EFlyerResource;
use App\Models\EFlyer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EFlyersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('e_flyer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EFlyerResource(EFlyer::all());
    }

    public function store(StoreEFlyerRequest $request)
    {
        $eFlyer = EFlyer::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $eFlyer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        return (new EFlyerResource($eFlyer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EFlyer $eFlyer)
    {
        abort_if(Gate::denies('e_flyer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EFlyerResource($eFlyer);
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

        return (new EFlyerResource($eFlyer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EFlyer $eFlyer)
    {
        abort_if(Gate::denies('e_flyer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eFlyer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
