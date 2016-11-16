<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="<?php echo e(asset('/css/app.css')); ?>" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo e(url('/')); ?>">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
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
					<?php if(Auth::guest()): ?>
						<li><a href="<?php echo e(url('login')); ?>">Login</a></li>
						<li><a href="<?php echo e(url('register')); ?>">Register</a></li>
					<?php else: ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo e(Auth::user()->name); ?> <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo e(url('logout')); ?>">Logout</a></li>
							</ul>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>

	<?php echo $__env->yieldContent('content'); ?>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
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
