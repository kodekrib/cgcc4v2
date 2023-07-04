<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\Admin\MemberResource;
use App\Models\Member;
//use Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberResource(Member::with(['title', 'employment_status', 'created_by'])->get());
    }

    public function store(StoreMemberRequest $request)
    {
        $member = Member::create($request->all());

        if ($request->input('image', false)) {
            $member->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new MemberResource($member))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Member $member)
    {
        abort_if(Gate::denies('member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberResource($member->load(['title', 'employment_status', 'created_by']));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->all());

        if ($request->input('image', false)) {
            if (!$member->image || $request->input('image') !== $member->image->file_name) {
                if ($member->image) {
                    $member->image->delete();
                }
                $member->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($member->image) {
            $member->image->delete();
        }

        return (new MemberResource($member))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Member $member)
    {
        abort_if(Gate::denies('member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
