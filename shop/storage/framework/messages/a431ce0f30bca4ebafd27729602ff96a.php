<?php $__env->startSection('content'); ?>
	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-12 main-content pull-right">
					
					<div class="beta-products-list">
						<div class="row">
							 <?php foreach($user->products as $product): ?>
							<div class="col-sm-4 ">
								<div class="single-item">
									<div class="single-item-header">
										<a href="<?php echo e(URL::route('product_show',array($product->user->username,$product->slug))); ?>"><img src="<?php echo e(asset($product->thumbnail)); ?>" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title"><?php echo e($product->title); ?></p>
										<p class="single-item-price">
											<span>$<?php echo e($product->price); ?></span>
										</p>
									</div>
									<div class="single-item-caption">
										<?php echo Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id))); ?>

										<a ><button type="submit" class="add-to-cart pull-left" ><i class="fa fa-shopping-cart"></button></i></a>
										<?php echo Form::close(); ?>

										<a class="beta-btn primary" href="<?php echo e(URL::route('product_show',array($product->user->username,$product->slug))); ?>">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>
				</div> <!-- .main-content -->
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>