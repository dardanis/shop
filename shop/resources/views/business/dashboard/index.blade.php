@extends('new_business')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Dashboard
            </header>
            <div class="panel-body">
            {!! link_to_route('business_products', 'Products', array(), array('class' => 'btn btn-primary')) !!}
        </div>
        </section>
    </div>
</div>
@endsection