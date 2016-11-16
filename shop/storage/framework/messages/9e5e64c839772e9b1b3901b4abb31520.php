<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add user 
            </header>
            <div class="panel-body">
          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                <?php foreach($errors->all() as $error): ?>
                  <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
         <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/admin/users')); ?>">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">Name</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>">
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">Lastname</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="lastname" value="<?php echo e(old('lastname')); ?>">
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">Username</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>">
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">E-Mail Address</label>
              	<div class="col-sm-6">
                  	<input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">Password</label>
              	<div class="col-sm-6">
                  	<input type="password" class="form-control" name="password">
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
              	<div class="col-sm-6">
                  	<input type="password" class="form-control" name="password_confirmation">
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label"> Role</label>
              	<div class="col-sm-6">
                  	<?php echo Form::select('role',[null=>'Please Select one role']+$roles,'' ,array('class' => 'form-control')); ?>

              	</div>
          	</div>
          	<div class="col-sm-1 col-sm-offset-7" style="padding:0px;">
                <button type="submit" class="btn btn-primary">
                  Add User
                </button>
            </div>
          </form>
              
        </div>
      </section>
    </div>
  </div>                     

<?php $__env->stopSection(); ?>
<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>