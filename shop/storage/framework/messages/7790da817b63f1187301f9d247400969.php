<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Profile
            </header>
            <div class="panel-body">
				<?php echo Form::model($user, array('class'=>'form-horizontal tasi-form','method' => 'PATCH', 'route' => array('edit_profile'))); ?>

					<?php if($errors->any()): ?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<?php echo e(implode('', $errors->all('<li class="error">:message</li>'))); ?>

					</div>
					<?php endif; ?>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Name</label>
                    <div class="col-sm-9">
					<?php echo Form::text('name', Input::old('name'), array('class' => 'form-control')); ?>

					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Last name</label>
                    <div class="col-sm-9">
					<?php echo Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')); ?>

					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Email</label>
                    <div class="col-sm-9">
					<?php echo Form::text('email', Input::old('email'), array('class' => 'form-control')); ?>

					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Username</label>
                    <div class="col-sm-9">
					<?php echo Form::text('username', Input::old('username'), array('class' => 'form-control')); ?>

					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Old password</label>
                    <div class="col-sm-9">
						<input type="password"  class="form-control" name="old_password" >
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">New password</label>
                    <div class="col-sm-9">
						<input type="password"  class="form-control" name="password">
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Confirm password</label>
                    <div class="col-sm-9">
						<input type="password"  class="form-control" name="password_again" >
					</div>
				</div>				
				<div class="form-group">			
					<div class="col-sm-offset-10">
					<?php echo Form::submit('Save', array('class' => 'btn btn-success')); ?>

					<?php echo Form::close(); ?>

					</div>
				</div>
			</div>
        </section>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('new_client', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>