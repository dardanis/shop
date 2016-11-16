<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo e(Lang::get('titles.home')); ?></div>

				<div class="panel-body">
					<p><?php echo e(Lang::get('auth.sentEmail',
						['email' => $email] )); ?></p>

					<p><?php echo e(Lang::get('auth.clickInEmail')); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>