<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')
<style>
nav.navbar.navbar-expand-lg.navbar-absolute.navbar-transparent.fixed-top{
        display: none;

}
.main-box{
    margin-top:55px;
}
.card .card-footer {
  background-color: #fdfefc !important;
  }
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
        <form class="form" method="post" action="{{ route('do_verify') }}">
            @csrf
            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="{{ asset('black') }}/img/card-primary.png" alt="">
                    <h1 >{{ __('Log in') }}</h1>
                </div>
                <div class="card-body">
                  	
                    @if(Session::get('fail'))
								<div class="alert alert-danger mt-3">
                                  {{Session::get('fail')}}
                              </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!--<p class="text-dark mb-2">Sign in with <strong>admin@black.com</strong> and the password <strong>secret</strong></p>-->
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button>
                    <!--<div class="pull-left">-->
                    <!--    <h6>-->
                    <!--        <a href="{{ route('register') }}" class="link footer-link">{{ __('Create Account') }}</a>-->
                    <!--    </h6>-->
                    <!--</div>-->
                    <div class="pull-right" style="position: relative;">
                        <h6>
                            <a href="{{ route('reset-password') }}" class="link footer-link">{{ __('Forgot password?') }}</a>
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>




<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Client Temporary Password</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
  	<form method="post" action="{{url('client/changeTempPassword')}}" enctype="multipart/form-data">
        @csrf
    <div class="modal-body">
      	<input type="hidden" value="{{Session::get('change')}}" name="id" required>
      	<h5 style="color:black;">New Password : </h5>
        <input type="password" name="new" class="form-control form-control-user" style="color:black;" placeholder="New Password" required=""><br>
      	<h5 style="color:black;">Confirm New Password : </h5>
        <input type="password" name="confirm" class="form-control form-control-user" style="color:black;" placeholder="Confirm New Password" required="">
        
  	</div>
    <div class="modal-footer">
        <button class="btn btn-secondary float-end" type="button" data-dismiss="modal">Cancel</button>
      	<input type="submit" name="upload" id="upload" class="btn btn-primary" value="Proceed">
    </div>
    </form>
</div>
</div>
</div>   
   
<script type="text/javascript">
    $(document).ready(function(){
        if({{Session::get('change')!=NULL}})
        {
          $('#passwordModal').modal('show');
        }
    });
</script>
@endsection
