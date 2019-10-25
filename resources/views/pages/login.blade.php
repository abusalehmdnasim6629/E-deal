@extends('welcome')
@section('content')

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<div class="login-form"><!--login form-->
					<p class="alert-danger">
					<?php
					$message = Session::get('m');
					if($message){
                        echo "$message";
						Session::put('m',null);
					}
					?>
					</p>
						<h2>Login to your account</h2>
						<form action="{{url('/customer-login')}}" method="post">
						{{ csrf_field() }}
							<input type="email" placeholder="Email Address" name="email_address" />
                            <input type="password" placeholder="Password" name="password" />
							
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->

					<p class="alert-danger">
					<?php
					$message = Session::get('ms');
					if($message){
                        echo "$message";
						Session::put('ms',null);
					}
					?>
					</p>
						<h2>New User Signup!</h2>
						<form action="{{url('/customer-registration')}}" method="post">
                          {{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Name" require=""/>
							<input type="email" name="email_address" placeholder="Email Address"require=""/>
                            <input type="text" name="mobile_number" placeholder="Mobile number"require=""/>
                           
                            <input type="password" name="password" placeholder="Password"require=""/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection