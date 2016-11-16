@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                        Add Area
                    </header>
                    <div class="panel-body">
                        @include('errors_messages')

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/areadetails/save') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="area_name">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Alias*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="area_alias">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Description*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="area_description">
                                </div>

                            </div>


                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    Add Area
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop