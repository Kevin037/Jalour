@extends('main')
@section('judul')
<title>JALOUR | Daftar </title>
	<link rel="stylesheet" type="text/css" href="css/login/baru.css">
@endsection
@section('isi')
<section class="form-auth">
<center><h2 style="padding-top: 60px">DAFTAR</h2></center>
<div class="loginpanel">
	
	<form id="daftar-form" method="POST" action="{{ route('register') }}">
		@csrf
		<div class="txt">
			<input id="name" type="text" class="@error('name') is-invalid @enderror" placeholder="Username" name="name" value="{{ old('name') }}" required/>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			<label for="user" class="entypo-user"></label>
		  </div>
          <div class="txt">
			<input id="name" type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required/>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
			<label for="user" class="entypo-mail"></label>
		  </div>
		  <div class="txt">
			<input id="password" type="password" placeholder="Kata sandi" name="password" class="@error('password') is-invalid @enderror" required/>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
			<label for="pwd" class="entypo-lock"></label>
		  </div>
          <div class="txt">
			<input id="password-confirm" name="password_confirmation" type="password" placeholder="Masukkan ulang kata sandi" required/>
			<label for="pwd" class="entypo-lock"></label>
		  </div>
		  <div class="buttons">
			<input onclick="document.getElementById('daftar-form').submit();" type="button" value="Daftar" />
		  </div>
		  <br>
	<p>Sudah punya akun? <a href="/login">Login</a></p>
	</form>
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