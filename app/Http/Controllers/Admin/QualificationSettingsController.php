<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQualificationSettingRequest;
use App\Http\Requests\StoreQualificationSettingRequest;
use App\Http\Requests\UpdateQualificationSettingRequest;
use App\Models\QualificationSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QualificationSettingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qualification_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualificationSettings = QualificationSetting::all();

        return view('admin.qualificationSettings.index', compact('qualificationSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('qualification_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.qualificationSettings.create');
    }

    public function store(StoreQualificationSettingRequest $request)
    {
        $qualificationSetting = QualificationSetting::create($request->all());

        return redirect()->route('admin.qualification-settings.index');
    }

    public function edit(QualificationSetting $qualificationSetting)
    {
        abort_if(Gate::denies('qualification_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.qualificationSettings.edit', compact('qualificationSetting'));
    }

    public function update(UpdateQualificationSettingRequest $request, QualificationSetting $qualificationSetting)
    {
        $qualificationSetting->update($request->all());

        return redirect()->route('admin.qualification-settings.index');
    }

    public function show(QualificationSetting $qualificationSetting)
    {
        abort_if(Gate::denies('qualification_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.qualificationSettings.show', compact('qualificationSetting'));
    }

    public function destroy(QualificationSetting $qualificationSetting)
    {
        abort_if(Gate::denies('qualification_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualificationSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyQualificationSettingRequest $request)
    {
        QualificationSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
