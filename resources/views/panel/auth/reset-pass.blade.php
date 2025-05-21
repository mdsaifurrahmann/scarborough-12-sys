@extends('layouts.panel-login')

@section('title', 'Reset Password')

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
                                <p>Your new password must be different from previously used passwords</p>
                            </div>
                            <form class="form-body row g-3" method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ request()->token }}">
                                <input type="hidden" name="email" class="form-control" value="{{ request()->email }}" readonly>
                                {{-- <div class="col-12">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="col-12">
                                    <label for="reset-password-new" class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control" id="reset-password-new"
                                        placeholder="**********">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="confirm-password-new" class="form-label">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="confirm-password-new" placeholder="**********">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Set New Password</button>
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
