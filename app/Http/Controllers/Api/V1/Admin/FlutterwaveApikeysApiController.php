<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlutterwaveApikeyRequest;
use App\Http\Requests\UpdateFlutterwaveApikeyRequest;
use App\Http\Resources\Admin\FlutterwaveApikeyResource;
use App\Models\FlutterwaveApikey;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlutterwaveApikeysApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('flutterwave_apikey_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FlutterwaveApikeyResource(FlutterwaveApikey::all());
    }

    public function store(StoreFlutterwaveApikeyRequest $request)
    {
        $flutterwaveApikey = FlutterwaveApikey::create($request->all());

        return (new FlutterwaveApikeyResource($flutterwaveApikey))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FlutterwaveApikey $flutterwaveApikey)
    {
        abort_if(Gate::denies('flutterwave_apikey_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FlutterwaveApikeyResource($flutterwaveApikey);
    }

    public function update(UpdateFlutterwaveApikeyRequest $request, FlutterwaveApikey $flutterwaveApikey)
    {
        $flutterwaveApikey->update($request->all());

        return (new FlutterwaveApikeyResource($flutterwaveApikey))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FlutterwaveApikey $flutterwaveApikey)
    {
        abort_if(Gate::denies('flutterwave_apikey_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $flutterwaveApikey->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
