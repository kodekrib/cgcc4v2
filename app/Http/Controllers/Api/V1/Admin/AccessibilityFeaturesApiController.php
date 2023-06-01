<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccessibilityFeatureRequest;
use App\Http\Requests\UpdateAccessibilityFeatureRequest;
use App\Http\Resources\Admin\AccessibilityFeatureResource;
use App\Models\AccessibilityFeature;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessibilityFeaturesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accessibility_feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccessibilityFeatureResource(AccessibilityFeature::all());
    }

    public function store(StoreAccessibilityFeatureRequest $request)
    {
        $accessibilityFeature = AccessibilityFeature::create($request->all());

        return (new AccessibilityFeatureResource($accessibilityFeature))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AccessibilityFeature $accessibilityFeature)
    {
        abort_if(Gate::denies('accessibility_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccessibilityFeatureResource($accessibilityFeature);
    }

    public function update(UpdateAccessibilityFeatureRequest $request, AccessibilityFeature $accessibilityFeature)
    {
        $accessibilityFeature->update($request->all());

        return (new AccessibilityFeatureResource($accessibilityFeature))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AccessibilityFeature $accessibilityFeature)
    {
        abort_if(Gate::denies('accessibility_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessibilityFeature->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
