@include('new_template.client.layouts.default')
<div class="container">
    <div id="products" class="row list-group">
        @foreach( $product as $p)
            <div class="item  col-xs-4 col-lg-4">
                <div class="thumbnail">
                    <img class="group list-group-image" src="http://img.youtube.com/vi/LsA1jJTNfnE/0.jpg" alt=""/>

                    <div class="caption">
                        <h4 class="group inner list-group-item-heading">
                            {{$alias}}</h4>

                        <p class="group inner list-group-item-text">
                            Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                            sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <p class="lead">
                                    {{ $p->price }}</p>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <a class="btn btn-success" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>