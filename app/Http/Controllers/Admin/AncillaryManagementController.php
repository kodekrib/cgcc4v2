<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAncillaryManagementRequest;
use App\Http\Requests\StoreAncillaryManagementRequest;
use App\Http\Requests\UpdateAncillaryManagementRequest;
use App\Models\AncillaryManagement;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AncillaryManagementController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ancillary_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AncillaryManagement::with(['service_type', 'created_by'])->select(sprintf('%s.*', (new AncillaryManagement())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ancillary_management_show';
                $editGate = 'ancillary_management_edit';
                $deleteGate = 'ancillary_management_delete';
                $crudRoutePart = 'ancillary-managements';

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

            $table->addColumn('service_type_service_type', function ($row) {
                return $row->service_type ? $row->service_type->service_type : '';
            });

            $table->editColumn('approve', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->approve ? 'checked' : null) . '>';
            });
            $table->editColumn('decline', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->decline ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'service_type', 'approve', 'decline']);

            return $table->make(true);
        }

        return view('admin.ancillaryManagements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ancillary_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_types = ServiceType::pluck('service_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ancillaryManagements.create', compact('service_types'));
    }

    public function store(StoreAncillaryManagementRequest $request)
    {
        $ancillaryManagement = AncillaryManagement::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ancillaryManagement->id]);
        }

        return redirect()->route('admin.ancillary-managements.index');
    }

    public function edit(AncillaryManagement $ancillaryManagement)
    {
        abort_if(Gate::denies('ancillary_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_types = ServiceType::pluck('service_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ancillaryManagement->load('service_type', 'created_by');

        return view('admin.ancillaryManagements.edit', compact('ancillaryManagement', 'service_types'));
    }

    public function update(UpdateAncillaryManagementRequest $request, AncillaryManagement $ancillaryManagement)
    {
        $ancillaryManagement->update($request->all());

        return redirect()->route('admin.ancillary-managements.index');
    }

    public function show(AncillaryManagement $ancillaryManagement)
    {
        abort_if(Gate::denies('ancillary_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ancillaryManagement->load('service_type', 'created_by');

        return view('admin.ancillaryManagements.show', compact('ancillaryManagement'));
    }

    public function destroy(AncillaryManagement $ancillaryManagement)
    {
        abort_if(Gate::denies('ancillary_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ancillaryManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyAncillaryManagementRequest $request)
    {
        AncillaryManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ancillary_management_create') && Gate::denies('ancillary_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AncillaryManagement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
