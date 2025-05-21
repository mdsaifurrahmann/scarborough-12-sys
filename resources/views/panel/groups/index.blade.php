@extends('layouts.panel')

@section('title', 'Groups')

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

    <x-panel.breadcrumb title="Groups" page="Groups">
        {{-- @can('create_group') --}}
        <x-panel.breadcrumb-action title="Add Group" icon="add-circle-outline"
            attr='data-bs-toggle="modal" data-bs-target="#exampleModal"' />
        {{-- @endcan --}}
    </x-panel.breadcrumb>

    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center">
                <h5 class="mb-0">List of Groups</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <ion-icon name="search-sharp"></ion-icon>
                    </div>
                    <input class="form-control ps-5" type="text" placeholder="Search" id="searchInput"
                        onkeyup="searchGroups()">
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
                    <tbody id="groupTableBody">

                        @foreach ($groups as $key => $group)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $group->name }}
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        @can('update_group')
                                            <a href="javascript:void(0)" class="text-warning" data-bs-toggle="modal"
                                                data-bs-placement="bottom" title="" data-bs-original-title="Edit"
                                                aria-label="Edit" data-bs-target="#editModal"
                                                onclick="edit({{ $group->id }})">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </a>
                                        @endcan
                                         @can('delete_group')
                                        <form method="POST" action="{{ route('group.delete') }}" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" id="groupDelete"
                                                value="{{ $group->id }}">

                                            <button type="submit" class="text-danger bg-transparent border-0"><ion-icon
                                                    name="trash-outline"></ion-icon></button>
                                        </form>
                                         @endcan

                                            @if (auth()->user()->cannot('update_group') && auth()->user()->cannot('delete_group'))
                                                Actions unavailable
                                            @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                       @if ($groups->count() == 0)
                            <tr>
                                <td colspan="3" class="text-center">No groups found</td>
                            </tr>
                      @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('group.store') }}" method="POST">
                        @csrf
                        <input class="form-control mb-3" name="name" type="text" placeholder="Ex: Products Group"
                            aria-label="Group Example" required>

                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" id="groupUpdate">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" id="id">
                        <input class="form-control mb-3" id="name" name="name" type="text"
                            placeholder="Ex: Products Group" aria-label="Group Example" value="" required>

                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop


@section('scripts')

    <script>
        var groups = {!! json_encode($groups) !!};

        function edit(id) {
            // set the name value to the input
            var name = document.getElementById('name');
            var gId = document.getElementById('id');
            var form = document.getElementById('groupUpdate');

            gId.setAttribute('value', id);
            name.setAttribute('value', groups.find(group => group.id === id).name);
            form.setAttribute('action', "{{ route('group.update', ':id') }}".replace(':id', id));

        }

        function searchGroups() {
            // Get the search input
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();

            // Get the table body and all rows
            var tableBody = document.getElementById('groupTableBody');
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
