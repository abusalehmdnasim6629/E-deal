@extends('welcome')
@section('content')
     

<section id="cart_items">
		<div class="container">
			
			<div class="register-req">
				<p>Please fill all input field..</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{URL::to('shipping')}}" method="post">
                                {{csrf_field()}}
									<input type="text" name="email_address" placeholder="Email*">
									
									<input type="text" name="shipping_first_name" placeholder="First Name *">
									
									<input type="text" name="shipping_last_name" placeholder="Last Name *">
									<input type="text" name="shipping_address" placeholder="Address *">
                                    <input type="text" name="mobile_number" placeholder="Mobile number *">
                                    <input type="text" name="shipping_city" placeholder="City *">
                                    <input type="submit" value="Done" class="btn btn-success">

									
								</form>
							</div>
							
						</div>
					</div>
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			
		</div>
	</section> <!--/#cart_items-->

    


@endsection