<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users Statistics
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">This Week  <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;"><?php echo e($w_no); ?></button> </a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">This Month  <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;"><?php echo e($m_no); ?></button></a>
                    </li>
                    <li><a href="#messages" data-toggle="tab">All users  <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;"><?php echo e($a_no); ?></button></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <table class="table table-hover">
						<thead>
							<th>Name</th>
							<th>Lastname</th>
							<th>Username</th>
							<th>Email</th>
							<th>Role</th>
							<th>Created At</th>
						</thead>
						<tbody>
						<?php foreach($wusers as $wu): ?>
			        	<tr >
			              <td ><?php echo e($wu->name); ?></td>
			              <td ><?php echo e($wu->lastname); ?></td>
			              <td><?php echo e($wu->username); ?></td>
			              <td><?php echo e($wu->email); ?></td> 
			              <td ><span class="label label-success"><?php echo e($wu->role->name); ?></span></td>
			              <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($wu->created_at))->diffForHumans()); ?></span></td>

			              </tr>  
			             <?php endforeach; ?>
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="profile">
                    <table class="table table-hover">
						<thead>
							<th>Name</th>
							<th>Lastname</th>
							<th>Username</th>
							<th>Email</th>
							<th>Role</th>
							<th>Created At</th>
						</thead>
						<tbody>
						<?php foreach($musers as $m): ?>
			        	<tr >
			              <td ><?php echo e($m->name); ?></td>
			              <td ><?php echo e($m->lastname); ?></td>
			              <td><?php echo e($m->username); ?></td>
			              <td><?php echo e($m->email); ?></td> 
			              <td ><span class="label label-success"><?php echo e($m->role->name); ?></span></td>
			              <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($m->created_at))->diffForHumans()); ?></span></td>
			            </tr>
			            <?php endforeach; ?>
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="messages">
                    <table class="table table-hover">
						<thead>
							<th>Name</th>
							<th>Lastname</th>
							<th>Username</th>
							<th>Email</th>
							<th>Role</th>
							<th>Created At</th>
						</thead>
						<tbody>
						<?php foreach($ausers as $a): ?>
			        	<tr >
			             <td ><?php echo e($a->name); ?></td>
			              <td ><?php echo e($a->lastname); ?></td>
			              <td><?php echo e($a->username); ?></td>
			              <td><?php echo e($a->email); ?></td> 
			              <td ><span class="label label-success"><?php echo e($a->role->name); ?></span></td>
			              <td><span class="label label-info"><?php echo e(Carbon::createFromTimestamp(strtotime($a->created_at))->diffForHumans()); ?></span></td>
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