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
                {{trans('shop.categories')}} {!! link_to_route('addcategory', 'Add Category', array(), array('class' => 'btn btn-primary btn-xs')) !!}
            </header>
        <div class="panel-body">
        @include('errors_messages')
			<div class="adv-table">
            <table  class="display table table-bordered table-striped" id="example">
				<thead>
					<th>{{trans('shop.id')}}</th>
					<th>{{trans('shop.category_name')}}</th>
                    <th>Type</th>
					<th>{{trans('shop.created_at')}}</th>
					<th>{{trans('shop.add_subcategory')}}</th>
					<th>{{trans('shop.edit')}}</th>
					<th>{{trans('shop.delete')}}</th>
				</thead>
				<tbody>
				@foreach($categories as $category)
	        	<tr data-link="row" class="rowlink">
	              <td><a href="{{''.$category->slug.'/subcategories'}}">{{$category->id}}</a></td>
	              <td ><a href="{{''.$category->slug.'/subcategories'}}">{{$category->name}}</a></td>
                    <td>
                        <?php  $type= \Illuminate\Support\Facades\DB::table('product_types')->where('id', '=',$category->type_id)->get();?>
                        <?php foreach($type as $t){?>
                        <?php echo $t->name;?>
                            <?php } ?>
                    </td>
	              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($category->created_at))->diffForHumans() }}</span></td>
	              <td>
	              	{!! link_to_route('subcat',trans('shop.add_subcategory'), array($category->slug), array('class' => 'btn btn-success btn-xs col-md-3')) !!}
	              </td>
	              <td>{!! link_to_route('edit_category', trans('shop.edit'), array($category->slug,$category->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>

	          	<td>
                {!! Form::open(array('method' => 'DELETE', 'route' => array('deleteCategory', $category->id))) !!}
                {!! Form::submit(trans('shop.delete'), array('class' => 'btn btn-danger btn-xs')) !!}
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
@endsection

@section('scripts')
  <script src="{{ asset('/js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('/js/DT_bootstrap.js') }}"></script>
  <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable({
                  "iDisplayLength": 500,
              });
          } );
      </script>
@endsection