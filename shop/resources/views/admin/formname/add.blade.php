
@extends('new')

@section('content')
    <div class="row">


        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    {{ Lang::get('app.Add Form') }}

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

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/formname') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="group_name" >
                            </div>

                        </div>
                    <div class="form-group">
                        {!! Form::label('category', trans('shop.category') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                        <div class="col-lg-4">
                            {!! Form::select('category_id',[null=>'Please Select one category']+$category, '', array(
                    'class'                         => 'form-control',
                    'placeholder'                   => '',
                    'required',
                    'id'                            => 'first-scratch',
                    'data-parsley-required-message' => 'Category Name is required',
                    'data-parsley-trigger'          => 'change focusout',

                    )) !!}

                        </div>
                    </div>

                        <div class="col-sm-1 col-sm-offset-4" style="margin-right:20px;">
                            <button type="submit" class="btn btn-primary">
                                {{ Lang::get('app.Add Form Name') }}
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