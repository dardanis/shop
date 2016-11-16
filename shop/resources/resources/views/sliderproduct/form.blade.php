@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-9">

                <section class="panel">
                    <header class="panel-heading">
                        Add Slider
                    </header>
                    <div class="panel-body">
                        @include('errors_messages')


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('saveslider') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    {!! Form::label('product_id', Lang::get('app.Product') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                                    <div class="col-lg-10">
                                        {!! Form::select('product_id',[null=>'Please Select one Product']+$products, '', array(
                                'class'                         => 'form-control',
                                'placeholder'                   => '',
                                'required',
                                //'id'                            => 'first',
                               // 'data-parsley-required-message' => 'Product is required',
                              //  'data-parsley-trigger'          => 'change focusout',

                                )) !!}

                                    </div>
                                </div>




                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    {{ Lang::get('app.Add') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop