@extends('new_template.client.layouts.default')
@section('content')
    <div class="page-content">

        <div class="container">
    <div class="row">
        <div class="col-md-12"><br/>
            <h2>Your past orders</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-sm-2">Id</th>
                    <th class="col-sm-4">Date</th>
                    <th class="col-sm-2"></th>
                </tr>
                </thead>


                    <tr>
                        <td><?php echo  $orders->id; ?></td>

                        <td><a href="/order/{{$orders->order_id}}"> {{$orders->created_at}}</a></td>

                    </tr>


            </table>
        </div>
    </div>
    </div>
    </div>
@endsection