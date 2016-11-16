@extends('new')
@section('style')
    <link href="{{ asset('/css/demo_page.css') }}" />
    <link href="{{ asset('/css/demo_table.css') }}" />
    <link href="{{ asset('/css/DT_bootstrap.css') }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Categories {!! link_to_route('addcategory', 'Add Category', array(), array('class' => 'btn btn-primary btn-xs')) !!}
            </header>
        <div class="panel-body">
			<div class="adv-table">
            <table  class="display table table-bordered table-striped" id="example">
				<thead>
					<th>Id</th>
					<th>Category name</th>
					<th>Created At</th>
					<th>Add Subcategory</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>
				@foreach($categories as $category)
	        	<tr data-link="row" class="rowlink">
	              <td><a href="{{''.$category->slug.'/subcategories'}}">{{$category->id}}</a></td>
	              <td ><a href="{{''.$category->slug.'/subcategories'}}">{{$category->name}}</a></td>
	              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($category->created_at))->diffForHumans() }}</span></td>
	              <td>
	              	{!! link_to_route('subcat', 'Add Subcategory', array($category->slug), array('class' => 'btn btn-success btn-xs')) !!}
	              </td>
	              <td>{!! link_to_route('edit_category', 'Edit', array($category->slug,$category->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>
	              <td>
	              	{!! Form::open(array('method' => 'DELETE', 'route' => array('deleteCategory', $category->id))) !!}
					{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
					{!! Form::close() !!}
	              </td>
	          	</tr>

	          	@endforeach
	          	</tbody>
            </table>
          </div>
	</div>
	</section>
	</div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('/js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('/js/DT_bootstrap.js') }}"></script>
  <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 2, "desc" ]]
              } );
          } );
      </script>
@endsection