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
						<h2><i class="halflings-icon user"></i><span class="break"></span>Products</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>delivaryman id</th>
								  <th>delivaryman name</th>
                                  <th>delivaryman image</th>
								  <th>Publication status</th>
								  <th>Action</th>
							  </tr>
						  </thead>   

						@foreach($all_delivaryman_info as $p)
						  <tbody>
							<tr>
								<td>{{ $p->delivaryman_id}}</td>
								<td class="center">{{ $p->delivaryman_name}}</td>
								<td><img src="{{URL::to($p->delivaryman_image)}}" alt="delivaryman image" style="height:70px; width:70px"> </td>
	
								<td class="center">
								    @if($p->publication_status==1)
										<span class="label label-success">Active</span>
									
									
								    @elseif($p->publication_status==0)
										<span class="label label-danger">Deactive</span>
									


									@endif
								</td>

								<td class="center">
                                 @if ($p->publication_status==1 )
                                        <a class="btn btn-danger" href="{{URL::to('/deactive-delivaryman/'.$p->delivaryman_id)}}">
                                            <i class="halflings-icon white thumbs-down"></i>  
                                        </a>
                                 @else
                                    <a class="btn btn-success" href="{{URL::to('/active-delivaryman/'.$p->delivaryman_id)}}">
                                            <i class="halflings-icon white thumbs-up"></i>  
                                        </a>
                                @endif

									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-delivaryman/'.$p->delivaryman_id)}}">
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