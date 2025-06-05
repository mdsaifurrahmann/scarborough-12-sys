@extends('layouts.panel')

@section('title', 'Vision')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />

@stop

@section('content')

    <x-panel.breadcrumb title="Vision" page="Vision" />

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
                <form action="{{ route('vision.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label" for="vision_desc">Vision Description</label>
                            <textarea name="vision_desc" id="vision_desc" class="form-control"
                                placeholder="To create a world-class cultural festival that celebrates the rich diversity of Scarborough, fostering connections through music, art, and traditions from around the globe. Guided by Parampara Canada's mission to preserve and promote heritage, we aim to inspire unity, nurture creativity, and build a vibrant, inclusive community where all cultures are celebrated and shared.">{{$data['vision_desc']}}</textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label" for="vision_image">Vision Background Image</label>
                            <input type="file" class="form-control" name="vision_image" id="vision_image" accept="image/*">
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
                    @if ($data['vision_image'])
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ \Storage::disk('primary_public')->url('/website_information/' . $data['vision_image']) }}"
                                        alt="Vision BG" class="w-100 h-100 object-fit-cover">
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
