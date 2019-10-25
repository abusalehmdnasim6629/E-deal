@extends('welcome')
@section('content')


<h2 class="title text-center">Features Items</h2>
             <?php   foreach($search_item as $s){?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{ $s->product_image}}" style="height:100px;width:100px" alt="" />
										<h2>{{ $s->product_price}} tk</h2>
										<p>{{ $s->product_name}}</p>
										<a href="{{URL::to('/view-product/'.$s->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>{{ $s->product_price}}</h2>
											<p>{{ $s->product_name}}</p>
											<a href="{{URL::to('/view-product/'.$s->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>{{ $s->manufacture_name}}</a></li>
										<li><a href="{{URL::to('/view-product/'.$s->product_id)}}"><i class="fa fa-plus-square"></i>View product</a></li>
									</ul>
								</div>
							</div>
						</div>	
			         <?php } ?>	
					</div><!--features_items-->
					
					
					


@endsection