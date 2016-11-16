<?php $__env->startSection('content'); ?>
		<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-12">

					<div class="row">
						<div class="col-sm-7">
							<div class="beta-slider">							
								<div class="beta-slider-items">
								<?php foreach($images as $im): ?>
									<img src="/<?php echo e($im->image); ?>" alt="">
								<?php endforeach; ?>	
								</div>
								
								<div class="text-center">
									<div class="beta-pager-gallery port-gallery">
									<?php $x=0;?>
									<?php foreach($images as $im): ?>
									  <a data-slide-index="<?php echo e($x); ?>" href=""><img src="/<?php echo e($im->image); ?>" alt="" /></a>
									  <?php $x++;?>
									<?php endforeach; ?>	
									</div>
								</div>
							</div>
						
						</div>
						<div class="col-sm-5">
							<div class="single-item-body">
								<p class="single-item-title"><?php echo e($product->title); ?></p>
								<p class="single-item-price">
									<span>$ <?php echo e($product->price); ?></span>
								</p>
							</div>

							<div class="woocommerce-product-rating" >
								<div class="star-rating" title="Rated 4.00 out of 5"> 
									<span style="width:80%"> <strong itemprop="ratingValue" class="rating">4.00</strong> out of 5 </span>
								</div> 
								<span class="color-gray">(14)</span>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p><?php echo e(Str::limit($product->description,15)); ?> </p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<select class="wc-select" name="size">
									<option>Size</option>
									<option value="XS">XS</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								</select>
								<select class="wc-select" name="color">
									<option>Color</option>
									<option value="Red">Red</option>
									<option value="Green">Green</option>
									<option value="Yellow">Yellow</option>
									<option value="Black">Black</option>
									<option value="White">White</option>
								</select>
								<select class="wc-select" name="color">
									<option>Qty</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<?php echo Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id))); ?>

										<a ><button type="submit" class="add-to-cart pull-left" ><i class="fa fa-shopping-cart"></button></i></a>
										<?php echo Form::close(); ?>

								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<!-- <div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							
							<p><?php echo e($product->description); ?></p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>
					</div> -->
					<div class="space50">&nbsp;</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Related Products</h4>
					<div class="row">
						<?php foreach($related as $r): ?>
							<div class="col-sm-3">
								<div class="single-item">
									<div class="single-item-header">
										<a href="<?php echo e(URL::route('product_show',array($r->user->username,$r->slug))); ?>"><img src="<?php echo e(asset($r->thumbnail)); ?>" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title"><?php echo e($r->title); ?></p>
										<p class="single-item-price">
											<span>$<?php echo e($r->price); ?></span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="<?php echo e(URL::route('product_show',array($r->slug))); ?>">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					</div> <!-- .beta-products-list -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>