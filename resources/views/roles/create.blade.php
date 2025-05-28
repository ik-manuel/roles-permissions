@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2>Create Role</h2>
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
        
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
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
                                    <input type="checkbox" name="permissions[]" value="{{ $permission }}" class="form-check-input permission-checkbox">
                                </div> 
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <button class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection