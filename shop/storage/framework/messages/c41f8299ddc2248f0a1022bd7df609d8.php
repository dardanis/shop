<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
    </div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<?php echo Form::open(array('method' => 'PATCH', 'route' => array('accounttype', Auth::user()->id))); ?>

        <?php echo Form::submit('Change account to business', array('class' => 'btn btn-primary')); ?>

        <?php echo Form::close(); ?>

	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('new_client', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>