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


    <div class="card mb-3">
        <div class="card-body">
            <div class="card-header pt-2" style="border-bottom: unset">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-basic-info"
                            role="tab" aria-selected="true">Basic Information
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-social-media"
                            role="tab" aria-selected="false">Social Media
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-seo" role="tab"
                            aria-selected="false">SEO
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-inject-code" role="tab"
                            aria-selected="false">Inject Custom Code
                        </button>
                    </li>
                </ul>
            </div>

            <div class="tab-content pt-3">
                <div class="tab-pane fade active show" id="form-tabs-basic-info" role="tabpanel">
                    <form action="{{ route('basic.info.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="website__name">Website Name</label>
                                <input type="text" name="website_name" id="website__name" class="form-control"
                                    placeholder="Codebumble Inc." value="{{ $basicInfo['website_name'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="slug">Slug</label>
                                <input type="text" id="slug" name="website_slug" class="form-control"
                                    placeholder="We speaks technology fluently"
                                    value="{{ $basicInfo['website_slug'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="logo">Logo</label>
                                <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="favicon">Favicon</label>
                                <input type="file" class="form-control" name="favicon" id="favicon" accept="image/*">

                            </div>
                            <div class="col-md-6 select2-primary">
                                <label class="form-label" for="site_url">URL</label>
                                <input type="url" name="url" id="site_url" class="form-control"
                                    placeholder="https://codebumble.net" value="{{ $basicInfo['url'] ?? '' }}">

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact_mobile">Contact Mobile</label>
                                <input type="text" name="contact_mobile" id="contact_mobile"
                                    class="form-control phone-mask" placeholder="+8801900000000"
                                    value="{{ $basicInfo['contact_mobile'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact_email">Contact Email</label>
                                <input type="email" name="contact_email" id="contact_email" class="form-control"
                                    placeholder="hello@codebumble.net" value="{{ $basicInfo['contact_email'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact_address">Contact Address</label>
                                <input type="text" name="contact_address" id="contact_address" class="form-control"
                                    placeholder="road#5, house#9, Gulshan, Dhaka"
                                    value="{{ $basicInfo['contact_address'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                            <button type="reset" class="btn btn-label-secondary">Reset</button>
                        </div>
                    </form>

                    <div class="divider divider-primary">
                        <div class="divider-text fw-medium" style="font-size: 18px">Images</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/site__info/' . $basicInfo['logo']) }}" alt="logo"
                                        class="w-100 h-100 object-fit-coverå">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/site__info/' . $basicInfo['favicon']) }}" alt="favicon"
                                        class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="form-tabs-social-media" role="tabpanel">
                    <form action="{{ route('social.media.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-twitter">X.com</label>
                                <input type="text" name="social_x" id="formtabs-twitter" class="form-control"
                                    placeholder="https://x.com/abc" value="{{ $socialMedia['social_x'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-facebook">Facebook</label>
                                <input type="text" name="social_fb" id="formtabs-facebook" class="form-control"
                                    placeholder="https://facebook.com/abc"
                                    value="{{ $socialMedia['social_fb'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-youtube">Youtube</label>
                                <input type="text" name="social_yt" id="formtabs-youtube" class="form-control"
                                    placeholder="https://youtube.com/@abc"
                                    value="{{ $socialMedia['social_yt'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-linkedin">Linkedin</label>
                                <input type="text" name="social_linkedin" id="formtabs-linkedin" class="form-control"
                                    placeholder="https://linkedin.com/in/abc"
                                    value="{{ $socialMedia['social_linkedin'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-instagram">Instagram</label>
                                <input type="text" name="social_insta" id="formtabs-instagram" class="form-control"
                                    placeholder="https://instagram.com/abc"
                                    value="{{ $socialMedia['social_insta'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-quora">Quora</label>
                                <input type="text" name="social_quora" id="formtabs-quora" class="form-control"
                                    placeholder="https://quora.com/abc"
                                    value="{{ $socialMedia['social_quora'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                            <button type="reset" class="btn btn-label-secondary">Reset</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="form-tabs-seo" role="tabpanel">
                    <form action="{{ route('seo.info.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="og__desc">og:description</label>
                                <input type="text" id="meta_desc" name="og__desc" class="form-control"
                                    placeholder="Enter meta description" value="{{ $seo['og__desc'] ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="og__image">og:image</label>
                                <input type="file" id="og__image" name="og__image" class="form-control"
                                    accept="image/*" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="og__type">og:type</label>
                                <input type="text" id="og__type" name="og__type" class="form-control"
                                    placeholder="website" value="{{ $seo['og__type'] ?? '' }}" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="keywords" class="form-label">Keywords</label>
                                <input id="keywords" class="form-control" name="keywords"
                                    value="{{ $seo['keywords'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                            <button type="reset" class="btn btn-label-secondary">Reset</button>
                        </div>
                    </form>

                    <div class="divider divider-primary">
                        <div class="divider-text fw-medium" style="font-size: 18px">Images</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/site__info/' . $seo['og__image']) }}" alt="logo"
                                        class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="form-tabs-inject-code" role="tabpanel">
                    <form action="{{ route('injector.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-twitter">Inject code in Head</label>
                                <textarea style="height: 200px;" name="inject_head" id="formtabs-twitter" class="form-control"
                                    placeholder="Enter code to inject in Head">{{ $inject['inject_head'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formtabs-facebook">Inject code in Bottom</label>
                                <textarea style="height: 200px;" name="inject_bottom" id="formtabs-twitter" class="form-control"
                                    placeholder="Enter code to inject in bottom">{{ $inject['inject_bottom'] ?? '' }}</textarea>
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
