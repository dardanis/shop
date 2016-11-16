<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
    <link href="<?php echo e(asset('/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/metisMenu.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/sb-admin-2.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
</head>
<body>
	    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">SHOP</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
            	<li>
						<form action="<?php echo e(URL::route('language-chooser')); ?>" method="post"> 
							<select id="locale" name="locale">
					 			<option value="en">English</option>
					 			<option value="de" <?php echo e(Lang::locale()==='de'? ' selected':''); ?>>German</option>
					 			<option value="fr" <?php echo e(Lang::locale()==='fr'? ' selected':''); ?>>French</option>
							</select>
							<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						</form>
					</li>  
                  <?php if(Auth::check()): ?>  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                        <i class="fa fa-user fa-fw"></i> <?php echo e(Auth::user()->name); ?> <i class="fa fa-caret-down"></i>

                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo e(url('profile')); ?>"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo e(url('logout')); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo e(url('business/dashboard')); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>My Products<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(url('business/products')); ?>">All Products</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('business/products/add')); ?>">Add product</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="<?php echo e(asset('/js/metisMenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/sb-admin-2.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/photopreview.js')); ?>"></script>
    <script type="text/javascript">
        $(document).on('change', '#first', function () {
        var first = $(this).find(':selected').val();
        var token=$('#token').val();
           $.ajax({
                url: "/ajax",
                type:"POST",
                data: {'_token':token,'first': first },
                success:function(data){
                    var html = '';
                   $.each(data, function (id, name) {
                       html += '<option value="'+id+'">' + name + '</option>';
                   });
                    $('#second').html(html);
                },error:function(){ 
                    alert("error!!!!");
                }
            });
        });
    </script>
	<script>
		$(function() {
		    $('#locale').change(function() {
		        this.form.submit();
		    });
		})
	</script>
	<script type="text/javascript">
		$('.events-category').change( function(){
		    var c = this.checked;
		    if( c ){
		        $(this).next('.event-children').css('display', 'block');
		    }else{
		        $(this).next('.event-children').css('display', 'none');
		    }
		});
		$('.events-child-category-all').change( function(){
		    var c = this.checked;
		    if( c ){
		        $(this).siblings(':checkbox').attr('checked',true);
		    }else{
		        $(this).siblings(':checkbox').attr('checked',false);
		    }
		});

	</script>
</body>
</html>
