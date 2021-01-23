@extends('layout')

@section('content')

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{url('/coustomer_login')}}" method="post">
						{{ csrf_field() }}
							<input type="email" name="coustomer_email" placeholder="Enter email">
							<input type="password" name="password" placeholder="Enter password">
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{url('/customer_registration')}}" method="post">
                          {{ csrf_field() }}
							<input type="text" name="coustomer_name" placeholder="Full Name" required="">
							<input type="email" name="coustomer_email" placeholder="Email Address" required="">
							<input type="password" name="password" placeholder="Password" required="">
							<input type="text" name="mobile_number" placeholder="Phone" required="">
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section>

@endsection