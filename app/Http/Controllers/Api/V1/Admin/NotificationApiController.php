<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Http\Resources\Admin\NotificationResource;
use App\Models\Notification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NotificationResource(Notification::with(['phone_number', 'emails', 'created_by'])->get());
    }

    public function store(StoreNotificationRequest $request)
    {
        $notification = Notification::create($request->all());
        $notification->emails()->sync($request->input('emails', []));

        return (new NotificationResource($notification))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Notification $notification)
    {
        abort_if(Gate::denies('notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NotificationResource($notification->load(['phone_number', 'emails', 'created_by']));
    }

    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $notification->update($request->all());
        $notification->emails()->sync($request->input('emails', []));

        return (new NotificationResource($notification))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Notification $notification)
    {
        abort_if(Gate::denies('notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
