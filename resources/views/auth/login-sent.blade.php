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
                <h3>A link has been sent to your email</h3>
				<span>Check your email for a link to log into your account</span>
              	<div id="nuser">If you didn't receive login email after 5 mins, goto  <a href="{{ route('login') }}"">Login page</a> to request a new one...</div>

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