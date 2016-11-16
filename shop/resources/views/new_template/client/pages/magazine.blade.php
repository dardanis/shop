@include('new_template.client.layouts.default')
<div class="page-content">

    <!--Breadcrumbs-->
    <ol class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><?php echo $alias;?></li>
    </ol><!--Breadcrumbs Close-->

    <!--Blog Sidebar Left-->
    <section class="blog">
        <div class="container">
            <div class="row">

                <!--Sidebar-->
                <div class="col-lg-3 col-md-3">
                    <!--Search Widget-->
                    <h3>Search for <?php echo $alias; ?></h3>
                    <form method="get" action='{{ url("/searchblog/$alias") }}' class="sidebar-search"  role="search">

                        <?php
                        $cat = \App\Category::all();?>



                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <button type="submit"></button>

                    </form>
                    <!--Tags-->

                </div>


                        <?php foreach($categories as $t){?>
                            <?php $type_id=$t->type_id;?>
                <?php }?>

                <?php $products=\App\Product::whereHas('translations', function($q) use ($category_id)
                {
                $q->where('category_id', '=', $category_id);
                $q->where('status','=',1);

                })->paginate(2);?>
                <!--Left Column-->


                <div class="col-lg-9 col-md-9">
                    <h2 class="title"><?php echo $alias;?> Posts</h2>
                    <!--Post-->
                    <?php foreach($products as $p){?>
                    <div class="post">
                        <h3 class="title"><a href="{{ URL::route('product_show',array($p->slug,$p->id)) }}"><?php echo $p->title;?></a></h3>
                        <img src="{{ asset($p->thumbnail) }}" class="img-responsive">
                        <p class="p-style3"><?php echo $p->teaser;?></p>
                        <footer>
                            <a class="btn btn-success" href="{{ URL::route('product_show',array($p->slug,$p->id)) }}">Read more</a>

                            <div class="share">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook-square"></i></a>
                                <a href="#"><i class="fa fa-pinterest-square"></i></a>
                                <a href="#"><i class="fa fa-envelope"></i></a>
                            </div>
                            <ul class="meta">
                                <li> <div class="rating">
                                        <div class="ratings">
                                            <div class="rating-box">

                                                <div class="rating" style="width:{{$p->rating_cache*20}}%"></div>
                                            </div>
                                        </div>
                                    </div></li>
                                <li><i class="fa fa-user"></i><a href="profile.html"><?php echo $p->user->username; ?></a></li>
                                <?php $attributes = \Illuminate\Support\Facades\DB::table('attributes')->where('name', '=','Date')->where('category_id','=',$category_id)->get();?>
                                    <?php $prodattributes=array();?>
                                <?php foreach($attributes as $a){?>
                               <?php $prodattributes = \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id','=',$a->id)->where('product_id','=',$p->id)->get();?>
                                <?php } ?>


                                <?php foreach($prodattributes as $proda){?>
                                <li><i class="fa fa-calendar"></i><?php echo $proda->value;?></li>
                                      <?php }?>

                            </ul>
                        </footer>
                    </div>
                    <?php } ?>
                    <?php echo $products->render(); ?>
                </div>
            </div>
        </div>
    </section><!--Blog Sidebar Left Close-->


</div>