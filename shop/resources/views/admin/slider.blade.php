@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Slider 
            </header>
            <div class="panel-body">
            	<form action="{{ url('/admin/slider') }}" method="POST">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            		<div class="pricing-levels-3">
				          <p><strong>Select 3 Categories to display products in slider</strong></p>
				          @foreach($categories->chunk(4) as $chunk)
				          	@foreach($chunk as $c)
				          	<input class="single-checkbox"type="checkbox" name="category[]" value="{{$c->id}}">{{$c->name}}<br>
				          	@endforeach
				          @endforeach
				        </div>
            		
            		<div class="col-sm-1 col-sm-offset-10" style="padding:0px;">
		                <button type="submit" class="btn btn-primary">
		                  Save Categories
		                </button>
		            </div>
            	</form>
            </div>
        </section>
    </div>
</div>	
@endsection

@section('scripts')
	<script type="text/javascript">
		var limit = 3;
		$('input.single-checkbox').on('change', function(evt) {
		   if($(this).siblings(':checked').length >= limit) {
		       this.checked = false;
		   }
		   console.log(limit);
		});
	</script>
@endsection