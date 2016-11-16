<?php $__env->startSection('content'); ?>
<div class="container">
		<div id="content">
			<div class=" col-sm-9 main-content pull-right">
				<div class="beta-products-list">
					<?php foreach($subcategory as $subb): ?>
					<h4 class="wow fadeInLeft"><?php echo e($subb->name); ?></h4>
					<?php endforeach; ?>
					<div class="beta-products-details">
						<p class="pull-right">
							<span class="sort-by">Sort by </span>
							<select name="sortproducts" class="beta-select-primary">
								<option value="desc">Latest</option>
								<option value="popular">Popular</option>
								<option value="rating">Rating</option>
								<option value="best">Best</option>
							</select>
						</p>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						
							
						
					</div>
					<div class="row">
						<?php foreach($products as $product): ?>
						<div class="col-sm-4">
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

									<a class="beta-btn primary" href="<?php echo e(URL::route('product_show',array($product->slug))); ?>">Details <i class="fa fa-chevron-right"></i></a>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>	
												
					</div>
				</div> <!-- .beta-products-list -->
				<div class="space50">&nbsp;</div>
			</div> <!-- .main-content -->

			<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Categories</h3>
						<div class="widget-body">
							<ul class="list-unstyled">
								<?php foreach($categories as $category): ?>
								<li class="parent">
									<a href="#"><?php echo e($category->name); ?></a>
									
									<ul class="submenu list-unstyled">
									<li><a href="<?php echo e(URL::route('category_show',array($category->slug))); ?>"><?php echo e($category->name); ?></a></li>
									<?php foreach($category->subcategories as $sub): ?>
										<li><a href="<?php echo e(URL::route('subcategory_show',array($sub->slug))); ?>"><?php echo e($sub->name); ?></a></li>
									<?php endforeach; ?>
									</ul>
								</li>
								<?php endforeach; ?>

							</ul>
						</div>
					</div> <!-- brands widget -->

				</div> <!-- .aside -->

		</div> <!-- #content -->
	</div> <!-- .container -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<script type="text/javascript">
		$(document).ready(function() {

    $('.parent').click(function() {
         $('.submenu').toggle('visible');
     });

  });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>