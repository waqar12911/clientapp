@extends('layouts.app', ['class' => 'login-page', 'page' => __('Reset password'), 'contentClass' => 'login-page'])

@section('content')

<style>
nav.navbar.navbar-expand-lg.navbar-absolute.navbar-transparent.fixed-top{
        display: none !important;

}
/*.main-box{
    margin-top:55px;
}*/ 

</style>
    <div class="col-lg-4 main-box col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('update-password') }}">
            @csrf

            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="{{ asset('black') }}/img/card-primary.png" alt="">
                    <h1 class="card-title">{{ __('Reset password') }}</h1>
                </div>
                <div class="card-body mt-5">
                    @include('alerts.success')

                    <input type="hidden" name="email" value="{{Session::has('email') ? Session::get('email'):''}}">

                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="text" name="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="{{ __('One time passsword') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Reset Password') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
