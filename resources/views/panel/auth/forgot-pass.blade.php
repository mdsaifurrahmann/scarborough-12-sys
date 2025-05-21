@extends('layouts.panel-login')

@section('title', 'Forgot Password')

@section('content')

    {{-- <x-panel.breadcrumb title="Dashboard" page="Dashboard"/> --}}


    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="reset-passowrd">
                    <div class="card radius-10 w-100">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h4>Reset password</h4>
                                <p>You will receive an e-mail in maximum 60 seconds</p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-dismissible show py-2"
                                    style="border-left-width: 4px !important; border-left-color: #18bb6b !important">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-3 text-success"><ion-icon name="checkmark-circle-sharp"></ion-icon>
                                        </div>
                                        <div class="ms-3">
                                            <div class="text-success">{{ session('status') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form class="form-body row g-3" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail"
                                        placeholder="abc@example.com">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop
