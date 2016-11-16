<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Map
            </header>
            <div class="panel-body">
            	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
				<div id="map" style="width:70%;height:600px;float:left"></div>
			</div>
        </section>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
	   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('new_client', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>