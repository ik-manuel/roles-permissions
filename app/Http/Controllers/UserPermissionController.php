<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\GroupPermissions;

class UserPermissionController extends Controller
{
    protected $groupPermissions;

    public function __construct(GroupPermissions $groupPermissions) {
        $this->groupPermissions = $groupPermissions;
    }

    /**
     * Display a listing of the users with their roles and permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $users = User::with('roles', 'permissions')->get();
        return view('users.index', compact('users'));
    }

    public function edit(User $user) {
        $roles = Role::all();
        $groupPermissions = $this->groupPermissions->permission();
        return view('users.edit', compact('user', 'roles', 'groupPermissions'));
    }

    public function update(Request $request, User $user) {
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        return redirect()->route('users.index');
    }
}