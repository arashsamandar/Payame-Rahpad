@extends('Layouts.UpdeRegis')
{{--<!--===============================================================================================-->--}}
	{{--<link rel="icon" type="image/png" href="{{asset('AdminLogin/images/icons/favicon.ico')}}"/>--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/vendor/bootstrap/css/bootstrap.min.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/vendor/animate/animate.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/vendor/css-hamburgers/hamburgers.min.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/vendor/animsition/css/animsition.min.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/vendor/select2/select2.min.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	{{--<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/vendor/daterangepicker/daterangepicker.css')}}">--}}
{{--<!--===============================================================================================-->--}}
	<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('AdminLogin/css/main.css')}}">
<!--===============================================================================================-->
@section('URS')
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image:url({{ URL::asset('AdminLogin/images/bg-01.jpg') }});">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form role="form" method="post" action="{{ route('admin.login.submit') }}" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="email" name="email" placeholder="Enter username" value="{{ old('email') }}" required autofocus>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password" required>
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" name="submit" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	{{--<script src="{{asset('AdminLogin/vendor/jquery/jquery-3.2.1.min.js')}}"></script>--}}
{{--<!--===============================================================================================-->--}}
	{{--<script src="{{asset('AdminLogin/vendor/animsition/js/animsition.min.js')}}"></script>--}}
{{--<!--===============================================================================================-->--}}
	{{--<script src="{{asset('AdminLogin/vendor/bootstrap/js/popper.js')}}"></script>--}}
	{{--<script src="{{asset('AdminLogin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>--}}
{{--<!--===============================================================================================-->--}}
	{{--<script src="{{asset('AdminLogin/vendor/select2/select2.min.js')}}"></script>--}}
<!--===============================================================================================-->
	{{--<script src="{{asset('AdminLogin/vendor/daterangepicker/moment.min.js')}}"></script>--}}
	{{--<script src="{{asset('AdminLogin/vendor/daterangepicker/daterangepicker.js')}}"></script>--}}
<!--===============================================================================================-->
	{{--<script src="{{asset('AdminLogin/vendor/countdowntime/countdowntime.js')}}"></script>--}}
<!--===============================================================================================-->
	<script src="{{asset('AdminLogin/js/main.js')}}"></script>

@endsection