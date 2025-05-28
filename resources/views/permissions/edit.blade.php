@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2>Edit Permission</h2>
        <form method="POST" action="{{ route('permissions.update', $permission) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ $permission->name }}" class="form-control" required>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection