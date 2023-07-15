<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInterestRequest;
use App\Http\Requests\StoreInterestRequest;
use App\Http\Requests\UpdateInterestRequest;
use App\Models\IndustrySector;
use App\Models\Interest;
use App\Models\Sport;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InterestsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('interest_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interests = Interest::with(['interests', 'industry_sector', 'created_by'])->get();

        return view('admin.interests.index', compact('interests'));
    }

    public function create()
    {
        abort_if(Gate::denies('interest_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interests = Sport::pluck('sports', 'id');

        $industry_sectors = IndustrySector::pluck('industry', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.interests.create', compact('industry_sectors', 'interests'));
    }

    public function store(StoreInterestRequest $request)
    {
<<<<<<< HEAD
        // Check if a record already exists
        if (Interest::count() > 0) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Only one interest record is allowed']);
        }
        
=======
>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
        $interest = Interest::create($request->all());
        $interest->interests()->sync($request->input('interests', []));

        return redirect()->route('admin.interests.index');
    }

    public function edit(Interest $interest)
    {
        abort_if(Gate::denies('interest_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interests = Sport::pluck('sports', 'id');

        $industry_sectors = IndustrySector::pluck('industry', 'id')->prepend(trans('global.pleaseSelect'), '');

        $interest->load('interests', 'industry_sector', 'created_by');

        return view('admin.interests.edit', compact('industry_sectors', 'interest', 'interests'));
    }

    public function update(UpdateInterestRequest $request, Interest $interest)
    {
        $interest->update($request->all());
        $interest->interests()->sync($request->input('interests', []));

        return redirect()->route('admin.interests.index');
    }

    public function show(Interest $interest)
    {
        abort_if(Gate::denies('interest_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interest->load('interests', 'industry_sector', 'created_by');

        return view('admin.interests.show', compact('interest'));
    }

    public function destroy(Interest $interest)
    {
        abort_if(Gate::denies('interest_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interest->delete();

        return back();
    }

    public function massDestroy(MassDestroyInterestRequest $request)
    {
        Interest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
