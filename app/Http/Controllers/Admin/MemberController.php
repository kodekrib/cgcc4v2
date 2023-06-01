<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\EmploymentStatus;
use App\Models\Member;
use App\Models\MembersAffinityGroup;
use App\Models\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $members = Member::with(['title', 'employment_status', 'created_by', 'media'])->get();

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jsonCountry = file_get_contents('Json/countries.json');
        $json_Countrydata = json_decode($jsonCountry,true);

        $countries = $json_Countrydata; //Country::all();

        $jsonState = file_get_contents('Json/nigeria-state-and-lgas.json');
        $json_Statedata = json_decode($jsonState,true);



        $states = $json_Statedata; //State::all();

        $titles = Title::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employment_statuses = EmploymentStatus::pluck('employment_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.members.create', compact('countries', 'states', 'employment_statuses', 'titles'));
    }

    public function store(StoreMemberRequest $request)
    {
      $member = Member::create($request->all());
       $memberId = $member->id;
    
        $affintyStore = [
            'member_name' => $request->input('member_name'),
            'affinity_group'   => $request->input('affinity_group'),
            'member_Id'   => $memberId,
            'created_by_id' => Auth::id()
        ];
        
        $membersAffinityGroup = MembersAffinityGroup::create( $affintyStore);
      
        if ($request->input('image', false)) {
            $member->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $member->id]);
        }

        return redirect()->route('admin.members.index');
    }

    public function edit(Member $member)
    {
        abort_if(Gate::denies('member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jsonCountry = file_get_contents('Json/countries.json');
        $json_Countrydata = json_decode($jsonCountry,true);

        $countries = $json_Countrydata; //Country::all();

        $jsonState = file_get_contents('Json/nigeria-state-and-lgas.json');
        $json_Statedata = json_decode($jsonState,true);



        $states = $json_Statedata; //Sta

        $titles = Title::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employment_statuses = EmploymentStatus::pluck('employment_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $member->load('title', 'employment_status', 'created_by');

        return view('admin.members.edit', compact('countries', 'states','employment_statuses', 'member', 'titles'));
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
        $getAfflinityGroup = MembersAffinityGroup::all()->where('created_by_id', $member->id)->first();
        if($getAfflinityGroup != null){

            $membersAffinityGroup = MembersAffinityGroup::where('created_by_id', $member->id)->update([
                'member_name' => $request->input('member_name'),
                'affinity_group'   => $request->input('affinity_group'),
            ]);
        } else {
            $membersAffinityGroup = MembersAffinityGroup::create([
                'member_name' => $request->input('member_name'),
                'affinity_group'   => $request->input('affinity_group'),

                'created_by_id'   => $member->id,
            ]);
        }


        return redirect()->route('admin.members.index');
    }

    public function show(Member $member)
    {
        abort_if(Gate::denies('member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->load('title', 'employment_status', 'created_by', 'createdByChildren', 'createdByMembersAffinityGroups', 'fatherNameChildren', 'mothersNameChildren', 'membersInAttendanceAttendanceManagements');

        return view('admin.members.show', compact('member'));
    }

    public function destroy(Member $member)
    {
        abort_if(Gate::denies('member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemberRequest $request)
    {
        $members = Member::find(request('ids'));

        foreach ($members as $member) {
            $member->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function GetMemberList(Request $request){
        $members = Member::with(['title', 'employment_status', 'created_by', 'media'])->get();
        if ($request->ajax()) {
            return DataTables::of($members)->make(true);

        }

        return response()->json($members);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('member_create') && Gate::denies('member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Member();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
