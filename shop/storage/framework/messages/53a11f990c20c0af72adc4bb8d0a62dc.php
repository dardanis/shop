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
                Users  <?php echo link_to_route('create_users', 'Add User', array(), array('class' => 'btn btn-primary btn-xs')); ?>

            </header>
            <div class="panel-body">
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="example">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users as $u): ?>
                       <tr >
                          <td><?php echo e($u->id); ?></td>
                          <td ><?php echo e($u->name); ?></td>
                          <td ><?php echo e($u->email); ?></td>
                          <td ><span class="label label-success"><?php echo e($u->role->name); ?></span></td>
                          <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($u->created_at))->diffForHumans()); ?></span></td>
                          <td ><?php echo link_to_route('edit_users', 'Edit', array($u->name), array('class' => 'btn btn-warning btn-xs')); ?></td>
                          <td >
                            <?php echo Form::open(array('method' => 'DELETE', 'route' => array('admin.users.delete', $u->id))); ?>

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
<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>