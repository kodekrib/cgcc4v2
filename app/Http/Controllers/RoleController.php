<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;


use Illuminate\Http\Request;

class RoleController extends Controller
{



    public function switchToAdmin()
    {
        $user = Auth::user();
        $adminRoleId = 1; // Role ID for Admin

        $user->roles()->sync([$adminRoleId]); // Assign the Admin role to the user

        return redirect()->back();
    }

    public function switchToHOD()
    {
        $user = Auth::user();
        $hodRoleId = 3; // Role ID for HOD

        $user->roles()->sync([$hodRoleId]); // Assign the HOD role to the user

        return redirect()->back();
    }

    public function switchToUser()
    {
        $user = Auth::user();
        $userRoleId = 2; // Role ID for HOD

        $user->roles()->sync([$userRoleId]); // Assign the User role to the user

        return redirect()->back();
    }

}
