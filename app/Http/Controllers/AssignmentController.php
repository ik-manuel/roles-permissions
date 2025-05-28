<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AssignmentController extends Controller
{
    public function assignRolesPermissions()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('assignments.roles', compact('roles', 'permissions'));
    }

    public function assignUsersRolesPermissions()
    {
        $users = User::with('roles', 'permissions')->get();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('assignments.users', compact('users', 'roles', 'permissions'));
    }

    public function toggleRolePermission(Request $request, Role $role)
    {
        $permissionName = $request->permission;
        $assign = filter_var($request->assign, FILTER_VALIDATE_BOOLEAN);

        if ($assign) {
            $role->givePermissionTo($permissionName);
        } else {
            $role->revokePermissionTo($permissionName);
        }

        return response()->json(['message' => 'Permission ' . ($assign ? 'assigned' : 'revoked') . ' successfully.']);
    }

    public function toggleUserRole(Request $request, User $user)
    {
        $roleName = $request->role;
        $assign = filter_var($request->assign, FILTER_VALIDATE_BOOLEAN);

        if ($assign) {
            $user->assignRole($roleName);
        } else {
            $user->removeRole($roleName);
        }

        return response()->json(['message' => 'Role ' . ($assign ? 'assigned' : 'revoked') . ' successfully.']);
    }

    public function toggleUserPermission(Request $request, User $user)
    {
        $permissionName = $request->permission;
        $assign = filter_var($request->assign, FILTER_VALIDATE_BOOLEAN);

        if ($assign) {
            $user->givePermissionTo($permissionName);
        } else {
            $user->revokePermissionTo($permissionName);
        }

        return response()->json(['message' => 'Permission ' . ($assign ? 'assigned' : 'revoked') . ' successfully.']);
    }
}
