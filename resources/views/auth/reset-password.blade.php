@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 offset-md-2 offset-lg-2 offset-xl-2">
            <div class="card">
                <div class="card-header user-login-email-text">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                
                    <form id="change-password-form">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right user-login-email-text">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control user-login-email-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary" onclick="validateEmail()">
                                    <span class="user-login-email-text" id="password-submit-email-text">Submit Email</span>
                                    <div id="submit-email-loader">
                                        <span class="spinner-border spinner-border-sm"></span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<div class="col-lg-4 mt-3" id="password-update-alert">
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h6 class="text-center alert-msg">Password Updated</h6>
    </div>
</div>


<div class="container-fluid" id="update-password-container">
    <div class="row pt-5">
        <div id="password-col-body" class="pt-3 pb-2 col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 offset-lg-4 offset-lg-4 offset-xl-4">
            <div class="">
                <h6 class="text-center update-password-text">Change Password <span class="fa fa-close" onclick="closePasswordBody()" id="password-body-close"></span></h6>
                <hr>
                <div class="form-group">
                    <input type="password" class="form-control update-password-text" id="password">
                </div>

                 <div class="form-group">
                   <button class="btn btn-primary btn-block" onclick="changeUserPassword()">
                        <span class="update-password-text" id="change-password-text">Submit</span>
                        <div id="update-submit-loader">
                            <span class="spinner-border spinner-border-sm"></span>
                        </div>
                   </button>
                </div>

                
            </div>
        </div>

    </div>

</div>