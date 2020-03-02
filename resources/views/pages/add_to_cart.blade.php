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
								<a href=""><img src="{{URL::to($con->id)}}" height="80px" width="80px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$con->name}}</a></h4>
								
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
                                $t=$con->price;
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
    
	<form action="{{url('/addpromo')}}" method="post">
	{{csrf_field()}}
	<h3>Add promo code :</h3> <input type="text" name="promocode" onkeyup="discount()" id="promocode">
	<input type="submit" name="add promo"  id="">
    </form>

    <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
			
				<div class="col-sm-8">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span><?php echo $sub_total; ?></span></li>
							<li>Discount<span><?php 
							$d = Session::get('dis');
							echo $d.' %';
							
							
							?></span></li>
							<li>After Discount <span id="disc"><?php 
							$d= Session::get('dis');
							if($d!=null){
							$sub_total = $sub_total - ($sub_total*($d/100)); 
							echo $sub_total;}
							else{
								echo $sub_total;
							}
							
							?></span></li>
							<li>Eco Tax <span><?php $tax = 200.00; echo $tax?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span><?php $sum=$tax+$sub_total;echo $sum; Session::put('total',$sum);?></span></li>
						</ul>
                           
							<a type="text" class="btn btn-default update"href= "">Update</a>

							<?php
										   $customer_id = Session::get('customer_id');
								?>

                                <?php
										 if($customer_id != NULL){
                                ?>
										<a type="text" class="btn btn-default update"href= "{{url('/checkout')}}">check out</a>
								<?php }else{
								?>
											 <a type="text" class="btn btn-default update"href= "{{url('/login-check')}}">check out</a>
								<?php
										 }
								?>

                            
                        
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

<script>


        function discount(){
		var txt = document.getElementById('promocode').value;
			
        
			$.ajax({
                url: 'getdiscount/{txt}',
                type: 'get',
                data: { txt: txt },
                success: function(response)
                {
                    document.getElementById('dis').value = response;
					
                }
            });

		}











</script>
@endsection