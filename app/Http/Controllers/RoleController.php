<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\GroupPermissions;

class RoleController extends Controller
{
    protected $groupPermissions;

    public function __construct(GroupPermissions $groupPermissions) {
        $this->groupPermissions = $groupPermissions;
    }

    public function index() {
        return view('roles.index', ['roles' => Role::all()]);
    }

    public function create() {
        $groupPermissions = $this->groupPermissions->permission();
        return view('roles.create', compact('groupPermissions'));
    }

    public function store(Request $request) {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role) {
        $groupPermissions = $this->groupPermissions->permission();
        return view('roles.edit', compact('role', 'groupPermissions'));
    }

    public function update(Request $request, Role $role) {
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role) {
        $role->delete();
        return back();
    }
}