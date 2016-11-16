<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Products Statistics
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">This Week  <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;"><?php echo e($p_no); ?></button> </a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">This Month  <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;"><?php echo e($monthlyproducts); ?></button></a>
                    </li>
                    <li><a href="#messages" data-toggle="tab">All products  <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;"><?php echo e($all); ?></button></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <table class="table table-hover">
						<thead>
							<th>Title</th>
							<th>Category</th>
							<th>Price</th>
							<th>User</th>
							<th>Created At</th>
						</thead>
						<tbody>
						<?php foreach($w_products as $wp): ?>
			        	<tr >
			              <td ><?php echo e($wp->title); ?></td>
			              <td ><span class="label label-default
			              "><?php echo e($wp->category->name); ?></span></td>
			              <td><?php echo e($wp->price); ?></td>
			              <td ><span class="label label-success"><?php echo e($wp->user->name); ?></span></td>
			              <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($wp->created_at))->diffForHumans()); ?></span></td>

			              </tr>  
			             <?php endforeach; ?>
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="profile">
                    <table class="table table-hover">
						<thead>
							<th>Title</th>
							<th>Category</th>
							<th>Price</th>
							<th>User</th>
							<th>Created At</th>
						</thead>
						<tbody>
						<?php foreach($m_products as $mp): ?>
			        	<tr >
			              <td ><?php echo e($mp->title); ?></td>
			              <td ><span class="label label-default"><?php echo e($mp->category->name); ?></span></td>
			              <td><?php echo e($mp->price); ?></td>
			              <td ><span class="label label-success"><?php echo e($mp->user->name); ?></span></td>
			              <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($mp->created_at))->diffForHumans()); ?></span></td>

			              </tr>  
			             <?php endforeach; ?>
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="messages">
                    <table class="table table-hover">
						<thead>
							<th>Title</th>
							<th>Category</th>
							<th>Price</th>
							<th>User</th>
							<th>Created At</th>
						</thead>
						<tbody>
						<?php foreach($allproducts as $ap): ?>
			        	<tr >
			              <td ><?php echo e($ap->title); ?></td>
			              <td ><span class="label label-default"><?php echo e($ap->category->name); ?></span></td>
			              <td><?php echo e($ap->price); ?></td>
			              <td ><span class="label label-success"><?php echo e($ap->user->name); ?></span></td>
			              <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($ap->created_at))->diffForHumans()); ?></span></td>

			              </tr>  
			             <?php endforeach; ?>
			          	</tbody>
			          </table>   
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    </div>                   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>