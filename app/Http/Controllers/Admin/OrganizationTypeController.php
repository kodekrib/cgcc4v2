<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrganizationTypeRequest;
use App\Http\Requests\StoreOrganizationTypeRequest;
use App\Http\Requests\UpdateOrganizationTypeRequest;
use App\Models\OrganizationType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('organization_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizationTypes = OrganizationType::all();

        return view('admin.organizationTypes.index', compact('organizationTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('organization_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizationTypes.create');
    }

    public function store(StoreOrganizationTypeRequest $request)
    {
        $organizationType = OrganizationType::create($request->all());

        return redirect()->route('admin.organization-types.index');
    }

    public function edit(OrganizationType $organizationType)
    {
        abort_if(Gate::denies('organization_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizationTypes.edit', compact('organizationType'));
    }

    public function update(UpdateOrganizationTypeRequest $request, OrganizationType $organizationType)
    {
        $organizationType->update($request->all());

        return redirect()->route('admin.organization-types.index');
    }

    public function show(OrganizationType $organizationType)
    {
        abort_if(Gate::denies('organization_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizationTypes.show', compact('organizationType'));
    }

    public function destroy(OrganizationType $organizationType)
    {
        abort_if(Gate::denies('organization_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizationType->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganizationTypeRequest $request)
    {
        OrganizationType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
