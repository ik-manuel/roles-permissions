@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2>Manage {{ $user->name }}'s Role/Permissions</h2>
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            <div class="mb-3">
                <label>Roles</label><br>
                @foreach($roles as $role)
                <div class="form-check form-switch form-check-inline mb-3">
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="form-check-input"
                        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $role->name }}</label>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <button type="button" class="btn shadow btn-light mb-3" id="selectAllPermissions">
                        Select All
                    </button>
                    <button type="button" class="btn shadow btn-light mb-3" id="deselectAllPermissions">
                        Deselect All
                    </button>
                    
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Permissions</th>
                            <th>View</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($groupPermissions as $groupTitle => $permissions)
                        <tr>
                            <td class="lead">{{ Str::headline(str_replace('_', ' ', $groupTitle)) }}</td>
                            @foreach($permissions as $permission)
                            <td>
                                <div class="form-check form-switch ">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission }}" class="form-check-input permission-checkbox"
                                    {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}>
                                </div> 
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection