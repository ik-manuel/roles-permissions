@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2>Roles</h2>
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create Role</a>
        <ul class="list-group">
        @foreach($roles as $role)
            <li class="list-group-item d-flex justify-content-between">
                {{ $role->name }}
                <div>
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection