<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyChildRequest;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Models\Child;
use App\Models\Member;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChildrenController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('child_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $children = Child::with(['father_name', 'mothers_name', 'created_by'])->get();

        return view('admin.children.index', compact('children'));
    }

    public function create()
    {
        abort_if(Gate::denies('child_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $father_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mothers_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.children.create', compact('father_names', 'mothers_names'));
    }

    public function store(StoreChildRequest $request)
    {
        $child = Child::create($request->all());

        return redirect()->route('admin.children.index');
    }

    public function edit(Child $child)
    {
        abort_if(Gate::denies('child_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $father_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mothers_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $child->load('father_name', 'mothers_name', 'created_by');

        return view('admin.children.edit', compact('child', 'father_names', 'mothers_names'));
    }

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
}
