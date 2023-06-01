@extends('layouts.apps')
@section('content')
<div id="login_left">
		<div class="inners">
			<div id="logo">
      			<img src="images/CGCC_logo.png">
    		</div>
			<div id="captions">
				<span>Welcome to The Citadel Global Community Church</span>
				<h2>An Intentional Community with Dynamic Influence</h2>
			</div>
		</div>
	</div>
	<div id="login_right">
		<div class="inners">
			<div id="login_panel">
				<h3>Login to your account</h3>
				<span>Enter your information below to login</span>
              		@if(session('message'))
				<div class="alert alert-info" role="alert">
					{{ session('message') }}
				</div>
			@endif
                <form method="POST" action="{{ route('userLogin') }}">
                  @csrf
					<label>Phone Number or Email Address</label>
					<input type="text" id="email" name="email" class="auths" required autofocus placeholder="{{ trans('Enter Phone Number or Email Address')}}">
                  	@if($errors->has('email'))
					<div class="invalid-feedback">
						{{ $errors->first('email') }}
					</div>
				@endif
                  	<input type="submit" name="Login via a magic link" value="Login via a magic link" class="auths2">
				</form>
				<div id="nuser">New User? <a href="{{ route('register') }}">Register</a></div>
			</div>
		</div>
	</div>
@endsection

<style>
    .invalid-feedback {
        color: red;
    }
	.alert-info {
    	background-color: #c7d2f5;
    }
</style>