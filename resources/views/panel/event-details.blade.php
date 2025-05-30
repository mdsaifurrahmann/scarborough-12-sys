@extends('layouts.panel')

@section('title', 'Event Details')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />

@stop

@section('content')

    <x-panel.breadcrumb title="Event Details" page="Event Details" />

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
                <form action="{{ route('event.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="countdown_to">Countdown To</label>
                            <input type="date" name="countdown_to" id="countdown_to" class="form-control"
                                placeholder="26-07-2025" value="{{ $data['countdown_to'] }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="event_date">Event Date</label>
                            <input type="text" name="event_date" id="event_date" class="form-control"
                                placeholder="July 26 & 27" value="{{ $data['event_date'] }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="event_title">Event Title</label>
                            <input type="text" name="event_title" id="event_title" class="form-control"
                                placeholder="SSF2025" value="{{ $data['event_title'] }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="location_name">Location Name</label>
                            <input type="text" name="location_name" id="location_name" class="form-control"
                                placeholder="Thomson Memorial Park" value="{{ $data['location_name'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="location_desc">Location Short Description</label>
                            <input type="text" name="location_desc" id="location_desc" class="form-control"
                                placeholder="located at 1005 Brimley Rd, Scarborough, ON M1P 3E9"
                                value="{{ $data['location_desc'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="location_link">Location Link</label>
                            <input type="url" name="location_link" id="location_link" class="form-control"
                                placeholder="https://maps.app.goo.gl/LoDaszacdKSQsExA7"
                                value="{{ $data['location_link'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="hero_bg">Hero Background Image</label>
                            <input type="file" class="form-control" name="hero_bg" id="hero_bg" accept="image/*">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="sponsors">Sponsor Image</label>
                            <input type="file" class="form-control" name="sponsors" id="sponsors" accept="image/*">
                        </div>


                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                        <button type="reset" class="btn btn-label-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-header">
                <h5 class="card-title">Images</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($data['hero_bg'])
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ \Storage::disk('primary_public')->url('/event_details/' . $data['hero_bg']) }}"
                                        alt="Hero BG" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($data['sponsors'])
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ \Storage::disk('primary_public')->url('/event_details/' . $data['sponsors']) }}"
                                        alt="sponsors" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
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
