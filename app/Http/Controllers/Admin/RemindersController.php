<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReminderRequest;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Models\Member;
use App\Models\Reminder;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RemindersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reminders = Reminder::all();

        return view('admin.reminders.index', compact('reminders'));
    }

    public function create()
    {
        abort_if(Gate::denies('reminder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reminders.create');
    }

    public function store(StoreReminderRequest $request)
    {
        $userEmail =Auth::user()->email;
        $member = Member::where('email', $userEmail)->first();
        $request['member_id'] = $member->id;
        $reminder = Reminder::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $reminder->id]);
        }

        return redirect()->route('admin.reminders.index');
    }

    public function edit(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reminders.edit', compact('reminder'));
    }

    public function update(UpdateReminderRequest $request, Reminder $reminder)
    {
        $userEmail =Auth::user()->email;
        $member = Member::where('email', $userEmail)->first();
        $request['member_id'] = $member->id;
        $reminder->update($request->all());

        return redirect()->route('admin.reminders.index');
    }

    public function show(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reminders.show', compact('reminder'));
    }

    public function destroy(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reminder->delete();

        return back();
    }

    public function massDestroy(MassDestroyReminderRequest $request)
    {
        Reminder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('reminder_create') && Gate::denies('reminder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Reminder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
