<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo e(Lang::get('titles.home')); ?></div>

				<div class="panel-body">
					<p>An email was sent to <?php echo e($email); ?> &nbsp<?php echo e(Carbon::createFromTimestamp(strtotime($date))->diffForHumans()); ?>.</p>

					<p><?php echo e(Lang::get('auth.clickInEmail')); ?></p>
					
					<p><a href='/resendEmail'><?php echo e(Lang::get('auth.clickHereResend')); ?></a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>