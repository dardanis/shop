@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<a href="{{url('register')}}"><button  class="btn btn-primary">Register as client</button></a>
				<a href="{{url('business/register')}}"><button  class="btn btn-primary">Register as Business</button></a>
			</div>
		</div>
	</div>
</div>
@endsection
