<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFlutterwaveApikeyRequest;
use App\Http\Requests\StoreFlutterwaveApikeyRequest;
use App\Http\Requests\UpdateFlutterwaveApikeyRequest;
use App\Models\FlutterwaveApikey;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlutterwaveApikeysController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('flutterwave_apikey_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $flutterwaveApikeys = FlutterwaveApikey::all();

        return view('admin.flutterwaveApikeys.index', compact('flutterwaveApikeys'));
    }

    public function create()
    {
        abort_if(Gate::denies('flutterwave_apikey_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.flutterwaveApikeys.create');
    }

    public function store(StoreFlutterwaveApikeyRequest $request)
    {
        $flutterwaveApikey = FlutterwaveApikey::create($request->all());

        return redirect()->route('admin.flutterwave-apikeys.index');
    }

    public function edit(FlutterwaveApikey $flutterwaveApikey)
    {
        abort_if(Gate::denies('flutterwave_apikey_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.flutterwaveApikeys.edit', compact('flutterwaveApikey'));
    }

    public function update(UpdateFlutterwaveApikeyRequest $request, FlutterwaveApikey $flutterwaveApikey)
    {
        $flutterwaveApikey->update($request->all());

        return redirect()->route('admin.flutterwave-apikeys.index');
    }

    public function show(FlutterwaveApikey $flutterwaveApikey)
    {
        abort_if(Gate::denies('flutterwave_apikey_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.flutterwaveApikeys.show', compact('flutterwaveApikey'));
    }

    public function destroy(FlutterwaveApikey $flutterwaveApikey)
    {
        abort_if(Gate::denies('flutterwave_apikey_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $flutterwaveApikey->delete();

        return back();
    }

    public function massDestroy(MassDestroyFlutterwaveApikeyRequest $request)
    {
        FlutterwaveApikey::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
