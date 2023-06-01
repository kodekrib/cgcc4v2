<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChatManagementRequest;
use App\Http\Requests\StoreChatManagementRequest;
use App\Http\Requests\UpdateChatManagementRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatManagementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('chat_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chatManagements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('chat_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chatManagements.create');
    }

    public function store(StoreChatManagementRequest $request)
    {
        $chatManagement = ChatManagement::create($request->all());

        return redirect()->route('admin.chat-managements.index');
    }

    public function edit(ChatManagement $chatManagement)
    {
        abort_if(Gate::denies('chat_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chatManagements.edit', compact('chatManagement'));
    }

    public function update(UpdateChatManagementRequest $request, ChatManagement $chatManagement)
    {
        $chatManagement->update($request->all());

        return redirect()->route('admin.chat-managements.index');
    }

    public function show(ChatManagement $chatManagement)
    {
        abort_if(Gate::denies('chat_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chatManagements.show', compact('chatManagement'));
    }

    public function destroy(ChatManagement $chatManagement)
    {
        abort_if(Gate::denies('chat_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyChatManagementRequest $request)
    {
        ChatManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
