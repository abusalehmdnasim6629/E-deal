@extends('welcome')
@section('content')
<h2 class="title text-center">Features Items</h2>
             <?php   foreach($view_product_by_manufacture as $pp){?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{ URL::to($pp->product_image)}}" style="height:100px;width:100px" alt="" />
										<h2>{{ $pp->product_price}} tk</h2>
										<p>{{ $pp->product_name}}</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>{{ $pp->product_price}}</h2>
											<p>Easy Polo Black Edition</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>{{ $pp->manufacture_name}}</a></li>
										<li><a href="{{URL::to('/view-product/'.$pp->product_id)}}"><i class="fa fa-plus-square"></i>View product</a></li>
									</ul>
								</div>
							</div>
						</div>	
			 <?php } ?>	
					    </div><!--features_items-->
					
					


@endsection