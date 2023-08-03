@extends('layouts.apps')
@section('content')

<style>
    .invalid-feedback {
        color: red;
    }
</style>

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
						<input type="email" name="email" class="auths" required placeholder="{{ trans('Enter Email Address') }}" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
						@if($errors->has('email'))
						  <div class="invalid-feedback">
							{{ $errors->first('email') }}
						  </div>
						@endif
					  </label>
					  <span class="email-validation-error error-message" style="display: none; color: red;">Please enter a valid email address without digit format after the @ sign, like johndoe@12345.com.</span>
					  
					<label>Phone Number
						<input type="tel" name="mobile" class="auths" required placeholder="{{ trans('Enter Mobile Number') }}" pattern="[0-9]{11}">
						@if($errors->has('mobile'))
							<div class="invalid-feedback">
								{{ $errors->first('mobile') }}
							</div>
						@endif
					</label>	
					<span class="mobile-validation-error error-message" style="display: none; color: red;">Please enter a valid 11-digit phone number without spaces in this format 09030000000.</span>

					<input type="checkbox" class="cbutton" name="policy" id="policy" value="1" required {{ old('policy', 0) == 1 || old('policy') === null ? 'unchecked' : '' }}> I agree to CGCC  <a href="/privacy" target="_blank">Privacy Policy</a>
					<input type="submit" name="Continue" value="Register" class="auths2">
				</form>
				<div id="nuser">Already a User? <a href="{{ route('login') }}"">Login</a></div>
			</div>
		</div>
	</div>

	<script>
		const mobileInput = document.querySelector('input[name="mobile"]');
		const mobileValidationError = document.querySelector('.mobile-validation-error');
	
		mobileInput.addEventListener('input', function() {
			if (!mobileInput.validity.valid) {
				mobileValidationError.style.display = 'block';
			} else {
				mobileValidationError.style.display = 'none';
			}
		});
	</script>

	<script>
		const emailInput = document.querySelector('input[name="email"]');
		const emailValidationError = document.querySelector('.email-validation-error');
	
		emailInput.addEventListener('input', function() {
		const emailValue = emailInput.value.trim();
		const atIndex = emailValue.indexOf('@');
	
		if (!emailInput.validity.valid || atIndex !== -1 && /\d+/.test(emailValue.slice(atIndex))) {
			emailValidationError.style.display = 'block';
		} else {
			emailValidationError.style.display = 'none';
		}
		});
	</script>

@endsection
           