@extends('admin_layout')
@section('admin_content')

  
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add vendor</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
                
                
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add vendor->></h2>
                        
						
					</div>
					<p class="alert-success">{{Session::get('v')}}</p>
					<?php Session::put('v',null);?>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/save-cost')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
						  <fieldset>

							<div class="control-group">
							  <label class="control-label" for="date01">Employee Salary</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="employee_salary" required="" >
							  </div>
							</div>
                            

							<div class="control-group">
							  <label class="control-label" for="date01">Income Tax</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="income_tax" required="" >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Extra cost</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="extra" required="" >
							  </div>
							</div>

                            

                           
						
                            

                            
                           

                           

                            

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add cost</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection