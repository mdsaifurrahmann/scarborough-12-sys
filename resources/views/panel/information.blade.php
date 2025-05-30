@extends('layouts.panel')

@section('title', 'Website Information')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />

@stop

@section('content')

    <x-panel.breadcrumb title="Website Information" page="Website Information" />

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
                <form action="{{ route('info.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="website__title">Website Title</label>
                            <input type="text" name="title" id="website__title" class="form-control"
                                placeholder="Codebumble Inc." value="{{ $websiteInformation['title'] }}" />
                        </div>



                        <div class="col-md-6">
                            <label class="form-label" for="logo">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="favicon">Favicon</label>
                            <input type="file" class="form-control" name="favicon" id="favicon" accept="image/*">

                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="thumbnail">Social Media Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">

                        </div>
                        <div class="col-md-6 select2-primary">
                            <label class="form-label" for="site_url">URL</label>
                            <input type="url" name="url" id="site_url" class="form-control"
                                placeholder="https://codebumble.net" value="{{ $websiteInformation['url'] }}">
                        </div>

                        <div class="col-md-6">
                            <label for="keywords" class="form-label">Keywords</label>
                            <input id="keywords" class="form-control" name="keywords" value="{{ $keywords }}" />
                        </div>

                        <div class="col-md-12 mt-lg-0">
                            <label class="form-label" for="website__desc">Website Description</label>
                            <textarea type="text" name="description" id="website__desc" class="form-control" placeholder="Codebumble Inc.">{{ $websiteInformation['description'] }}</textarea>
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
                    @if ($websiteInformation['logo'])
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ \Storage::disk('primary_public')->url('/website_information/' . $websiteInformation['logo']) }}"
                                        alt="logo" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($websiteInformation['favicon'])
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ \Storage::disk('primary_public')->url('/website_information/' . $websiteInformation['favicon']) }}"
                                        alt="favicon" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($websiteInformation['thumbnail'])
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ \Storage::disk('primary_public')->url('/website_information/' . $websiteInformation['thumbnail']) }}"
                                        alt="thumbnail" class="w-100 h-100 object-fit-cover">
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

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    <script type="module">
        const tagifyBasicEl = document.querySelector('#keywords');
        const TagifyBasic = new Tagify(tagifyBasicEl);
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
