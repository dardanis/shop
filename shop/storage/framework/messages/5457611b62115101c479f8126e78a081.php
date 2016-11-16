<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit user 
            </header>
            <div class="panel-body">
           		<?php echo Form::model($user, array('class'=>'form-horizontal tasi-form','method' => 'PATCH', 'route' => array('user_update', $user->id))); ?>

				<?php if($errors->any()): ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo e(implode('', $errors->all('<li class="error">:message</li>'))); ?>

				</div>
				<?php endif; ?>
			<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
				<?php echo Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Please insert your name here...')); ?>

				</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Lastname</label>
                <div class="col-sm-10">
				<?php echo Form::text('lastname', Input::old('lastname'), array('class' => 'form-control', 'placeholder' => 'Please insert your lastname here...')); ?>

				</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
				<?php echo Form::text('email', Input::old('email'), array('class' => 'form-control')); ?>

				</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
				<?php echo Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Please insert your username here...')); ?>

				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Role</label>
			 	<div class="col-lg-10">
				<?php echo Form::select('role_id',$roles,Input::old('role_id'),array('class' => 'form-control','id'=>'first')); ?>

				</div>
			</div>						
			<div class="col-sm-2 col-sm-offset-10">
				<?php echo Form::submit('Save', array('class' => 'btn btn-success')); ?>

				<?php echo link_to_route('users', 'Cancel', array(), array('class' => 'btn btn-danger')); ?>

				<?php echo Form::close(); ?>

			</div>
		</div>
	</div> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>