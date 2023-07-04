<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVenueAccessoryRequest;
use App\Http\Requests\StoreVenueAccessoryRequest;
use App\Http\Requests\UpdateVenueAccessoryRequest;
use App\Models\VenueAccessory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VenueAccessoriesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('venue_accessory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VenueAccessory::query()->select(sprintf('%s.*', (new VenueAccessory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'venue_accessory_show';
                $editGate = 'venue_accessory_edit';
                $deleteGate = 'venue_accessory_delete';
                $crudRoutePart = 'venue-accessories';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('accessories', function ($row) {
                return $row->accessories ? $row->accessories : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.venueAccessories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('venue_accessory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueAccessories.create');
    }

    public function store(StoreVenueAccessoryRequest $request)
    {
        $venueAccessory = VenueAccessory::create($request->all());

        return redirect()->route('admin.venue-accessories.index');
    }

    public function edit(VenueAccessory $venueAccessory)
    {
        abort_if(Gate::denies('venue_accessory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueAccessories.edit', compact('venueAccessory'));
    }

    public function update(UpdateVenueAccessoryRequest $request, VenueAccessory $venueAccessory)
    {
        $venueAccessory->update($request->all());

        return redirect()->route('admin.venue-accessories.index');
    }

    public function show(VenueAccessory $venueAccessory)
    {
        abort_if(Gate::denies('venue_accessory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueAccessory->load('accessoriesEquipmentVenues');

        return view('admin.venueAccessories.show', compact('venueAccessory'));
    }

    public function destroy(VenueAccessory $venueAccessory)
    {
        abort_if(Gate::denies('venue_accessory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueAccessory->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueAccessoryRequest $request)
    {
        VenueAccessory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
