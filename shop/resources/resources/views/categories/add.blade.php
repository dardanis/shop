@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-9 col-sm-5">
                        <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href='#'><span class="glyphicon glyphicon-cog"></span>Basic
                                        Info</a></li>
                            </ul>
                        </div>
                        <!-- /tabbable -->
                    </div>
                    <!-- /col -->
                </div>
                <!-- /row -->
            </div>
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                        Add category
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
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/categories') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Name</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    Add Category
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop