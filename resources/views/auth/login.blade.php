<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <link rel="icon" href="images/favicon.ico" type="image/ico"/>--}}
    <title>alsaedan</title>
    <!-- Bootstrap -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/business-owner/custom.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{asset('css/front.css')}}">
    <style>
         #first-image {
             background-image: url('{{asset('img/login-1.png')}}');
             background-repeat: no-repeat;
             background-size: cover;
             background-position: right;
         }
        #second-image {
            background-image: url('{{asset('img/login-2.png')}}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: right;
        }
        .carousel-item{
            height: 900px;
        }
    </style>
</head>

<body>



<div class="container-fluid" id="login">
    <div>

        <div class="login-form">
            <div class="card">
                <a href="{{route('home',App::getLocale())}}">
                    <img width="135" height="165" src="{{asset('assets/images/logo.png')}}" class="img-rounded"  >
                </a>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password" name="password" required autocomplete="current-password">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row">
                            <div class="col-12">
                        <a class="reset_pass ubuntu-light" href="{{route('password.new.request')}}" >Forgot your password?</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-6 mt-3">
                                <label for="remember-input" class="ubuntu-light" style="color: #61676F;font-size: 0.8rem;padding: 0 5px;">
                                    <input type="checkbox" name="remember" id="remember-input" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="checkmark" id="remember-checkmark"></span>
                                    {{ __('Remember Me') }}
                                </label>
                                <br>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <button type="submit" id="login-btn" class="btn ubuntu-light">{{ __('Log In') }}</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col-* -->

        <div class="col-lg-7 pt-5 d-block d-lg-none">

            <div class="benefits-section">
                <h3 class="text-center text-white">Businesses</h3>
                <h2 class="text-center text-white ubuntu-medium">We warmly welcome you <br>to join joy family</h2>
                <div class="row">
                    <div class="col-lg-4 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/login-benefit-placeholder.png')}}" class="rounded-circle w-25" alt="">
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-center ubuntu-regular mt-2">Increase Outreach &amp Sales</h6>
                                <p class="text-center ubuntu-light" style="line-height: 1.8rem">Get access to our largest sports community to increase outreach and boost your sales.</p>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/login-benefit-placeholder.png')}}" class="rounded-circle w-25" alt="">
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-center ubuntu-regular mt-2">Reduce Operational Cost</h6>
                                <p class="text-center ubuntu-light" style="line-height: 1.8rem">Get access to our largest sports community to increase outreach and boost your sales.</p>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/feature-image-placeholder.png')}}" class="rounded-circle w-25" alt="">
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-center ubuntu-regular mt-2">Reduce Operational Cost</h6>
                                <p class="text-center ubuntu-light" style="line-height: 1.8rem">Get access to our largest sports community to increase outreach and boost your sales.</p>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/login-benefit-placeholder.png')}}" class="rounded-circle w-25" alt="">
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-center ubuntu-regular mt-2">Reduce Operational Cost</h6>
                                <p class="text-center ubuntu-light" style="line-height: 1.8rem">Get access to our largest sports community to increase outreach and boost your sales.</p>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/login-benefit-placeholder.png')}}" class="rounded-circle w-25" alt="">
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-center ubuntu-regular mt-2">Reduce Operational Cost</h6>
                                <p class="text-center ubuntu-light" style="line-height: 1.8rem">Get access to our largest sports community to increase outreach and boost your sales.</p>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/login-benefit-placeholder.png')}}" class="rounded-circle w-25" alt="">
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-center ubuntu-regular mt-2">Reduce Operational Cost</h6>
                                <p class="text-center ubuntu-light" style="line-height: 1.8rem">Get access to our largest sports community to increase outreach and boost your sales.</p>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                </div>
            </div><!-- /.benefits-section -->

        </div><!-- /.col-* -->

    </div><!-- /.row -->
</div><!-- /#login .container-fluid -->


<!-- jQuery -->
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
</body>
</html>
