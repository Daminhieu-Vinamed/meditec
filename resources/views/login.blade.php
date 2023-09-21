<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('dist/images/favicon.png')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('dist/css/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('dist/font/login/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('dist/css/login.css')}}">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">MEDITEC</span>
				<div class="login100-form validate-form p-b-33 p-t-5">
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
	<script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('dist/js/jquery.min.js')}}"></script>
	<script src="{{asset('dist/js/login.js')}}"></script>
</body>
</html>