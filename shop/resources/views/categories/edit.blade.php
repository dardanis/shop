@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit Category 
            </header>
          <div class="panel-body">
               		{!! Form::model($category, array('class'=>'form-horizontal tasi-form','method' => 'PATCH', 'route' => array('category_update', $category->id))) !!}
					@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
					@endif
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
					{!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Please insert your postt title here...')) !!}
					</div>
				</div>				
				<div class="form-group">			
					<div class="col-sm-offset-10">
					{!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
					{!! link_to_route('categoriesindex', 'Cancel', array(), array('class' => 'btn btn-danger'))!!}
					{!! Form::close() !!}
					</div>
				</div>
		</div>
	</section>
	</div>
</div>
@endsection
