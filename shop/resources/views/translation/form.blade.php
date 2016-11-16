@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                        Add Translations
                    </header>
                    <div class="panel-body">
                        @include('errors_messages')

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/translation/save') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group @if($errors->has('label')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Label*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="label">
                                </div>

                            </div>

                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Description*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="description">
                                </div>

                            </div>


                            <div class="form-group @if($errors->has('de')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">De*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="de">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('en')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">En*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="en">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('fr')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Fr*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fr">
                                </div>

                            </div>


                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    {{ Lang::get('app.Add Translation') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop