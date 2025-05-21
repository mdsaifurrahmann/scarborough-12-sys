@extends('layouts.panel')

@section('title', 'Edit Role')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />
    <style>
        html.dark-theme .table thead tr th {
            color: var(--bs-table-bg) !important;
            background-color: inherit !important;
        }

        /*.table thead tr th {*/
        /*    color: #000 !important;*/
        /*    background-color: inherit !important;*/
        /*}*/

        @media (prefers-color-scheme: dark) {
            .table thead tr th {
                color: var(--bs-table-bg) !important;
                background-color: inherit !important;
            }
        }

        @media (prefers-color-scheme: light) {
            .table thead tr th {
                color: inherit;
                background-color: inherit;
            }
        }
    </style>
@stop


@section('content')

    <x-panel.breadcrumb title="Edit Role" page="Edit Role">
        <x-panel.breadcrumb-action title="Back to Roles" icon="return-up-back-outline">
        </x-panel.breadcrumb-action>
    </x-panel.breadcrumb>


    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="card">

        <div class="card-body">

            <form action="{{ route('role.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="roleId" value="{{ $role->id }}">

                <div class="col-12 mb-4">
                    <label class="form-label" for="modalRoleName">Role Name</label>
                    <input type="text" id="modalRoleName" class="form-control" name="roleName"
                        placeholder="Enter a role name" value="{{ $role->name }}" required />
                </div>
                <div class="table-responsive">
                    <table class="table table-flush-spacing">
                        <thead class="table-secondary">
                            <tr>
                                <th>Name</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td class="text-nowrap fw-medium">{{ $group->name }}</td>
                                    <td>
                                        <div class="d-flex">

                                            @php
                                                // Filter permissions for the group
                                                $groupPermissions = $permissions->filter(function ($permission) use (
                                                    $group,
                                                ) {
                                                    return $permission->group_id === $group->id;
                                                });
                                            @endphp

                                            @if ($groupPermissions->isEmpty())
                                                No permissions available for this group.
                                            @else
                                                @foreach ($permissions as $permission)
                                                    @if ($group->id === $permission->group_id)
                                                        <div class="form-check me-4 w-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="permissions[]"
                                                                id="userManagement{{ $permission->name }}"
                                                                value="{{ $permission->name }}"
                                                                @if (in_array($permission->name, $hasPermissions->pluck('name')->toArray())) checked @endif />
                                                            <label class="form-check-label"
                                                                for="userManagement{{ $permission->name }}">
                                                                {{ $permission->label ? $permission->label : $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="col-12 text-center mt-4">
                        <button type="reset" class="btn btn-outline-dark me-1 bread-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            Back to Roles
                        </button>
                        <button type="submit" id="create" class="btn btn-primary me-sm-3">Update Role</button>
                    </div>

            </form>
        </div>
    </div>

@stop


@section('scripts')

    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    <script>
        let button = document.querySelectorAll('.bread-btn');

        button.forEach(function(element) {
            element.addEventListener('click', function() {
                window.location.href = '{{ route('roles.index') }}';
            })
        })
    </script>


    @if (Session::has('success'))
        <script>
            window.onload = function() {
                pos1_default_noti();
            }

            function pos1_default_noti() {
                Lobibox.notify('default', {
                    rounded: true,
                    icon: 'bx bx-check-circle',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'center top',
                    size: 'mini',
                    msg: "{{ Session::get('success') }}"
                });
            }
        </script>
    @endif



@stop
