@extends('university.main')
@section('content')

	<div class="login-container">
		<img class="wave" src="{{ asset('university/img/wave.png') }}">
		<div class="img-login">
			<img src="{{ asset('university/img/login_image_1.png') }}">
		</div>
		<div class="login-content">
			<form class="login-form">
				<img src="{{ asset('university/img/avatar.png') }}">
				<h2 class="title">Signup</h2>
                <!-- <div class="social_login_opt">
					<a href="javascript:(0)" class="google_btn">Continue with Google <img src="img/google.png"></a>
					<a href="javascript:(0)" class="facbook_btn">Continue with Facebook <img src="img/facebook.png"></a>
				</div> -->
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div> 
					<div class="div">
						<h5>Name</h5>
						<input type="text" class="input">
					</div>
				</div>
                <div class="input-div one">
					<div class="i">
						<i class="fas fa-envelope"></i>
					</div>
					<div class="div">
						<h5>Email</h5>
						<input type="email" class="input">
					</div>
				</div>
                <div class="input-div one">
					<div class="i">
						<i class="fas fa-address-book"></i>
					</div>
					<div class="div">
						<h5>Contact</h5>
						<input type="phone" class="input">
					</div>
				</div>
                <div class="input-div one">
					<div class="i">
						<i class="fas fa-map-marker-alt"></i>
					</div>
					<div class="div">
						<h5>Address</h5>
						<input type="text" class="input">
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Password</h5>
						<input type="password" class="input">
					</div>
				</div>
				<input type="submit" class="btn-login" value="Signup">
				<div class="signup-link">
					<p>Already have account ? <a href="{{ url('login') }}">Login</a></p>
				</div>
			</form>
		</div>
	</div>

	<script>
		const inputs = document.querySelectorAll(".input");


		function addcl() {
			let parent = this.parentNode.parentNode;
			parent.classList.add("focus");
		}

		function remcl() {
			let parent = this.parentNode.parentNode;
			if (this.value == "") {
				parent.classList.remove("focus");
			}
		}


		inputs.forEach(input => {
			input.addEventListener("focus", addcl);
			input.addEventListener("blur", remcl);
		});

//Source :- https://github.com/sefyudem/Responsive-Login-Form/blob/master/img/avatar.svg
	</script>
@endsection