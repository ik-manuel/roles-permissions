@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2>Users</h2>
        <table class="table">
            <thead><tr><th>Name</th><th>Email</th><th>Roles</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                <td><a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Manage</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection