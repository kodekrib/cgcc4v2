<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAppointmentBookingRequest;
use App\Http\Requests\StoreAppointmentBookingRequest;
use App\Http\Requests\UpdateAppointmentBookingRequest;
use App\Mail\MailNotify;
use App\Models\AppointmentBooking;
use App\Models\Member;
use App\Models\TypeOfAppoinment;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AppointmentBookingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member = Member::where('email', Auth::user()->email)->first();
        if($member == null){
            abort_if(Gate::denies('member_not_available'), Response::HTTP_FORBIDDEN, 'You are not a Member to view this page, please kindly register as a member to have access');
        }
        $appointmentBookings = AppointmentBooking::with(['appointment_type', 'assigned_to', 'created_by'])->where('assigned_to_id', $member->id)->get();

        return view('admin.appointmentBookings.index', compact('appointmentBookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment_types = TypeOfAppoinment::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointmentBookings.create', compact('appointment_types'));
    }

    public function store(StoreAppointmentBookingRequest $request)
    {

        $typeofppointment = TypeOfAppoinment::with(['default_members'])->where('id', $request->appointment_type_id)->first();
        if($typeofppointment['default_members'] != null){
            $request['assigned_to_id'] = $typeofppointment['default_members']->id;
        }
        $request['created_by_id'] = Auth::id();
        $appointmentBooking = AppointmentBooking::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $appointmentBooking->id]);
        }
            $typeofppointment = TypeOfAppoinment::with(['default_members'])->where('id', $appointmentBooking->appointment_type_id)->first();
            $mailSeting = (new MailingSetupController);
            $email = $mailSeting->GetEmailList(5, 0);
            array_push($email, $typeofppointment->default_members->email);
            $data['subject'] = 'Notification For Booking an appointment';
            $usedefined = ['reason' => $request['purpose']];
            $data['template'] =  $mailSeting->BuildEmailTemplate('5', Auth::id(), $usedefined, false);
            if($data['template']  == null || $data['template']  == ''){
                $data['template'] = $request['purpose'];
            }
            try {
                Mail::to($email)->send(new MailNotify($data));
            } catch (Exception $th) {

            }

        return redirect()->route('admin.appointment-bookings.index');
    }

    public function edit(AppointmentBooking $appointmentBooking)
    {
        abort_if(Gate::denies('appointment_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment_types = TypeOfAppoinment::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');
        $type = TypeOfAppoinment::with('memberManageAppointmentType')->where('id', $appointmentBooking->appointment_type_id)->first();
        $assigned_tos = $type['memberManageAppointmentType'];

        $appointmentBooking->load('appointment_type', 'assigned_to', 'created_by');

        return view('admin.appointmentBookings.edit', compact('appointmentBooking', 'appointment_types', 'assigned_tos'));
    }

    public function update(UpdateAppointmentBookingRequest $request, AppointmentBooking $appointmentBooking)
    {

        $appointmentBooking->update($request->all());

        $userEmail = Auth::user()->email;

        $mailSeting = (new MailingSetupController);
        if($request->approved_status == '2'){
            $data['subject'] = 'Appointment Approval';
            $data['template'] =  $mailSeting->BuildEmailTemplate('6', 0, [], false);

            try {
                Mail::to($userEmail)->send(new MailNotify($data));
            } catch (Exception $th) {

            }
        }
        if($request->approved_status == '1'){
            $data['subject'] = 'Appointment disapproval';
            $data['template'] =  $mailSeting->BuildEmailTemplate('7', 0, [], false);

            try {
                Mail::to($userEmail)->send(new MailNotify($data));
            } catch (Exception $th) {

            }
        }
        return redirect()->route('admin.appointment-bookings.index');
    }

    public function show(AppointmentBooking $appointmentBooking)
    {
        abort_if(Gate::denies('appointment_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentBooking->load('appointment_type', 'assigned_to', 'created_by');

        return view('admin.appointmentBookings.show', compact('appointmentBooking'));
    }

    public function destroy(AppointmentBooking $appointmentBooking)
    {
        abort_if(Gate::denies('appointment_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentBookingRequest $request)
    {
        AppointmentBooking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('appointment_booking_create') && Gate::denies('appointment_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AppointmentBooking();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
