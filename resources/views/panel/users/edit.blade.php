@extends('layouts.panel')

@section('title', 'Edit User')

{{-- @section('styles')
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
@stop --}}

@section('content')

    <x-panel.breadcrumb title="Edit User" page="Edit User">
        <x-panel.breadcrumb-action title="Add User" icon="add-circle-outline" />
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

            <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="id" value="{{ $user->id }}">

                <label for="name" class="form-label">Full Name</label>
                <input class="form-control mb-2" name="name" id="name" type="text" placeholder="Alex"
                    aria-label="Alex" value="{{ $user->name }}" required>

                <label for="email" class="form-label">Email</label>
                <input class="form-control mb-2" name="email" id="email" type="email" placeholder="example@ex.com"
                    aria-label="Email" value="{{ $user->email }}" required>

                <label for="password" class="form-label">Password</label>
                <input class="form-control mb-2" name="password" id="password" type="password" placeholder="**********"
                    aria-label="Password">

                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input class="form-control mb-2" name="password_confirmation" id="password_confirmation" type="password"
                    placeholder="**********" aria-label="Confirm Password">

                <label for="phone" class="form-label">Phone Number</label>
                <input class="form-control mb-2" name="phone" id="phone" type="text" placeholder="+8801999999999"
                    aria-label="Phone" value="{{ $user->phone }}" required>

                <label for="profile_image" class="form-label">Profile Image (Max: 2MB)</label>
                <input class="form-control mb-2" id="profile_image" name="profile_image" type="file">

                <label for="role" class="form-label">User Role</label>
                <select class="form-select mb-2" id="role" name="role" required>
                    <option selected disabled>Select User Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @if ($role->name == $user->getRoleNames()->first()) selected @endif>
                            {{ $role->name }}</option>
                    @endforeach
                </select>

                <label for="status" class="form-label">Status</label>
                <select class="form-select mb-2" id="status" name="status" required>
                    <option selected disabled>Select Status</option>
                    <option value="1" @if ($user->status == 1) selected @endif>Active</option>
                    <option value="0" @if ($user->status == 0) selected @endif>Suspended</option>
                </select>

                <div class="mt-3 d-flex justify-content-center">
                    <button type="button" class="btn bread-btn btn-secondary me-2" data-bs-dismiss="modal">Go Back</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>



        </div>
    </div>

@stop

@section('scripts')

    <script>
        let button = document.querySelectorAll('.bread-btn');

        button.forEach(function(element) {
            element.addEventListener('click', function() {
                window.location.href = '{{ route('users.index') }}';
            })
        })
    </script>

@stop
