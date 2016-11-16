<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit product 
            </header>
			<div class="panel-body">
               		<?php echo Form::model($product, array('class'=>'form-horizontal tasi-form','method' => 'PATCH','files'=>true ,'route' => array('admin_product_put', $product->id))); ?>

					<?php if($errors->any()): ?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<?php echo e(implode('', $errors->all('<li class="error">:message</li>'))); ?>

					</div>
					<?php endif; ?>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Category</label>
				 	<div class="col-lg-10">
					<?php echo Form::select('category_id',$categories,Input::old('category_id'),array('class' => 'form-control','id'=>'first')); ?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Sub category</label>
				 	<div class="col-lg-10">
					<?php echo Form::select('subcategory_id',$subcategories, Input::old('subcategory_id'), array('class' => 'form-control','id' => 'second')); ?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Title</label>			
					<div class="col-sm-10">
					<?php echo Form::text('title', Input::old('title'),array('class' => 'form-control', 'placeholder' => 'Please insert your title here...')); ?>

					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Description</label>			
					<div class="col-sm-10">
					<?php echo Form::textarea('description', Input::old('description'),array('class' => 'form-control')); ?>

					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
					<?php echo Form::text('price', Input::old('price'), array('class' => 'form-control', 'placeholder' => 'Please insert price here...')); ?>

					</div>
				</div>
				<div class="form-group last">
                  <label class="control-label col-md-2">Thumbnail</label>
                  <div class="col-md-10">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 200px;">
                              <img src="<?php echo e(asset($product->thumbnail)); ?>" alt="" id="preview" src="#"/>
                        </div>
                        	<input id="imgfile" name="image" type="file" onchange="readURL(this)"; />
                  </div>
              </div>
				
				<div class="form-group">			
					<div class="col-sm-offset-10">
					<input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
					<?php echo Form::submit('Save', array('class' => 'btn btn-success')); ?>

					<?php echo link_to_route('admin_products', 'Cancel', array(), array('class' => 'btn btn-danger')); ?>

					<?php echo Form::close(); ?>

					</div>
				</div>
		</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>