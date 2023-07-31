<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmploymentDetailRequest;
use App\Http\Requests\StoreEmploymentDetailRequest;
use App\Http\Requests\UpdateEmploymentDetailRequest;
use App\Models\EmploymentDetail;
use App\Models\IndustrySector;
use App\Models\SubSector;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmploymentDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employment_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentDetails = EmploymentDetail::with(['industry', 'subsector', 'created_by'])->get();

        return view('admin.employmentDetails.index', compact('employmentDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('employment_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industries = IndustrySector::pluck('industry', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subsectors = SubSector::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $jsonCountry = file_get_contents('Json/countries.json');
        $json_Countrydata = json_decode($jsonCountry,true);
        $countries = $json_Countrydata;
        $jsonState = file_get_contents('Json/nigeria-state-and-lgas.json');
        $json_Statedata = json_decode($jsonState,true);
        $states = $json_Statedata;
        return view('admin.employmentDetails.create', compact('industries', 'subsectors', 'countries', 'states'));
    }

    public function store(StoreEmploymentDetailRequest $request)
    {

        // Check if a record already exists
        if (EmploymentDetail::count() > 0) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Only one Employment detail record is allowed']);
        }
        
        $request['created_by_id']= Auth::id();
        $employmentDetail = EmploymentDetail::create($request->all());

        return redirect()->route('admin.employment-details.index');
    }

    public function edit(EmploymentDetail $employmentDetail)
    {
        abort_if(Gate::denies('employment_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industries = IndustrySector::pluck('industry', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subsectors = SubSector::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employmentDetail->load('industry', 'subsector', 'created_by');
        $jsonCountry = file_get_contents('Json/countries.json');
        $json_Countrydata = json_decode($jsonCountry,true);
        $countries = $json_Countrydata;
        $jsonState = file_get_contents('Json/nigeria-state-and-lgas.json');
        $json_Statedata = json_decode($jsonState,true);
        $states = $json_Statedata;
        return view('admin.employmentDetails.edit', compact('employmentDetail', 'industries', 'subsectors', 'countries', 'states'));
    }

    public function update(UpdateEmploymentDetailRequest $request, EmploymentDetail $employmentDetail)
    {
        $employmentDetail->update($request->all());

        return redirect()->route('admin.employment-details.index');
    }

    public function show(EmploymentDetail $employmentDetail)
    {
        abort_if(Gate::denies('employment_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentDetail->load('industry', 'subsector', 'created_by');

        return view('admin.employmentDetails.show', compact('employmentDetail'));
    }

    public function destroy(EmploymentDetail $employmentDetail)
    {
        abort_if(Gate::denies('employment_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmploymentDetailRequest $request)
    {
        EmploymentDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
