@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2>Permissions</h2>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Create Permission</a>
        <ul class="list-group">
        @foreach($permissions as $permission)
            <li class="list-group-item d-flex justify-content-between">
                {{ $permission->name }}
                <div>
                    <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline">
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