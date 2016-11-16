@extends('new')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Invoices
            </header>
            <div class="panel-body">
            	<div class="adv-table">
            		<table  class="display table table-bordered table-striped" id="example">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Interval</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices->data as $invoice)
                       <tr >
                        <td >{{$invoice->id}}</td>
                       
                       </tr>
                        @endforeach
                        </tfoot>
                      </table>
            	</div>
            </div>
        </section>
    </div>
</div>
@endsection