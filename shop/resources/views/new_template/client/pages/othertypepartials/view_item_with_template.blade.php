@include('new_template.client.layouts.default')
<script src="{{ asset('/js/photopreview.js') }}"></script>
<div class="page-content">

    <br/>
    <br/>
    <!--Blog Sidebar Left-->
    <section class="blog">
        <div class="container">
            <?php if($product->status==0){?>
            <div class="alert alert-warning">
                {{ Lang::get('app.The item is not approved yet from administrator') }}
                <?php if($user_role=="admin"){?>
                {!! Form::open(array('method' => 'put', 'route' => array('approvedetails', $product->slug,$product->id))) !!}
                {!! Form::submit(trans('shop.approve'), array('class' => 'btn btn-success btn-xs')) !!}
                {!! Form::close() !!}
                <?php } ?>
            </div>
            <?php } ?>
            <div class="row">

                <!--Sidebar-->
                <div class="col-lg-3 col-md-3">
                    <!--Search Widget-->
                    <h3>{{ Lang::get('app.Search for more') }}</h3>
                    <form method="get" action='{{ url("/searchotherblog/$slug") }}' class="sidebar-search"  role="search">

                        <?php
                        $cat = \App\Category::all();?>
                        <input type="text" class="form-control" name="search" placeholder="Search">
                        <button type="submit"></button>

                    </form>
                    <!--Tags-->
                    <?php 	$typesshop=\App\product_type::where('alias','=',"shop")->get();?>
                    <?php   foreach($typesshop as $c){
                        //$products=Product::with('user')->take(2)->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$c->id)->orderBy('created_at',$sort)->simplePaginate(4);
                        $type_id=$c->id;
                    }?>
                    <?php $user_id=$product->user_id;
                    $availability=$product->availability;
                    $approved=$product->status;?>

                    <?php  $relatedtoUserOther=\App\Product::whereHas('translations', function($q) use ($user_id,$approved,$availability,$type_id)
                    {
                        $q->where('user_id', '=', $user_id);
                        $q->where('status', '=', 1);
                        $q->where('availability', '>', 0);
                        $q->where('type_id', '!=', $type_id);

                    })->get();?>
                    <?php if(sizeof($relatedtoUserOther)>0){?>
                    <div class="col-md-12">
                        <h2>{{ Lang::get('app.Other Posts by this user') }}</h2>
                        @include('new_template.client.pages.productpartials.relatedpostsuser')
                    </div>
                    <?php }?>
                </div>


                <?php foreach($categories as $t){?>
                            <?php $type_id=$t->type_id;?>
                <?php }?>

                <?php $products=\App\Product::whereHas('translations', function($q) use ($slug)
                {
                    $q->where('slug', 'like', '%'.$slug.'%');
                    $q->where('status','=',1);

                })->get()?>
                        <!--Left Column-->
                {!! Form::open(array('route' => array('add_product_template',$product->id),'files'=>true,'class'=>'form-horizontal tasi-form','data-parsley-validate')) !!}
                <div class="col-lg-9 col-md-9">

                    <!--Post-->
                    <?php foreach($products as $p){?>

                    <div class="post">
                        <h3 class="title"><?php echo $p->title;?></h3>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::text('title', null, [
                               'class'                         => 'form-control',
                               'placeholder'                   => 'Please insert your title here..',
                               'required',
                               'id'                            => '',
                               'data-parsley-required-message' => 'Title Name is required',
                               'data-parsley-trigger'          => 'change focusout',


                           ]) !!}

                            </div>
                        </div>
                        <img src="{{ asset($p->thumbnail) }}" class="img-responsive">
                        <div class="form-group">
                            <div class="col-sm-12 col-md-12" style="clear:both;margin-top:10px;">
                                <div class="fileupload-new-first thumbnail img-responsive" style="width: 200px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="preview" src="#"/>
                                </div>
                                <input onchange="readURL(this)" ; class="parsley-error" placeholder="" required="required" id="imgfile" data-parsley-required-message="Front image is required" data-parsley-trigger="change focusout" name="image" type="file" data-parsley-id="14">

                            </div>

                        </div>
                        <p class="p-style3"><?php echo $p->teaser;?></p>
                        <div class="form-group">
                            <div class="col-sm-12 col-md-12">
                                {!! Form::text('teaser', null, [
                        'class'                         => 'form-control',
                        'name'=>'teaser',
                        'placeholder'                   => 'Please insert your short description here..',
                        'id'                            => '',
                        'data-parsley-required-message' => 'teaser is required',
                        'data-parsley-trigger'          => 'change focusout',
                        'style'=>'width:90%'

                        ]) !!}

                            </div>
                        </div>
                        <p class="p-style3"><?php echo $p->description;?></p>
                        <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            {!! Form::textarea('description', null, [
                    'class'                         => 'form-control',
                    'name'=>'description',
                    'placeholder'                   => 'Please insert your descripion here..',
                    'id'                            => '',
                    'data-parsley-required-message' => 'Description is required',
                    'data-parsley-trigger'          => 'change focusout',
                    'style'=>'width:90%'

                    ]) !!}

                        </div>
                            </div>
                        <footer>


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
                               <?php $prodattributes = \Illuminate\Support\Facades\DB::table('product_attributes')->where('product_id','=',$p->id)->get();?>
                                <?php } ?>


                                <?php foreach($prodattributes as $proda){?>
                                <li><i class="fa fa-calendar"></i><?php echo $proda->value;?></li>
                                <?php }?>

                            </ul>

                        </footer>
                    </div>
                    <?php } ?>
                    <input type="hidden" name="price" value=""/>
                    <input type="hidden" name="availability" value=""/>




                    <div class="col-sm-2 col-sm-offset-10" style="margin-bottom:20px;">
                        <button type="submit" class="btn btn-primary">
                            {{ Lang::get('app.Save') }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                    <br/>
                    <div class="col-md-12" style="padding:0px;">
                        <div class="box-reviews1">
                            <div class="col-sm-12" style="padding:0px;">
                                <div class="well well-sm">

                                    @if (Auth::check())
                                        <div class="text-right">
                                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">{{trans('shop.leave_review')}}</a>
                                        </div>
                                    @else
                                        {{trans('shop.log_to_post_review')}}
                                    @endif

                                    <div class="row" id="post-review-box" style="display:none;">
                                        <div class="col-md-12">
                                            <form accept-charset="UTF-8" action='{{ url("/reviews/$slug/$id") }}' method="post">

                                                <input id="ratings-hidden" name="rating" type="hidden">
                                                <textarea class="form-control"   id="new-review"  style="opactity:1!important;width:100%;resize:none;" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

                                                <div class="text-right">
                                                    <div class="stars starrr" data-rating="0"></div>
                                                    <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                                        <span class="glyphicon glyphicon-remove"></span>{{trans('shop.cancel')}}</a>
                                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                    <button class="btn btn-success btn-sm" type="submit">{{trans('shop.save')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @foreach($reviews as $review)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php $userss= \Illuminate\Support\Facades\DB::table('users')->where('id', '=', $review->user_id)->get()?>
                                            <?php foreach($userss as $u){?>
                                    <?php echo $u->username;?>
                                    <?php }?>

                                            @for ($i=1; $i <= 5 ; $i++)
                                                <span style="font-size: 18px !important;color: rgb(255, 214, 88);" class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                                            @endfor

                                            <span class="pull-right">{{ Carbon::createFromTimestamp(strtotime($review->created_at))->diffForHumans() }}</span>

                                            <p>{{{$review->comment}}}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- related to the user or category -->

            </div>
        </div>
    </section><!--Blog Sidebar Left Close-->


</div>
<script>
    (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; opacity:1 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

    var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

    $(function(){

        $('#new-review').autosize({append: "\n"});

        var reviewBox = $('#post-review-box');
        var newReview = $('#new-review');
        var openReviewBtn = $('#open-review-box');
        var closeReviewBtn = $('#close-review-box');
        var ratingsField = $('#ratings-hidden');

        openReviewBtn.click(function(e)
        {
            reviewBox.slideDown(400, function()
            {
                $('#new-review').trigger('autosize.resize');
                newReview.focus();
            });
            openReviewBtn.fadeOut(100);
            closeReviewBtn.show();
        });

        closeReviewBtn.click(function(e)
        {
            e.preventDefault();
            reviewBox.slideUp(300, function()
            {
                newReview.focus();
                openReviewBtn.fadeIn(200);
            });
            closeReviewBtn.hide();

        });

        $('.starrr').on('starrr:change', function(e, value){
            ratingsField.val(value);
        });
    });
</script>