@extends('admin_layout')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


  
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add link</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
                
                
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Link->></h2>
                        
						
					</div>
					<p class="alert-success">{{Session::get('v')}}</p>
					<?php Session::put('v',null);?>
					<div class="box-content">
						<form class="form-horizontal" id="link" method="post" action="{{url('/save-link')}}" enctype="multipart/from-data">
                        {{ csrf_field() }}
						  <fieldset>
							
								<input type="text" id="name" class="input-xlarge"  name="link_name" placeholder='Enter link name' required="" > <br> <br>
				
                            
                   
                           
							
								<input  type="text" id="address" class="input-xlarge" name="link_address" placeholder='Enter link address' required="" >
							
                            
							<div class="form-actions">
							  <input type="submit" id ='addv' class="btn btn-primary" value='Add link'>
							  
							</div>
						  </fieldset>
						</form>   

					</div>

					

				</div><!--/span-->

			</div><!--/row-->

			<script>
				

			</script>

@endsection