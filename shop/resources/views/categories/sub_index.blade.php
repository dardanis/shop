@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$cname}} {!! link_to_route('subcat', 'Add Subcategory', array($slug), array('class' => 'btn btn-success btn-xs')) !!}
            </header>
          	<div class="panel-body">
				<div class="adv-table">
		            <table  class="display table table-bordered table-striped" id="example">
						<thead>
							<th>Id</th>
							<th>Subategory name</th>
							<th>Created At</th>
							<th>Edit</th>
							<th>Delete</th>
						</thead>
						<tbody>
						@foreach($cat as $c)
							@if($c->subcategories)
								@foreach($c->subcategories as $s)
					          	<tr >
						          	<td>{{$s->id}}</td>
						            <td>{{$s->name}}</td>
						            <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($s->created_at))->diffForHumans() }}</span></td>
						            <td>{!! link_to_route('edit_sub', 'Edit', array($s->slug), array('class' => 'btn btn-warning btn-xs')) !!}</td>
						            <td>
						            	{!! Form::open(array('method' => 'DELETE', 'route' => array('deleteSubcategory', $s->id))) !!}
										{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
										{!! Form::close() !!}
						            </td>
					        	</tr>
				        		@endforeach
							@endif
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