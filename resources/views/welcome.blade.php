<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-deal</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL::to('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{URL::to('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL::to('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL::to('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
    
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">

							<?php 
							  $email =  DB::table('tbl_cmp_contact')
										->select('tbl_cmp_contact.cmp_email')
										->limit(1)
										->get();

							$phone =  DB::table('tbl_cmp_contact')
										->select('tbl_cmp_contact.cmp_phone')
										->limit(1)
										->get();			

					       ?>			
						       <?php foreach($phone as $p){ ?>		
								<li><a href="#"><i class="fa fa-phone"></i>{{$p->cmp_phone}}</a></li>
								<?php } ?>	

								<?php foreach($email as $e){ ?>		
								<li><a href="#"><i class="fa fa-envelope"></i>{{$e->cmp_email}}</a></li>
								<?php } ?>	

							
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
							<?php 
							  $fa =  DB::table('tbl_link')
										->select('tbl_link.*')
										->where('link_name','LIKE','%'.'facebook'.'%')
										->limit(1)
										->get();
							
							 $tw =  DB::table('tbl_link')
										->select('tbl_link.*')
										->where('link_name','LIKE','%'.'twitter'.'%')
										->limit(1)
										->get();
										
							$lin =  DB::table('tbl_link')
										->select('tbl_link.*')
										->where('link_name','LIKE','%'.'linkedin'.'%')
										->limit(1)
										->get();
							
							
							?>
							   <?php foreach($fa as $f){ ?>
								<li><a href="{{url::to($f->link_address)}}" target="_blank"><i class="fa fa-facebook"></i></a></li>

							   <?php } ?>

							   <?php foreach($tw as $t){ ?>
								<li><a href="{{url::to($t->link_address)}}" target="_blank"><i class="fa fa-twitter" ></i></a></li>

							   <?php } ?>

							   <?php foreach($lin as $l){ ?>
								<li><a href="{{url::to($l->link_address)}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>

							   <?php } ?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php
										   $customer_name = Session::get('customer_name');
										   
										   
								?>
								<li><a href="{{URL::to('/')}}"><i class="fa fa-user"></i> {{$customer_name}}</a></li>
								
								<?php
										   $customer_id = Session::get('customer_id');
										   $shipping_id = Session::get('shipping_id');
								?>

                                <?php
										 if($customer_id != NULL && $shipping_id ==NULL){
                                ?>
										<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<?php }elseif($customer_id != NULL && $shipping_id !=NULL){
								?>
											 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<?php
										 }else{?>
										 <li><a href="{{URL::to('/login-check')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
											 <?php
										 }
								?>

								
								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								        
										 <?php
										 if($customer_id != NULL){
                                         ?>
										 <li><a href="{{URL::to('/customer-logout')}}">Logout</a></li>
										 <?php }else{
											 ?>
											 <li><a href="{{URL::to('/login-check')}}">Login</a></li>
									  <?php
										 }
										?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{URL::to('/')}}">Products</a></li>
										<?php
										 if($customer_id != NULL && $shipping_id ==NULL){
                                ?>
										<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
										<?php } elseif($customer_id != NULL && $shipping_id !=NULL){?>
											 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								         <?php
										 }else{?>
										 <li><a href="{{URL::to('/login-check')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
											 <?php
										 }
								?> 
										<li><a href="{{URL::to('/show-cart')}}">Cart</a></li> 	
								    </ul>
                                </li> 
								<li><a href="{{URL::to('/contact')}}">Contact</a></li>
							</ul>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="search_box pull-right" style="width:200px;">
						    <form action="{{url('/search')}}" method="post">
							{{csrf_field()}}
							<input type="text" name ="search" placeholder="Search item" style="width:200px;"/>
							</form>
					   </div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<div class="panel panel-default">	
							<?php
							$all_category = DB::table('tbl_category')
										  ->where('publication_status',1)
										  ->get();
							foreach($all_category as $c){?>
										  
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title"><a href="{{URL::to('/category-by-product',$c->category_id)}}">{{ $c->category_name }}</a></h4>
										</div>
									</div>
										  
						 	<?php }?>


							
						</div><!--/category-products-->
						</div>
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
							<?php
							$all_manufacture = DB::table('tbl_manufacture')
										  ->where('publication_status',1)
										  ->get();
							foreach($all_manufacture as $mn){?>

                                 <ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/manufacture-by-product',$mn->manufacture_id)}}"> <span class="pull-right">
									<?php 
									  $count =DB::table('tbl_product')
											->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
											->select('tbl_manufacture.manufacture_name')	
											->where('manufacture_name',$mn->manufacture_name)
											->count();
									   echo "(".$count.")";
									 
									?></span>{{ $mn->manufacture_name }}</a></li>
									
								</ul>
                           <?php }?>


							
								
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="1" data-slider-max="50000" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">1 tk</b> <b class="pull-right">50000 tk</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						@yield('content')
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Delivary</span>-Man</h2>
							<p>Biggest E-Commerce Site In Bangladesh</p>
						</div>
					</div>
					<div class="col-sm-7">
                      
					

						<?php
						   $all_delivaryman = DB::table('tbl_delivaryman')
						   ->where('publication_status',1)
						   ->limit(4)
						   ->get();
						
						
						
						   foreach($all_delivaryman as $cc){  ?>
						   <div class="col-sm-3" style="margin_top:10px;">
							<div class="photo-gallery text-center">
								<a href="{{url('/')}}">
									
										<img src="{{ URL::to($cc->delivaryman_image)}}" style="height:60px;width:125px" alt="delivaryman_image" />
									
									
								</a>
								<p>{{$cc->delivaryman_name}}</p>
								<p>Id: {{$cc->delivaryman_id}}</p>
							</div>
					       
							</div>
							<?php } ?>
						
						
						
						
						
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-Deal Inc. All rights reserved.</p>
					<p class="pull-right">Developed by <span><a target="_blank" href="#">A S M Nasim</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>
</html>