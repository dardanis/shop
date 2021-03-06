<?php use App\Product;
use App\Picture;

?>
<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>

<div class="row">
    <?php if($user_role=='admin'){?>
        <div class="col-md-9 col-sm-5">
        <?php } else {?>
    <div class="col-md-12 col-sm-12">
        <?php } ?>
        <div class="tabs-left">
            <ul class="nav nav-tabs">
                <li><a href='{{ url("/edit/$product->slug/$product->id") }}'><span class="glyphicon glyphicon-cog"></span>{{trans('shop.basic_info')}}</a></li>
                <?php $pictures=Product::with('pictures')->find($product->id)->pictures; ?>
                <?php if(sizeof($pictures)>0){?>
                <li><a href='{{ url("product/images/edit/$product->slug/$product->id") }}'><span class="glyphicon glyphicon-picture"></span>{{trans('shop.product_images')}}</a></li>
                <?php } else {?>
                <li><a href='{{ url("product/images/$product->slug/$product->id") }}'><span class="glyphicon glyphicon-picture"></span>{{trans('shop.product_images')}}</a></li>
                <?php } ?>

                <li><a href='{{ url("product/product_attributes/$product->slug/$product->id") }}'><span class="glyphicon glyphicon-cloud-download"></span>{{ trans('shop.product_attributes') }}</a></li>
                <li><a href='{{ url("product/create/adress/$product->slug/$product->id") }}'><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>Adress</a></li>
                <li><a href="#stars" data-toggle="tab"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#settings" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span></a></li>
            </ul>
        </div><!-- /tabbable -->
    </div><!-- /col -->
</div><!-- /row -->
<style>
    .radio input[type=radio] {
        margin-left: 0px !important;
    }

</style>

@section('scripts')

    <script src="{{ asset('/js/map_edit.js') }}"></script>
    <script>
        $(document).ready(function () {
            var checkUrl = function () {
                var found = false;
                $(".tabs-left ul li a").each(function () {
                    var href = $(this).attr("href");
                    if (window.location.href.indexOf(href) > -1 && !found) {
                        //  console.log("found it");
                        $(this).parent().addClass("active");
                        //$(this).closest(".parent").addClass("active");
                        found = true;
                    }
                    else {//console.log("notFound")
                    }
                })
                if (found == false) {
                    $(".start").addClass("active");
                }

            }
            checkUrl();
        })

        $(function () {
            $(".delete").click(function () {
                $('#load').fadeIn();
                var commentContainer = $(this).parent();
                var id = $(this).attr("id");
                var token = $('#token').val();

                $.ajax({
                    type: "POST",
                    url: "/deleteimage",
                    data: {'_token': token, 'id': id},
                    cache: false,
                    success: function (response) {
                        if (response == 1) {
                            commentContainer.slideUp('slow', function () {
                                $(this).remove();
                            });
                        }

                    }

                });

                return false;
            });
        });

    </script>
@endsection
