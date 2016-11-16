<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Dashboard
            </header>
            <div class="panel-body">
            <?php echo link_to_route('business_products', 'Products', array(), array('class' => 'btn btn-primary')); ?>

        </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('new_business', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>