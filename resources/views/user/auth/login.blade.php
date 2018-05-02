@extends('user.layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
         @include('common.notify')
            <div class="panel panel-default">            
                <div class="short-heading">Login</div>
				<p style="text-align:center;"> If you have account please login or <a href="{{ url('/user/register') }}">register</a>  </p>
                <div class="panel-body">
                	<div class="col-md-8 col-md-offset-2 login-form">
	                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/login') }}">
	                        {{ csrf_field() }}
	
	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                            <label for="email" class="col-md-4 control-label">E-Mail Address<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Type your email address" autofocus="" />
	
	                                @if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	
	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">Password<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password" placeholder="Type you password" />
	
	                                @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	
	                        <div class="form-group mbr">
	                            <div class="col-md-6 col-md-offset-4">
	                                <div class="checkbox">
	                                    <label>
	                                        <input type="checkbox" name="remember"> Remember Me
	                                    </label>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group col-md-6">
	                            <label for="password-confirm" class="col-md-4 control-label"></label>
	                            <div class="col-md-6">
	                                {!! html_entity_decode(Captcha::img('flat')) !!}
	                            </div>
	                        </div>
						    <div class="form-group">
						                            <label for="password-confirm" class="col-md-4 control-label">Security text</label>
						                            <div class="col-md-6">
						                               <input id="captcha" type="text" class="form-control" name="captcha" required>
						                            </div>
						    </div>
	
	                        <div class="form-group">
	                            <div class="col-md-8 col-md-offset-4">
	                                <button type="submit" class="btn yellow-btn">
	                                    Login
	                                </button>
	
	                                <a class="btn btn-link" href="{{ url('/user/password/reset') }}">
	                                    Forgot Your Password?
	                                </a>
	                            </div>
	                        </div>
	                    </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
