@extends('new_template.client.layouts.usernav')
@section('style')
    <link href="{{ asset('/css/demo_page.css') }}" />
    <link href="{{ asset('/css/demo_table.css') }}" />
    <link href="{{ asset('/css/DT_bootstrap.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="page-content" style="margin-top:0px;overflow: auto;">
        <div class=" col-main col-lg-12">


                <header class="panel-heading" style="padding-left: 0px;">
                 <span style="padding-right: 10px;">{{Lang::get('app.Adresess')}}</span>  {!! link_to_route('add_useradress', Lang::get('app.Add Adress'), array(), array('class' => 'btn btn-primary btn-xs')) !!}
                </header><br/><br/>
            @if( Session::has( 'success' ))
                <div class="alert alert-success">{{ Session::get( 'success' ) }}</div>
                @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
            @endif
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="example">
                            <thead>
                            <tr>
                                <th>{{ Lang::get('app.Adress Name') }}</th>
                                <th>{{ Lang::get('app.Tel') }}</th>
                                <th>{{ Lang::get('app.Mobile') }}</th>
                                <th>{{ Lang::get('app.Email') }}</th>
                                <th>{{ Lang::get('app.Web') }}</th>
                                <th>{{ Lang::get('app.Adressline') }}</th>
                                <th>{{ Lang::get('app.Created at') }}</th>
                                <th>{{ Lang::get('app.Make Default adress') }}</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($adress as $a)
                                <tr>
                                    <td >{{$a->name}}</td>
                                    <td >{{$a->tel}}</td>
                                    <td >{{$a->mobile}}</td>
                                    <td >{{$a->email}}</td>
                                    <td >{{$a->web}}</td>
                                    <td >{{$a->adress_line}}</td>
                                    <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($a->created_at))->diffForHumans() }}</span></td>
                                    <td>  {!! Form::open(array('method' => 'POST', 'route' => array('defaultadress', $a->id))) !!}
                                        {!! Form::submit(Lang::get('app.Default Adress'), array('class' => 'btn btn-success btn-xs')) !!}
                                        {!! Form::close() !!}</td>
                                    <td>{!! link_to_route('edit_adress', 'Edit', array($a->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>
                                    <td>
                                        {!! Form::open(array('method' => 'DELETE', 'route' => array('adressdelete', $a->id))) !!}
                                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


        </div>
            </div>
    </div>
@endsection

