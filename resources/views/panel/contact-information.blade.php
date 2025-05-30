@extends('layouts.panel')

@section('title', 'Contact Information')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />

@stop

@section('content')

    <x-panel.breadcrumb title="Contact Information" page="Contact Information" />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('contact.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="fb_username">Facebook Username</label>
                            <input type="text" name="facebook_username" id="fb_username" class="form-control"
                                placeholder="codebumble" value="{{ $data['facebook_username'] }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="linkedin_username">Linkedin Username</label>
                            <input type="text" name="linkedin_username" id="linkedin_username" class="form-control"
                                placeholder="codebumble" value="{{ $data['linkedin_username'] }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="instagram_username">Instagram Username</label>
                            <input type="text" name="instagram_username" id="instagram_username" class="form-control"
                                placeholder="codebumble" value="{{ $data['instagram_username'] }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="youtube_username">Youtube Handle</label>
                            <input type="text" name="youtube_username" id="youtube_username" class="form-control"
                                placeholder="codebumble" value="{{ $data['youtube_username'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="647-780-0785" value="{{ $data['phone'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="info@paramparacanada.ca" value="{{ $data['email'] }}" />
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                placeholder="Scarborough, ON" value="{{ $data['location'] }}" />
                        </div>

                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                        <button type="reset" class="btn btn-label-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@stop


@section('scripts')

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
