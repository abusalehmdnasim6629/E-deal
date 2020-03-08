@extends('welcome')
@section('content')
@include('sweetalert::alert')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
						 <?php $co = Session::get('cd');
						 Session::put('co',$co);
						 
						 ?>
		    			<p>Conformation Code send to your email</p> <br> <br> 
						<form action="{{url('/customer-registration2')}}" method="post">
                          {{ csrf_field() }}
							<input type="text" style="height:30px;" name="code" placeholder="Enter conformation code" require=""/>
							<button type="submit" style="height:27px;" class="btn btn-default">Confrim</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection