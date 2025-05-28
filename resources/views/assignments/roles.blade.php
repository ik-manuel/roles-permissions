@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Roles and Permissions</h2>

    <div class="mb-3">
        <input type="text" id="roleSearch" class="form-control" placeholder="Search roles...">
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Role</th>
                @foreach($permissions as $permission)
                    <th class="text-center">{{ $permission->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody id="roleTableBody">
            @foreach($roles as $role)
                <tr data-role-name="{{ strtolower($role->name) }}">
                    <td><strong>{{ $role->name }}</strong></td>
                    @foreach($permissions as $permission)
                        <td class="text-center">
                            <input type="checkbox"
                                   class="role-permission-toggle"
                                   data-role-id="{{ $role->id }}"
                                   data-permission-name="{{ $permission->name }}"
                                   {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
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
    $('.role-permission-toggle').change(function () {
        let roleId = $(this).data('role-id');
        let permission = $(this).data('permission-name');
        let assign = $(this).is(':checked');

        $.post(`/assign/roles/${roleId}/permission-toggle`, {
            permission: permission,
            assign: assign,
            _token: '{{ csrf_token() }}'
        });
    });

    $('#roleSearch').on('input', function () {
        const value = $(this).val().toLowerCase();
        $('#roleTableBody tr').filter(function () {
            $(this).toggle($(this).data('role-name').includes(value));
        });
    });
</script>
@endsection
