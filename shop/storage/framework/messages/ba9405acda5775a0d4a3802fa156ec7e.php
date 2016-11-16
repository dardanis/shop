<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('/css/demo_page.css')); ?>" />
    <link href="<?php echo e(asset('/css/demo_table.css')); ?>" />
    <link href="<?php echo e(asset('/css/DT_bootstrap.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Products
            </header>
            <div class="panel-body">
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="example">
                        <thead>
                        <tr>
                            <th>Product title</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>User</th>
                            <th>Created</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($products as $product): ?>
                       <tr >
                          <td ><?php echo e($product->title); ?></td>
                          <td ><?php echo e($product->price); ?></td>
                          <td ><label class="label label-default"><?php echo e($product->category->name); ?></label></td>
                          <td ><label class="label label-default"><?php echo e($product->user->name); ?></label></td>
                          <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($product->created_at))->diffForHumans()); ?></span></td>
                          <td><?php echo link_to_route('product_edit', 'Edit', array($product->slug), array('class' => 'btn btn-warning btn-xs')); ?></td>
                          <td>
                            <?php echo Form::open(array('method' => 'DELETE', 'route' => array('client_product_delete', $product->id))); ?>

                            <?php echo Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')); ?>

                            <?php echo Form::close(); ?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                        </tfoot>
                      </table>
                  </div>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('/js/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('/js/DT_bootstrap.js')); ?>"></script>
  <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
      </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('new_client', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>