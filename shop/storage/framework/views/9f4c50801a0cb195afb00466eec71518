

    <?php if(sizeof($images)>0){?>
            <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div id="slider1_container" style="position: relative; width: 720px;  max-width: 536px; height: 445px; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
				                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(/images/loadingSlider.gif) no-repeat center center;
                                        top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>
        <!-- Slides Container -->
        <div u="slides" style="cursor: pointer; position: absolute; left: 0px; top: 0px; width: 720px; height: 445px;
				            overflow: hidden;">

            <?php foreach($images as $im){?>


            <?php if($im->image!=""&&$im->image!=null)
            {?>

            <div>
                <img  u="image" class="big_img_slider" src="/<?php echo $im->image; ?>" alt=""/>
                <img u="thumb" src="/<?php echo $im->image;  ?>" alt=""/>
            </div>

            <?php }?>
            <?php }?>
        </div>

        <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort07" style="position: absolute; width: 720px; height: 100px; left: 0px; bottom: 0px; overflow: hidden; ">
            <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 100%; height:100%;"></div>

            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 99px; HEIGHT: 66px; TOP: 0; LEFT: 0;">
                    <div u="thumbnailtemplate" class="i" style="position:absolute;"></div>
                    <div class="o">
                    </div>
                </div>
            </div>

            <!-- Arrow Left -->
							            <span u="arrowleft" class="jssora11l" style="width: 37px; height: 37px; top: 123px; left: 8px;">
							            </span>
            <!-- Arrow Right -->
							            <span u="arrowright" class="jssora11r" style="width: 37px; height: 37px; top: 123px; right: 8px">
							            </span>
            <!-- Arrow Navigator Skin End -->
        </div>
        <!-- ThumbnailNavigator Skin End -->

        <!-- Trigger -->
        </div>
        <?php } ?>


