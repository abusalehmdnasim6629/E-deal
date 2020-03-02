@extends('admin_layout')
@section('admin_content')
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
  <script>
 
  $(document).ready(function(){
        $('#code').click(function(){

			var txt = $(this).val()
        
			$.ajax({
                url: 'getprice/{txt}',
                type: 'get',
                data: { txt: txt },
                success: function(response)
                {
                    document.getElementById('price').value = response;
					
                }
            });

		});
	});


	function TA() {
            var price = document.getElementById('price').value;
            var qn = document.getElementById('quantity').value;
            var res = parseInt(price) * parseInt(qn);
            if (!isNaN(res)) {
                document.getElementById('tp').value = res;
            }
        }

		function ad() {
            var price = document.getElementById('tp').value;
            var dis = document.getElementById('diiscount').value;
            var re = (parseInt(price))-(parseInt(price) * (parseInt(dis)/100));
            if (!isNaN(re)) {
                document.getElementById('adiscount').value = re;
            }
        }
  </script>
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Product Sell</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
                
                
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Product Sell->></h2>
                        
						
					</div>
					<p class="alert-success">{{Session::get('v')}}</p>
					<?php Session::put('v',null);?>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/save-sell-info')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
						  <fieldset>
	
						<div class="control-group">
								<label class="control-label" for="selectError3">Product code</label>
								<div class="controls">
								  <select id="code" name="product_code">
									<option>Select Product</option>

                                    <?php
									$all_product = DB::table('tbl_pur')
												->join('tbl_product','tbl_pur.p_code','=','tbl_product.product_id')
												->select('tbl_pur.*','tbl_product.product_id','tbl_product.product_name')
							                      
                                                ->get();
                                    foreach($all_product as $b){?>
									<option value="{{$b->p_code}}">{{ $b->product_name }}</option>
            	
                                    <?php } ?>
									
								  </select>
								</div>
							</div>
                            
							<div class="control-group">
							  <label class="control-label" for="date01">Price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="price" id="price" >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Quantity</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="quantity" id="quantity" required="" onkeyup="TA()" >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Total price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="tp" id="tp"  >
							  </div>
							</div>                           
							<div class="control-group">
							  <label class="control-label" for="date01">Discount</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="discount" id="diiscount" required="" onkeyup="ad()">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">After Discount</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="discount2" id="adiscount" >
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Sell</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection