<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyChildRequest;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Models\Child;
use App\Models\Member;
use App\Traits\MultiTenantModelTrait;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChildrenController extends Controller
{
    use CsvImportTrait;

    // public function index()
    // {
    //     abort_if(Gate::denies('child_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $children = Child::with(['father_name', 'mothers_name', 'created_by'])->get();

    //     return view('admin.children.index', compact('children'));
    // }

    public function index()
    {
        abort_if(Gate::denies('child_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Check if the authenticated user is an admin
        $isAdmin = auth()->user()->roles->contains(1);

        if ($isAdmin) {
            // Admin can access all children
            $children = Child::with(['father_name', 'mothers_name', 'created_by'])->get();
        } else {
            // Non-admin users can only access their own children
            $currentUserId = auth()->id();
            $children = Child::where('created_by_id', $currentUserId)
                ->with(['father_name', 'mothers_name', 'created_by'])
                ->get();
        }

        return view('admin.children.index', compact('children'));
    }

    public function create()
    {
        abort_if(Gate::denies('child_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Check if the authenticated user is an admin
        $isAdmin = auth()->user()->roles->contains(1);

        if ($isAdmin) {
            // Admin can create children for any member
            $father_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');
            $mothers_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            // Non-admin users can only create children for themselves (father/mother)
            $currentUserId = auth()->id();
            $father_names = Member::where('created_by_id', $currentUserId)
                ->pluck('member_name', 'id')
                ->prepend(trans('global.pleaseSelect'), '');
            $mothers_names = Member::where('created_by_id', $currentUserId)
                ->pluck('member_name', 'id')
                ->prepend(trans('global.pleaseSelect'), '');
        }

        return view('admin.children.create', compact('father_names', 'mothers_names'));
    }

    // public function create()
    // {
    //     abort_if(Gate::denies('child_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $father_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    //     $mothers_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    //     return view('admin.children.create', compact('father_names', 'mothers_names'));
    // }

    public function store(StoreChildRequest $request)
    {
        $child = Child::create($request->all());

        return redirect()->route('admin.children.index');
    }

    public function edit(Child $child)
    {
        abort_if(Gate::denies('child_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Check if the authenticated user is an admin
        $isAdmin = auth()->user()->roles->contains(1);

        // Check if the child belongs to the authenticated user
        $belongsToUser = $child->created_by_id === auth()->id();

        if ($isAdmin || $belongsToUser) {
            // Admin can edit all records, or the child belongs to the authenticated user
            $father_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');
            $mothers_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

            $child->load('father_name', 'mothers_name', 'created_by');

            return view('admin.children.edit', compact('child', 'father_names', 'mothers_names'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    // public function edit(Child $child)
    // {
    //     abort_if(Gate::denies('child_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $father_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    //     $mothers_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    //     $child->load('father_name', 'mothers_name', 'created_by');

    //     return view('admin.children.edit', compact('child', 'father_names', 'mothers_names'));
    // }

    public function update(UpdateChildRequest $request, Child $child)
    {
        $child->update($request->all());

        return redirect()->route('admin.children.index');
    }

    public function show(Child $child)
    {
        abort_if(Gate::denies('child_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $child->load('father_name', 'mothers_name', 'created_by');

        return view('admin.children.show', compact('child'));
    }

    public function destroy(Child $child)
    {
        abort_if(Gate::denies('child_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $child->delete();

        return back();
    }

    public function massDestroy(MassDestroyChildRequest $request)
    {
        $children = Child::find(request('ids'));

        foreach ($children as $child) {
            $child->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    // Example using a Form Request validation
    public function rules()
    {
        return [
            'date_of_birth' => 'required|date_format:Y-m-d',
        ];
    }
}
