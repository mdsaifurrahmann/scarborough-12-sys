@extends('layouts.panel')

@section('title', 'Join Us')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />

@stop

@section('content')

    <x-panel.breadcrumb title="Join Us" page="Join Us" />

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
                <form action="{{ route('joinus.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="join_us_description">Join Us Description</label>
                            <textarea type="text" name="join_us_description" id="join_us_description" class="form-control" rows="5"
                                placeholder="Be part of a world-class cultural...">{{ $data['join_us_description'] }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="careers_description">Career Description</label>
                            <textarea type="text" name="careers_description" id="careers_description" class="form-control" rows="5"
                                placeholder="Parampara Canada is always looking for...">{{ $data['careers_description'] }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="artists_text">Artist's Text</label>
                            <textarea type="text" name="artists_text" id="artists_text" class="form-control"
                                >{{ $data['artists_text'] }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="volunteers_text">Volunteer's Text</label>
                            <textarea type="text" name="volunteers_text" id="volunteers_text" class="form-control"
                                >{{ $data['volunteers_text'] }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="vendors_text">Vendor's Text</label>
                            <textarea type="text" name="vendors_text" id="vendors_text" class="form-control"
                                >{{ $data['vendors_text'] }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="sponsors_text">Sponsor's Text</label>
                            <textarea type="text" name="sponsors_text" id="sponsors_text" class="form-control"
                                >{{ $data['sponsors_text'] }}</textarea>
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
