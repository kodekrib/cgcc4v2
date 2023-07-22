<?php

namespace App\Http\Middleware;

use App\Models\Member;
use App\Models\Qualification;
use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return $next($request);
        }
         $memberExist = Member::all()->where('email', $user->email)->first();
         Config::set('memberExist', $memberExist);

         $qualification = Qualification::all()->where('created_by_id', $user->id)->first();
         Config::set('qualification', $qualification);
        $roles            = Role::with('permissions')->get();
        $permissionsArray = [];

        foreach ($roles as $role) {
            foreach ($role->permissions as $permissions) {
                $permissionsArray[$permissions->title][] = $role->id;
            }
        }

        foreach ($permissionsArray as $title => $roles) {
            Gate::define($title, function ($user) use ($roles) {
                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
            });
        }

        return $next($request);
    }
}
