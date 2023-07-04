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
				<h3>Register your account</h3>
				<span>Enter your information below to register</span>
				<form method="POST" action="{{ route('register') }}">
                  {{ csrf_field() }}
					<label>Surname
						<input type="text" name="name" class="auths" required autofocus placeholder="{{ trans('Enter Surname') }}">
                      		@if($errors->has('name'))
						<div class="invalid-feedback">
							{{ $errors->first('name') }}
						</div>
					@endif
					</label>
					<label>Firstname
						<input type="text" name="firstname" class="auths" required autofocus placeholder="{{ trans('Enter First Name') }}">
                      		@if($errors->has('firstname'))
						<div class="invalid-feedback">
							{{ $errors->first('firstname') }}
						</div>
					@endif
					</label>
					<label>Email Address
						<input type="email" name="email" class="auths" required placeholder="{{ trans('Enter Email Address') }}">
                            @if($errors->has('email'))
						<div class="invalid-feedback">
							{{ $errors->first('email') }}
						</div>
					@endif
					</label>
					<label>Phone Number
						<input type="tel" name="mobile" class="auths" required placeholder="{{ trans('Enter Mobile Number') }}">
                            @if($errors->has('mobile'))
						<div class="invalid-feedback">
							{{ $errors->first('mobile') }}
						</div>
					@endif
					</label>
					<input type="checkbox" class="cbutton" name="policy" id="policy" value="1" required {{ old('policy', 0) == 1 || old('policy') === null ? 'unchecked' : '' }}> I agree to CGCC  <a href="">Privacy Policy</a>
					<input type="submit" name="Continue" value="Register" class="auths2">
				</form>
				<div id="nuser">Already a User? <a href="{{ route('login') }}"">Login</a></div>
			</div>
		</div>
	</div>
@endsection

<style>
    .invalid-feedback {
        color: red;
    }
</style>
           