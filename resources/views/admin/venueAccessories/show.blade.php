@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.venueAccessory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-accessories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.venueAccessory.fields.id') }}
                        </th>
                        <td>
                            {{ $venueAccessory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueAccessory.fields.accessories') }}
                        </th>
                        <td>
                            {{ $venueAccessory->accessories }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-accessories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#accessories_equipment_venues" role="tab" data-toggle="tab">
                {{ trans('cruds.venue.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="accessories_equipment_venues">
            @includeIf('admin.venueAccessories.relationships.accessoriesEquipmentVenues', ['venues' => $venueAccessory->accessoriesEquipmentVenues])
        </div>
    </div>
</div>

@endsection