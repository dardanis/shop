@include('new_template.client.layouts.default')
<?php $product_category=array();?>
<?php foreach($products as $p){?>
<?php $product_category=\App\Product::where('category_id', $category)->paginate(2);?>
<?php }?>
<style>
  .catalog-grid{
    width:100%;
  }
</style>
<div class="page-content">

  <div class="container">
    <section class="catalog-grid">
      <h3>Search Results</h3>
    @foreach($product_category as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="tile">

         <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>


          <div class="footer">
            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                      src="{{ asset($product->thumbnail) }}" class="img-responsive"><span>{{$product->title}}</span></a>

            <div class="tools">
              <div class="rating">
                <div class="ratings">
                  <div class="rating-box">

                    <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                  </div>
                </div>
              </div>

              <!--Add To Cart Button-->
              {!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id), 'class'=>'formCart')) !!}
              <button type="submit" class="add-cart-btn" style="border:none">
                <span>To cart</span><i class="icon-shopping-cart"></i></button>

              {!! Form::close() !!}
                      <!--Share Button-->
              <div class="share-btn">
                <div class="hover-state">
                  <a class="fa fa-facebook-square" href="#"></a>
                  <a class="fa fa-twitter-square" href="#"></a>
                  <a class="fa fa-google-plus-square" href="#"></a>
                </div>
                <i class="fa fa-share"></i>
              </div>
              <!--Add To Wishlist Button-->
              {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
              <button type="submit" class="wishlist-btn" id="cartBtn"
                      style="background: none;border:none;">
                <div class="hover-state">Wishlist</div>
                <i class="fa fa-plus"></i>
              </button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
</div>
      <!--Tile-->
    @endforeach
</section>
  </div>



</div><!--Page Content Close-->
