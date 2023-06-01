<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTypeOfAppoinmentRequest;
use App\Http\Requests\StoreTypeOfAppoinmentRequest;
use App\Http\Requests\UpdateTypeOfAppoinmentRequest;
use App\Models\Member;
use App\Models\TypeOfAppoinment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfAppoinmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_of_appoinment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfAppoinments = TypeOfAppoinment::with(['created_by', 'memberManageAppointmentType', 'default_members'])->get();

        return view('admin.typeOfAppoinments.index', compact('typeOfAppoinments'));
    }

    public function create()
    {
        abort_if(Gate::denies('type_of_appoinment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $memberManageAppointmentType = Member::pluck('member_name', 'id');
        return view('admin.typeOfAppoinments.create', compact('memberManageAppointmentType'));
    }

    public function store(StoreTypeOfAppoinmentRequest $request)
    {
        $request['created_by_id'] = Auth::id();
        $typeOfAppoinment = TypeOfAppoinment::create($request->all());
        $typeOfAppoinment->memberManageAppointmentType()->sync($request->input('members_list', []));
        return redirect()->route('admin.type-of-appoinments.index');
    }

    public function edit(TypeOfAppoinment $typeOfAppoinment)
    {
        abort_if(Gate::denies('type_of_appoinment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfAppoinment->load('created_by', 'default_members', 'memberManageAppointmentType');
        $memberManageAppointmentType = Member::pluck('member_name', 'id');
        return view('admin.typeOfAppoinments.edit', compact('typeOfAppoinment', 'memberManageAppointmentType'));
    }

    public function update(UpdateTypeOfAppoinmentRequest $request, TypeOfAppoinment $typeOfAppoinment)
    {
        $typeOfAppoinment->update($request->all());
        $typeOfAppoinment->memberManageAppointmentType()->sync($request->input('members_list', []));
        return redirect()->route('admin.type-of-appoinments.index');
    }

    public function show(TypeOfAppoinment $typeOfAppoinment)
    {
        abort_if(Gate::denies('type_of_appoinment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfAppoinment->load('created_by', 'default_members', 'memberManageAppointmentType');

        return view('admin.typeOfAppoinments.show', compact('typeOfAppoinment'));
    }

    public function destroy(TypeOfAppoinment $typeOfAppoinment)
    {
        abort_if(Gate::denies('type_of_appoinment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfAppoinment->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeOfAppoinmentRequest $request)
    {
        TypeOfAppoinment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
