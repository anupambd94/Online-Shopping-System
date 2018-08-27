@extends('layouts.eshopper')

@section('content')   
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-sm-offset-3">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <span>
                                    <input type="checkbox" name="remember">Keep me signed in
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>                               
                            </div>
                             <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                             <div class="col-md-12">
                                Don't have an account? <a class="btn btn-link" href="{{ url('/register') }}">Sign Up Now</a>
                            </div>
                        </div>
                    </form>
                    </div><!--/login form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
    
@endsection
