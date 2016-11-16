<?php $__env->startSection('content'); ?>
<div class="row state-overview">
    <a href="<?php echo e(url('admin/stats/users')); ?>">
        <div class="col-lg-3 col-sm-6">
          <section class="panel">
              <div class="symbol terques">
                  <i class="fa fa-users"></i>
              </div>
              <div class="value">
                  <h1 class="count">
                      <?php echo e($weekly); ?>

                  </h1>
                  <p>New Users</p>
              </div>
          </section>
        </div>
    </a>
    <a href="<?php echo e(url('admin/stats/products')); ?>">
        <div class="col-lg-3 col-sm-6">
          <section class="panel">
              <div class="symbol red">
                  <i class="fa fa-tags"></i>
              </div>
              <div class="value">
                  <h1 class=" count2">
                      <?php echo e($productsweekly); ?>

                  </h1>
                  <p>Products</p>
              </div>
          </section>
        </div>
    </a>
    <a href="#">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
              <div class="symbol yellow">
                  <i class="fa fa-shopping-cart"></i>
              </div>
              <div class="value">
                  <h1 class=" count3">
                      0
                  </h1>
                  <p>New Order</p>
              </div>
            </section>
        </div>
    </a>
    <div class="col-lg-3">
      <section class="panel">
          <div class="panel-body">
              <div class="task-thumb-details">
                  <h1>Online Users</h1>
              </div>
          </div>
          <table class="table table-hover personal-task">
              <tbody>
              <?php if(!$users->isEmpty()): ?>
                        <?php foreach($users as $u): ?>
                        <tr>
                            <td><?php echo e($u->name); ?></td>
                            <td>
                                <i class="fa fa-circle  pull-right" style="font-size:9px;color:green;margin-top: 5px;"></i>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                <?php else: ?>
                 <td>no users online</td>
                <td></td>
                <?php endif; ?>
              </tbody>
          </table>
      </section>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>