
@extends('new')

@section('content')
<div class="row">

    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.add_subcategory')}}
            </header>
          <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

         <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/subcategories') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name[]" >
                    <input type="hidden" value="{{$category->id}}" name="cat_id">
                </div>
                 <div class="col-sm-2">
                     <input type="button" value="+" id="" class="btn btn-default btn-add-sub"/>
                 </div>
            </div>

            <div id="add-sub"></div>
            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                <button type="submit" class="btn btn-primary">
                  {{trans('shop.add_subcategory')}}
                </button>
            </div>
          </form>

          </div>
        </section>
    </div>
</div>

@stop
<script>
    $(document).ready(function(){
        $(".btn-add-sub").on('click',function () {
            var newTextBoxDiv = $(document.createElement('Div'))
                    .attr("class", 'otheroptions');
            newTextBoxDiv.html('<div class="col-md-2 col-sm-2"></div><div class="col-md-3"><input type="text" class="form-control txtplus" placeholder="Enter Values" style="margin-top:10px" name="attribute_item[]"></div>');
            newTextBoxDiv.appendTo("#add-dynamic-items");
        });

    })
</script>