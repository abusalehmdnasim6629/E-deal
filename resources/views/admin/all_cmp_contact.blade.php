@extends('admin_layout')
@section('admin_content')

           <ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Contacts</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Contact id</th>
								  <th>Email</th>
                                  <th>phone</th>
								  
								  <th>Action</th>
							  </tr>
						  </thead>   

						@foreach($con as $p)
						  <tbody>
							<tr>
								<td>{{ $p->cmp_id}}</td>
								
                                <td>{{ $p->cmp_email}}</td>
								<td>{{ $p->cmp_phone}}</td>
								
								<td class="center">
									
									<a class="btn btn-danger" href="{{URL::to('/delete-contact/'.$p->cmp_id)}}">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
						  </tbody>

						@endforeach

					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
@endsection