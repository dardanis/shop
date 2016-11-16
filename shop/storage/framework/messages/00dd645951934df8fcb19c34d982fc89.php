<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit Category 
            </header>
          <div class="panel-body">
               		<?php echo Form::model($category, array('class'=>'form-horizontal tasi-form','method' => 'PATCH', 'route' => array('category_update', $category->id))); ?>

					<?php if($errors->any()): ?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<?php echo e(implode('', $errors->all('<li class="error">:message</li>'))); ?>

					</div>
					<?php endif; ?>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
					<?php echo Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Please insert your postt title here...')); ?>

					</div>
				</div>				
				<div class="form-group">			
					<div class="col-sm-offset-10">
					<?php echo Form::submit('Save', array('class' => 'btn btn-success')); ?>

					<?php echo link_to_route('categoriesindex', 'Cancel', array(), array('class' => 'btn btn-danger')); ?>

					<?php echo Form::close(); ?>

					</div>
				</div>
		</div>
	</section>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>