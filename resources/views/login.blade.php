<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('login-style/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-style/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../login-style/images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">MEDITEC</span>
				<div class="login100-form validate-form p-b-33 p-t-5">
					{{-- @csrf --}}
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="Code" placeholder="Mã">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Mật khẩu">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					@if (Session::has('idParent'))
						<input class="input100" type="hidden" name="id" value="{{ Session::get('idParent') }}">
					@endif

					@if (Session::has('error_incorrect'))
						<div class="validate-input">
							<span class="focus-input100 text-center text-danger">{{ Session::get('error_incorrect') }}</span>
						</div>
					@endif
					
					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn login-user" type="button">Login</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('login-style/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-style/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-style/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login-style/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-style/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-style/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('login-style/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-style/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-style/js/main.js')}}"></script>
	<script src="{{asset('login-style/js/addLogic.js')}}"></script>

</body>
</html>