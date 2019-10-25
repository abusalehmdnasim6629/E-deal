@extends('welcome')
@section('content')



<h2 class="title text-center">Features Items</h2>
             <?php   foreach($all_published_product as $pp){?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{ $pp->product_image}}" style="height:100px;width:100px" alt="" />
										<h2>{{ $pp->product_price}} tk</h2>
										<p>{{ $pp->product_name}}</p>
										<a href="{{URL::to('/view-product/'.$pp->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>{{ $pp->product_price}}</h2>
											<p>{{ $pp->product_name}}</p>
											<a href="{{URL::to('/view-product/'.$pp->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
					
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
								 <?php
								 $avg = DB::table('tbl_product') 
								     ->AVG('product_price');
								     
								 $ri =  DB::table('tbl_product') 
									 ->where('product_price','<=',$avg)
									 ->limit(3)
									 ->get();
								 
								 foreach($ri as $r){?>	

									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::to($r->product_image)}}"  style="height:100px;width:100px" alt="" />
													<h2><?php echo $r->product_price ;?></h2>
													<p><?php echo $r->product_name ;?></p>
													<a href="{{URL::to('/view-product/'.$pp->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								 <?php } ?>
								
									
									
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->


@endsection