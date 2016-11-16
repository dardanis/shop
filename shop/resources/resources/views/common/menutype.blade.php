<?php use App\Product;
use App\Picture;

?>

<div class="row">
    <div class="col-md-9 col-sm-5">
        <div class="tabs-left">
            <ul class="nav nav-tabs">

                <li><a href='{{ url("/edittype/auction/$alias/$id") }}'><span class="glyphicon glyphicon-cog"></span>{{trans('shop.basic_info')}}</a></li>
                <?php $typeAreas = \Illuminate\Support\Facades\DB::table('type_area_details')->where('type_id', '=',$id)->get(); ?>
                <?php if(sizeof($typeAreas)>0){?>
                <li><a href='{{ url("/areatype/edit/$alias/$id") }}'><span class="glyphicon glyphicon-cog"></span>Areas</a></li>
                <?php } else{ ?>
                <li><a href='{{ url("/areatype/add/$alias/$id") }}'><span class="glyphicon glyphicon-cog"></span>Areas</a></li>
                <?php } ?>

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
<style>
    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(2); /* IE */
        -moz-transform: scale(2); /* FF */
        -webkit-transform: scale(2); /* Safari and Chrome */
        -o-transform: scale(2); /* Opera */
        padding: 10px;
    }
</style>