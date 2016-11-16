<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add product
            </header>
            <div class="panel-body">
				<?php echo Form::open(array('route' => 'business_add_product','files'=>true,'class'=>'form-horizontal tasi-form')); ?>

					<?php if($errors->any()): ?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<?php echo implode('', $errors->all('<li class="error">:message</li>')); ?>

					</div>
					<?php endif; ?>

				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Category</label>
				 	<div class="col-lg-10">
					<?php echo Form::select('category_id',[null=>'Please Select one category']+$categories,'' ,array('class' => 'form-control','id'=>'first')); ?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Sub category</label>
				 	<div class="col-lg-10">
					<?php echo Form::select('subcategory_id', array(), null, array('class' => 'form-control','id' => 'second')); ?>

					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
					<?php echo Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'Please insert your title here...')); ?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Description</label>			
					<div class="col-sm-10">
					<?php echo Form::textarea('description', '', array('class' => 'form-control')); ?>

					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
					<?php echo Form::text('price', '', array('class' => 'form-control', 'placeholder' => 'Please insert price here...')); ?>

					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Choose thumbnail</label>		
					<div class="col-sm-10">										
   						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="preview" src="#"/>
                        </div>
                        	<input id="imgfile" name="image" type="file" onchange="readURL(this)"; /> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Choose images</label>		
					<div class="col-sm-10">										
   						<?php echo Form::file('pics[]', array('multiple'=>'true')); ?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Mapping product</label>
					<input id="pac-input" class="controls" type="text" placeholder="Search Box">
					<div class="col-sm-5" id="map" style="height:300px;">
						MAP
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<div id="markerStatus"><i>Click and drag the marker.</i></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Latitude</label>
		                    <div class="col-sm-10">
							<?php echo Form::text('lat', '', array('class' => 'form-control','id'=>'lat')); ?>

							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Longtitude</label>
		                    <div class="col-sm-10">
							<?php echo Form::text('lng', '', array('class' => 'form-control','id'=>'lng')); ?>

							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Address</label>
		                    <div class="col-sm-10">
							<?php echo Form::text('address', '', array('class' => 'form-control','id'=>'address')); ?>

							</div>
						</div>
					</div>
				</div>
				<div class="form-group">			
					<div class="col-sm-offset-10">
					<input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
					<?php echo Form::submit('Add Product', array('class' => 'btn btn-success')); ?>

					<?php echo link_to_route('business_products', 'Cancel', array(), array('class' => 'btn btn-danger')); ?>

					<?php echo Form::close(); ?>

					</div>
				</div>
			</div>
        </section>
    </div>
</div>   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/js/map2.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('new_business', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>