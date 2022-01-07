@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')
<style>
nav.navbar.navbar-expand-lg.navbar-absolute.navbar-transparent.fixed-top{
        display: none;

}
.main-box{
    margin-top:55px;
}
/*.card .card-footer {
  background-color: #fdfefc !important;
  }*/
   .alert
    {
        padding: 5px 0px !important;
    }
    .alert ul
    {
        margin: 0px;
    }
</style>
    <!--<div class="col-md-10 text-center ml-auto mr-auto">-->
    <!--    <h3 class="mb-5">Log in to see how you can speed up your web development with out of the box CRUD for #User Management and more.</h3>-->
    <!--</div>-->
    <div class="col-lg-4 main-box col-md-6 ml-auto mr-auto">
        <form class="form" method="POST" action="{{ route('do_login') }}">
            @csrf
                <input type="hidden" value="{{$email}}" name="email" >
                <input type="hidden" value="{{$password}}" name="password" >
            <div class="card card-login card-white">
                <div class="card-header">
                   
                    <h1 style="padding-left:30px;padding-top: 30px;">{{ __('Verify Email Code') }}</h1>
                </div>
                <div class="card-body">
                     @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="text" placeholder="{{ __('Enter Email Code') }}" name="verify_email_code" class="form-control">
                        
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Verify') }}</button>
                   
                    <div class="pull-right">
                        <h6>
                            <!--<a href="{{ route('password.request') }}" class="link footer-link">{{ __('Forgot password?') }}</a>-->
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
