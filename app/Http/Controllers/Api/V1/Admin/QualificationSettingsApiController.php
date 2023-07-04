<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQualificationSettingRequest;
use App\Http\Requests\UpdateQualificationSettingRequest;
use App\Http\Resources\Admin\QualificationSettingResource;
use App\Models\QualificationSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QualificationSettingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qualification_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QualificationSettingResource(QualificationSetting::all());
    }

    public function store(StoreQualificationSettingRequest $request)
    {
        $qualificationSetting = QualificationSetting::create($request->all());

        return (new QualificationSettingResource($qualificationSetting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QualificationSetting $qualificationSetting)
    {
        abort_if(Gate::denies('qualification_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QualificationSettingResource($qualificationSetting);
    }

    public function update(UpdateQualificationSettingRequest $request, QualificationSetting $qualificationSetting)
    {
        $qualificationSetting->update($request->all());

        return (new QualificationSettingResource($qualificationSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QualificationSetting $qualificationSetting)
    {
        abort_if(Gate::denies('qualification_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualificationSetting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
