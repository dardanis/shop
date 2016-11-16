@extends('new_client')



@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Product Images
            </header>
            <div class="panel-body">
            	<input type="hidden" name="product_id" value="{{$product}}">
				<form action="/client/c_products_step2" method="POST" class="dropzone dz-clickable" id="myDropzone">
					{!! Form::token() !!}
				</form>
				<button class="btn btn-success" id="submit-all">Upload And Finish</button>
			</div>
        </section>
    </div>
</div>   
@endsection

@section('scripts')
	<script src="{{ asset('/js/dropzone.js') }}"></script>
	<script type="text/javascript">
		Dropzone.options.myDropzone = {

  // Prevents Dropzone from uploading dropped files immediately
  autoProcessQueue: false,
  maxFilesize: 5,
    addRemoveLinks: true,
    clickable: true,
  acceptedFiles: 'image/*',
  

  init: function() {
	
	var submitButton = document.querySelector("#submit-all")
        myDropzone = this; 

    submitButton.addEventListener("click", function() {
      myDropzone.processQueue(); 
    });

    this.on("addedfile", function() {
      // Show submit button here and/or inform user to click it.
    });

  }


};
	</script>
@endsection