@extends('main')
@section('judul')
<title>JALOUR | Masuk </title>
{{-- <link rel="stylesheet" type="text/css" href="css/login/util.css">
	<link rel="stylesheet" type="text/css" href="css/login/main.css"> --}}
	<link rel="stylesheet" type="text/css" href="css/login/baru.css">
@endsection
@section('isi')
<section class="form-auth">
	<center><h2 style="padding-top: 60px">MASUK</h2></center>
<div class="loginpanel">
	
	<form id="login-form" method="POST" action="{{ route('login') }}" class="validate-form">
		@csrf
		<div class="txt">
			<input id="email" type="text" placeholder="Email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required/>
					@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			<label for="user" class="entypo-user"></label>
		  </div>
		  <div class="txt">
			<input id="password" type="password" placeholder="Kata sandi" class="@error('password') is-invalid @enderror" name="password" required/>
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			<label for="pwd" class="entypo-lock"></label>
		  </div>
		  <div class="buttons">
			<input onclick="document.getElementById('login-form').submit();" type="button" value="Masuk" />
			<span>
			  <a href="{{ route('register') }}" class="entypo-user-add register">Daftar</a>
			</span>
		  </div>
	</form>
	{{-- <br>
	<a href="">Lupa kata sandi?</a> --}}
	<div class="hr">
	  <div></div>
	  <div>atau</div>
	  <div></div>
	</div>
	
	<div class="social">
	  <a href="{{ route('facebook.login') }}" class="facebook"></a>
	  <a href="{{ route('google.login') }}" class="googleplus"></a>
	</div>
  </div>
</section>

    
{{-- <script type = "text/javascript" >
	function preventBack(){window.history.forward();}
	setTimeout("preventBack()", 0);
	window.onunload=function(){null};
	</script> --}}
	<script type="text/javascript"> 
		history.pushState(null, null, location.href);
			window.onpopstate = function () {
				history.go(1);
			};
			</script> 
@endsection