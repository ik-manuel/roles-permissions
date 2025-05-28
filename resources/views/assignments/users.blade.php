@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">User Roles & Permissions</h2>

    <div class="mb-3">
        <input type="text" id="userSearch" class="form-control" placeholder="Search users...">
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>User</th>
                @foreach($roles as $role)
                    <th class="text-center">{{ $role->name }}</th>
                @endforeach
                @foreach($permissions as $permission)
                    <th class="text-center">{{ $permission->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody id="userTableBody">
            @foreach($users as $user)
                <tr data-user-name="{{ strtolower($user->name ?? $user->email) }}">
                    <td><strong>{{ $user->name ?? $user->email }}</strong></td>
                    @foreach($roles as $role)
                        <td class="text-center">
                            <input type="checkbox"
                                   class="user-role-toggle"
                                   data-user-id="{{ $user->id }}"
                                   data-role-name="{{ $role->name }}"
                                   {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                        </td>
                    @endforeach
                    @foreach($permissions as $permission)
                        <td class="text-center">
                            <input type="checkbox"
                                   class="user-permission-toggle"
                                   data-user-id="{{ $user->id }}"
                                   data-permission-name="{{ $permission->name }}"
                                   {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.user-role-toggle').change(function () {
        let userId = $(this).data('user-id');
        let role = $(this).data('role-name');
        let assign = $(this).is(':checked');

        $.post(`/assign/users/${userId}/role-toggle`, {
            role: role,
            assign: assign,
            _token: '{{ csrf_token() }}'
        });
    });

    $('.user-permission-toggle').change(function () {
        let userId = $(this).data('user-id');
        let permission = $(this).data('permission-name');
        let assign = $(this).is(':checked');

        $.post(`/assign/users/${userId}/permission-toggle`, {
            permission: permission,
            assign: assign,
            _token: '{{ csrf_token() }}'
        });
    });

    $('#userSearch').on('input', function () {
        const value = $(this).val().toLowerCase();
        $('#userTableBody tr').filter(function () {
            $(this).toggle($(this).data('user-name').includes(value));
        });
    });
</script>
@endsection
