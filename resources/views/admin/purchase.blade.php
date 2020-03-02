@extends('admin_layout')
@section('admin_content')

<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript">
        function totalprice() {
            var price = document.getElementById('per_product_price').value;
            var quantity = document.getElementById('product_quantity').value;
            var result = parseInt(price) * parseInt(quantity);
            if (!isNaN(result)) {
				
               document.getElementById('product_total_price').value = result;
            }
        }

		function dis() {
            var tprice = document.getElementById('product_total_price').value;
            var discount = document.getElementById('discount').value;
            var res = parseInt(tprice) - (parseInt(tprice) *( parseInt(discount)/100));
            if (!isNaN(res)) {
                document.getElementById('after_discount').value = res;
            }
        }
		function pay() {
            var payment = document.getElementById('paymentAmount3').value;
            var tamount = document.getElementById('after_discount').value;
            var res = parseInt(tamount) - parseInt(payment);
            if (!isNaN(res)) {
                document.getElementById('paymentAmount1').value = res;
            }
        }

		function showHide(checked){
                 
             if(checked == true){

				 $("#paymentAmount").fadeIn();
				 $("#paymentAmount1").fadeIn();
				 $("#paymentAmount2").fadeIn();
				 $("#paymentAmount3").fadeIn();
			 }else{
				$("#paymentAmount").fadeOut();
				$("#paymentAmount3").fadeOut();
				$("#paymentAmount1").fadeOut();
				$("#paymentAmount2").fadeOut();
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
					<a href="#">Purchase Product</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
                
                
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Purchase Product->></h2>
                        <span>[Product barcode genarate automaticaly] </span>
						
					</div>
					<p class="alert-success">{{Session::get('message')}}</p>
					<?php Session::put('message',null);?>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/add-stock')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
						  <fieldset>
						  <div class="control-group">
								<label class="control-label" for="selectError3">Vendor name</label>
								<div class="controls">
								  <select id="selectError3" name="vendor_name">
									<option>Select vendor</option>

                                    <?php
									$all_vendor = DB::table('tbl_vendor')
                                                ->get();
                                    foreach($all_vendor as $b){?>
									<option value="{{$b->vendor_name}}">{{ $b->vendor_name }}</option>
            	
                                    <?php } ?>
									
								  </select>
								</div>
							</div>




                            <div class="control-group">
								<label class="control-label" for="selectError3">Product name</label>
								<div class="controls">
								  <select id="selectError3" name="product_name">
									<option>Select Product</option>

                                    <?php
									$all_product = DB::table('tbl_product')
									             ->select('tbl_product.*')
                                                 ->get();
                                    foreach($all_product as $b){?>
									<option value="{{$b->product_id}}">{{ $b->product_name }}</option>
            	                    
                                    <?php } ?>
									
								  </select>
								</div>
							</div>

                           
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_description" required="" rows="3"></textarea>
							  </div>
							</div>
                            

                            <div class="control-group">
							  <label class="control-label" for="date01">Per Product price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="per_product_price" name="per_product_price" required="" onkeyup="totalprice()"  >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Quantity</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_quantity" id="product_quantity" required="" onkeyup="totalprice()" >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Total Price</label>
							  <div class="controls">
								
								<input type="text" class="input-xlarge" name="product_total_price" id="product_total_price" required=""onkeyup="dis()" >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Discount</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="discount" name="discount" required=""onkeyup="dis()" > <span>%</span>
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">After Discount</label>
							  <div class="controls">
							 
								<input type="text" class="input-xlarge" id="after_discount" name="after_discount" required="" > 
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Partial Payment</label>
							  <div class="controls">
							 
								<input type="checkbox" class="input-xlarge" id="p_p" name="p_p" onChange="showHide(this.checked)" value='partial_payment'> 
							  
							  </div>
							</div>
							<div class="control-group" id="paymentAmount">
							  <label class="control-label" for="date01">Payment amount</label>
							  <div class="controls">
							 
								<input type="text" class="input-xlarge" id="paymentAmount3" name="p_a"onkeyup="pay()" > 
							  
							  </div>
							</div>

							<div class="control-group" id="paymentAmount2">
							  <label class="control-label" for="date01">Remaining due</label>
							  <div class="controls">
							 
								<input type="text" class="input-xlarge" id="paymentAmount1" name="r_d" > 
							  
							  </div>
							</div>
                            
							<div class="control-group">
								<label class="control-label" for="selectError3">Delivary Status</label>
								<div class="controls">
								  <select id="selectError3" name="delivary_status">
									<option>Select status</option>
                                    
                                    <?php
									$all_product = DB::table('tbl_delivary_status')
                                                ->get();
                                    foreach($all_product as $b){?>
									<option value="{{$b->delivary_status}}">{{ $b->delivary_status }}</option>
            	
                                    <?php } ?>
									
								  </select>
								</div>
							</div>


                            <div class="control-group">
							  <label class="control-label" for="fileInput">Product image</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="p_image" id="fileInput" type="file">
							  </div>
							</div>  

                         

                            

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Purchase</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection