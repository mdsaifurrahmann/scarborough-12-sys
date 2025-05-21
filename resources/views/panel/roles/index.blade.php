@extends('layouts.panel')

@section('title', 'Roles')

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

    <x-panel.breadcrumb title="Roles" page="Roles">
        <x-panel.breadcrumb-action title="Add Roles" icon="add-circle-outline" attr='id="addRole"'>
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

            <div class="d-flex align-items-center">
                <h5 class="mb-0">List of Roles</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <ion-icon name="search-sharp"></ion-icon>
                    </div>
                    <input class="form-control ps-5" type="text" placeholder="Search" id="searchInput"
                        onkeyup="searchPermissions()">
                </form>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="roleTableBody">

                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }} </td>

                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                         @can('update_role')
                                        <a href="{{ route('role.edit', $role->name) }}" class="text-warning"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                            data-bs-original-title="Edit" aria-label="Edit">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                         @endcan

                                         @can('delete_role')
                                        <form method="POST" action="{{ route('role.delete') }}" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" id="permissionDelete"
                                                value="{{ $role->id }}">

                                            <button type="submit" class="text-danger bg-transparent border-0"><ion-icon
                                                    name="trash-outline"></ion-icon></button>
                                        </form>
                                         @endcan

                                             @if (auth()->user()->cannot('update_role') && auth()->user()->cannot('delete_role'))
                                                 Actions unavailable
                                             @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($roles->count() == 0)
                            <tr>
                                <td colspan="4" class="text-center">No Permissions found</td>

                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>

@stop


@section('scripts')

    <script>
        function searchPermissions() {
            // Get the search input
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();

            // Get the table body and all rows
            var tableBody = document.getElementById('roleTableBody');
            var rows = tableBody.getElementsByTagName('tr');

            // Loop through all rows, and hide those that don't match the search query
            for (var i = 0; i < rows.length; i++) {
                var td = rows[i].getElementsByTagName('td')[1]; // Get the second column (Name)
                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        }

        document.getElementById('addRole').addEventListener('click', function() {
            window.location.href = '{{ route('role.create') }}';
        });
    </script>

    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

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
