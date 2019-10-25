@extends('welcome')
@section('content')

<?php    $sub_total = 0;?>
<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
               <?php
                 
                  $content = Cart::getcontent();
                //   echo "<pre>";
                //   print_r($content);
                //    echo "</pre>";

               
               
               ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
                            <td>Action</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                       <?php foreach($content as $con){?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($con->img)}}" height="80px" width="80px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$con->name}}</a></h4>
								<p>Id: {{$con->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{$con->price}} tk</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
                                    <form action="{{url('/update-cart',$con->id)}}" method="post">
                                    {{csrf_field()}}
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$con->quantity}}" autocomplete="off" size="2">
									<input type="submit" class="btn btn-sm btn-default" name="submit" value="update">
                                    </form>
								</div>
							</td>
							<td class="cart_total">
                                <p class="cart_total_price">
                                <?php 
                                $t=$con->price ;
                                $q = $con->quantity;
                                $total = $t*$q;
                                $sub_total = $sub_total+$total;
                                echo $total;  
                                
                                
                                
                                ?> tk</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart',$con->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                       <?php }?>

						
						
					</tbody>
				</table>
			</div>
		</div>
</section> <!--/#cart_items-->
<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div>
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Payment method</li>
			</ol>
		</div>
		<div class="paymentCont col-sm-8">
					<div class="headingWrap">
							<h3 class="headingTop text-center">Select Your Payment Method</h3>	
							<p class="text-center">Created with bootsrap button and using radio button</p>
					</div>
					<!-- <div class="paymentWrap">
						<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
				            <label class="btn paymentMethod active">
				            	<div class="method visa"></div>
				                <input type="radio" name="options" checked>
				            </label>
				            <label class="btn paymentMethod">
				            	<div class="method master-card"></div>
				                <input type="radio" name="options"> 
				            </label>
				            <label class="btn paymentMethod">
			            		<div class="method amex"></div>
				                <input type="radio" name="options">
				            </label>
				       <label class="btn paymentMethod">
			             		<div class="method vishwa"></div>
				                <input type="radio" name="options"> 
				            </label>
				            <label class="btn paymentMethod">
			            		<div class="method ez-cash"></div>
				                <input type="radio" name="options"> 
				            </label> 
				         
				        </div>        
					</div> -->
					<form action="{{url('/order-place')}}"method="post">
					{{csrf_field()}}
					   <input type="radio" name="payment_method" value="handcash">Hand cash <br>
					   <input type="radio" name="payment_method" value="card">Debit card <br>
					   <input type="radio" name="payment_method" value="bkash">Bkash <br>
					   <input type="submit" name="submit" value="Order" class="btn btn-success">
					
					
					
					
					</form>
				</div>
	</div>
</section><!--/#do_action-->

@endsection