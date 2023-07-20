<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySpouseDetailRequest;
use App\Http\Requests\StoreSpouseDetailRequest;
use App\Http\Requests\UpdateSpouseDetailRequest;
use App\Models\SpouseDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpouseDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('spouse_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spouseDetails = SpouseDetail::with(['created_by'])->get();

        return view('admin.spouseDetails.index', compact('spouseDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('spouse_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.spouseDetails.create');
    }

    public function store(StoreSpouseDetailRequest $request)
    {

        // Check if a record already exists
        if (SpouseDetail::count() > 0) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Oops! Looks like you are already married to an amazing spouse. No room for another! 🤵❤️👰']);
        }
        
        $spouseDetail = SpouseDetail::create($request->all());

        return redirect()->route('admin.spouse-details.index');
    }

    public function edit(SpouseDetail $spouseDetail)
    {
        abort_if(Gate::denies('spouse_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spouseDetail->load('created_by');

        return view('admin.spouseDetails.edit', compact('spouseDetail'));
    }

    public function update(UpdateSpouseDetailRequest $request, SpouseDetail $spouseDetail)
    {
        $spouseDetail->update($request->all());

        return redirect()->route('admin.spouse-details.index');
    }

    public function show(SpouseDetail $spouseDetail)
    {
        abort_if(Gate::denies('spouse_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spouseDetail->load('created_by');

        return view('admin.spouseDetails.show', compact('spouseDetail'));
    }

    public function destroy(SpouseDetail $spouseDetail)
    {
        abort_if(Gate::denies('spouse_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spouseDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroySpouseDetailRequest $request)
    {
        $spouseDetails = SpouseDetail::find(request('ids'));

        foreach ($spouseDetails as $spouseDetail) {
            $spouseDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
