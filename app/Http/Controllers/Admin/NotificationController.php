<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNotificationRequest;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Notification::with(['phone_number', 'emails', 'created_by'])->select(sprintf('%s.*', (new Notification())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'notification_show';
                $editGate = 'notification_edit';
                $deleteGate = 'notification_delete';
                $crudRoutePart = 'notifications';

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
            $table->editColumn('message_title', function ($row) {
                return $row->message_title ? $row->message_title : '';
            });
            $table->addColumn('phone_number_name', function ($row) {
                return $row->phone_number ? $row->phone_number->name : '';
            });

            $table->editColumn('phone_number.mobile', function ($row) {
                return $row->phone_number ? (is_string($row->phone_number) ? $row->phone_number : $row->phone_number->mobile) : '';
            });
            $table->editColumn('email', function ($row) {
                $labels = [];
                foreach ($row->emails as $email) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $email->email);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'phone_number', 'email']);

            return $table->make(true);
        }

        return view('admin.notifications.index');
    }

    public function create()
    {
        abort_if(Gate::denies('notification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone_numbers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emails = User::pluck('email', 'id');

        return view('admin.notifications.create', compact('emails', 'phone_numbers'));
    }

    public function store(StoreNotificationRequest $request)
    {
        $notification = Notification::create($request->all());
        $notification->emails()->sync($request->input('emails', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $notification->id]);
        }

        return redirect()->route('admin.notifications.index');
    }

    public function edit(Notification $notification)
    {
        abort_if(Gate::denies('notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone_numbers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emails = User::pluck('email', 'id');

        $notification->load('phone_number', 'emails', 'created_by');

        return view('admin.notifications.edit', compact('emails', 'notification', 'phone_numbers'));
    }

    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $notification->update($request->all());
        $notification->emails()->sync($request->input('emails', []));

        return redirect()->route('admin.notifications.index');
    }

    public function show(Notification $notification)
    {
        abort_if(Gate::denies('notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification->load('phone_number', 'emails', 'created_by');

        return view('admin.notifications.show', compact('notification'));
    }

    public function destroy(Notification $notification)
    {
        abort_if(Gate::denies('notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification->delete();

        return back();
    }

    public function massDestroy(MassDestroyNotificationRequest $request)
    {
        Notification::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('notification_create') && Gate::denies('notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Notification();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
