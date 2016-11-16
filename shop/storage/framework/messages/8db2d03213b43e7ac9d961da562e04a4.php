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
                Categories <?php echo link_to_route('addcategory', 'Add Category', array(), array('class' => 'btn btn-primary btn-xs')); ?>

            </header>
        <div class="panel-body">
			<div class="adv-table">
            <table  class="display table table-bordered table-striped" id="example">
				<thead>
					<th></th>
					<th>Id</th>
					<th>Category name</th>
					<th>Created At</th>
					<th>Add Subcategory</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>
				<?php foreach($categories as $category): ?>
	        	<tr class="clickable" data-toggle="collapse" id="row1" data-target=".row<?php echo $category->id;?>">
	        	  <td><i class="glyphicon glyphicon-plus"></i></td>
	              <td><?php echo e($category->id); ?></td>
	              <td ><?php echo e($category->name); ?></td>
	              <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($category->created_at))->diffForHumans()); ?></span></td>
	              <td>
	              	<?php echo link_to_route('subcat', 'Add Subcategory', array($category->slug), array('class' => 'btn btn-success btn-xs')); ?>

	              </td>
	              <td><?php echo link_to_route('edit_category', 'Edit', array($category->slug), array('class' => 'btn btn-warning btn-xs')); ?></td>
	              <td>
	              	<?php echo Form::open(array('method' => 'DELETE', 'route' => array('deleteCategory', $category->id))); ?>

					<?php echo Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')); ?>

					<?php echo Form::close(); ?>

	              </td>
	          	</tr>
	          	<?php if($category->subcategories): ?>
		          	<?php foreach($category->subcategories as $s): ?>
		          	<tr class="collapse row<?php echo $category->id;?>">
			            <td></td>
			            <td></td>
			          	<td><?php echo e($s->name); ?></td>  
			            <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($s->created_at))->diffForHumans()); ?></span></td>
			            <td></td>  
			            <td><?php echo link_to_route('edit_sub', 'Edit', array($s->slug), array('class' => 'btn btn-warning btn-xs')); ?></td>
			            <td>
			            	<?php echo Form::open(array('method' => 'DELETE', 'route' => array('deleteSubcategory', $s->id))); ?>

							<?php echo Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')); ?>

							<?php echo Form::close(); ?>

			            </td>  
		        	</tr>
		        	<?php endforeach; ?>
	        	<?php endif; ?>
	          	<?php endforeach; ?>
	          	</tbody>
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
<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>