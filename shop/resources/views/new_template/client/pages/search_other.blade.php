@include('new_template.client.layouts.default')
<div class="page-content">

    <br/>
    <br/>
    <!--Blog Sidebar Left-->
    <section class="blog">
        <div class="container">
            <div class="row">

                <!--Sidebar-->
                <div class="col-lg-3 col-md-3">
                    <!--Search Widget-->
                    <h3>Search for more</h3>
                    <form method="get" action='{{ url("/searchotherblog/$") }}' class="sidebar-search"  role="search">

                        <?php
                        $cat = \App\Category::all();?>
                        <input type="text" class="form-control" name="search" placeholder="Search">
                        <button type="submit"></button>

                    </form>
                    <!--Tags-->

                </div>

                        <!--Left Column-->

                <div class="col-lg-9 col-md-9">

                    <!--Post-->
                    <?php foreach($products as $p){?>

                    <div class="post">
                        <h3 class="title"><?php echo $p->title;?></a></h3>
                        <img src="{{ asset($p->thumbnail) }}" class="img-responsive">
                        <p class="p-style3"><?php echo $p->teaser;?></p>
                        <p class="p-style3"><?php echo $p->description;?></p>
                        <footer>

                        </footer>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section><!--Blog Sidebar Left Close-->


</div>