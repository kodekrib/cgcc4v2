<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFirstTimerRequest;
use App\Http\Requests\StoreFirstTimerRequest;
use App\Http\Requests\UpdateFirstTimerRequest;
use App\Models\FirstTimer;
use App\Models\MaritalStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirstTimerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('first_timer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $firstTimers = FirstTimer::with(['marital_status'])->get();

        return view('admin.firstTimers.index', compact('firstTimers'));
    }

    public function create()
    {
        abort_if(Gate::denies('first_timer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marital_statuses = MaritalStatus::pluck('marital_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jsonCountry = file_get_contents('Json/countries.json');
        $json_Countrydata = json_decode($jsonCountry,true);

        $countries = $json_Countrydata; //Country::all();

        $jsonState = file_get_contents('Json/nigeria-state-and-lgas.json');
        $json_Statedata = json_decode($jsonState,true);

        $states = $json_Statedata; //State::all();

        return view('admin.firstTimers.create', compact('countries', 'states', 'marital_statuses'));
    }

    public function store(StoreFirstTimerRequest $request)
    {
        $firstTimer = FirstTimer::create($request->all());

        return redirect()->route('admin.first-timers.index');
    }

    public function edit(FirstTimer $firstTimer)
    {
        abort_if(Gate::denies('first_timer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marital_statuses = MaritalStatus::pluck('marital_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $firstTimer->load('marital_status');

        $jsonCountry = file_get_contents('Json/countries.json');
        $json_Countrydata = json_decode($jsonCountry,true);

        $countries = $json_Countrydata; //Country::all();

        $jsonState = file_get_contents('Json/nigeria-state-and-lgas.json');
        $json_Statedata = json_decode($jsonState,true);

        $states = $json_Statedata; //State::all();

        return view('admin.firstTimers.edit', compact('countries', 'states', 'firstTimer', 'marital_statuses'));
    }

    public function update(UpdateFirstTimerRequest $request, FirstTimer $firstTimer)
    {
        $firstTimer->update($request->all());

        return redirect()->route('admin.first-timers.index');
    }

    public function show(FirstTimer $firstTimer)
    {
        abort_if(Gate::denies('first_timer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $firstTimer->load('marital_status');

        return view('admin.firstTimers.show', compact('firstTimer'));
    }

    public function destroy(FirstTimer $firstTimer)
    {
        abort_if(Gate::denies('first_timer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $firstTimer->delete();

        return back();
    }

    public function massDestroy(MassDestroyFirstTimerRequest $request)
    {
        $firstTimers = FirstTimer::find(request('ids'));

        foreach ($firstTimers as $firstTimer) {
            $firstTimer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
