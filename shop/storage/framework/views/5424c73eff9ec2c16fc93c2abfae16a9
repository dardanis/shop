<?php $__env->startSection('content'); ?>
<div class="container">
      <form class="form-signin" role="form" method="POST" action="login">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="Username or email" name="email" value="<?php echo e(old('email')); ?>" autofocus>
            <input type="password" class="form-control" placeholder="Password" name="password">
            <label class="checkbox">
                <input type="checkbox"  name="remember"> Remember me
                <span class="pull-right">
                    <a  href="/password/email"> Forgot Password?</a>
                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
            <div class="registration">
                Don't have an account yet?
                <a class="" href="/signup">
                    Create an account
                </a>
            </div>
        </div>

      </form>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>