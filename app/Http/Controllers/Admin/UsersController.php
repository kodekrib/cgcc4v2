<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:600', // Adjust the max file size as per your needs
        ]);
    
        // Check if a file was uploaded
        if ($request->hasFile('profile_picture')) {
            // Get the file from the request
            $file = $request->file('profile_picture');
    
            // Generate a unique file name to store the uploaded file
            $fileName = time() . '_' . $file->getClientOriginalName();
    
            // Store the uploaded file in the 'public/uploads' directory
            $filePath = $file->storeAs('uploads', $fileName, 'public');
    
            // Set the 'profile_picture' attribute of the user to the file path
            $request->merge(['profile_picture' => $filePath]);
        }
    
        // Create the user with the updated request data
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
    
        return redirect()->route('admin.users.index');
    }
    

    // public function store(StoreUserRequest $request)
    // {
    //     $user = User::create($request->all());
    //     $user->roles()->sync($request->input('roles', []));

    //     return redirect()->route('admin.users.index');
    // }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'headOfGroupAffinityGroups', 'mountainLeaderMountainsOfInfluences', 'createdByMfs', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function getUserList(){
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::all()->load(['roles']));
    }

}
