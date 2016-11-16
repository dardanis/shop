
@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add subcategory 
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
          @foreach($category as $c)
         <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/subcategories') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" >
                    <input type="hidden" value="{{$c->id}}" name="cat_id"> 
                </div>
            </div>
            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                <button type="submit" class="btn btn-primary">
                  Add Subategory
                </button>
            </div>
          </form>
           @endforeach
          </div>
        </section>     
    </div>
</div>                      

@stop