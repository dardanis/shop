<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Shop</title>
    <link href="<?php echo e(asset('/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/bootstrap-reset.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('/css/style2.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/style-responsive.css')); ?>" rel="stylesheet" />
    <?php echo $__env->yieldContent('style'); ?>
  </head>
  <body>
  <section id="container" >
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Collapse"></div>
              </div>
            <a href="<?php echo e(url('/')); ?>" class="logo">Shop</a>
            <div class="top-nav ">
                <ul class="nav pull-right top-menu">
                    <li>
                      <form action="<?php echo e(URL::route('language-chooser')); ?>" method="post"> 
                        <select id="locale" name="locale" class="form-control input-sm m-bot15">
                          <option value="en">English</option>
                          <option value="de" <?php echo e(Lang::locale()==='de'? ' selected':''); ?>>German</option>
                          <option value="fr" <?php echo e(Lang::locale()==='fr'? ' selected':''); ?>>French</option>
                        </select>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                      </form>
                    </li>  
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
<!--                             <img alt="" src="img/avatar1_small.jpg"> -->
                            <span class="username"><?php echo e(Auth::user()->name); ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="<?php echo e(url('profile')); ?>"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="<?php echo e(url('logout')); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
      <!--sidebar start-->
      <aside>

          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="<?php echo e(Active::route('myaccount', 'active')); ?>" href="<?php echo e(url('client/dashboard')); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  

                  <li class="sub-menu">
                      <a class="<?php echo e(Active::route(array('client_products', 'products_add'), 'active')); ?>" href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>My Products</span>
                      </a>
                      <ul class="sub">
                          <li class="<?php echo e(Active::route('client_products', 'active')); ?>"><a  href="<?php echo e(url('client/c_products')); ?>">All products</a></li>
                          <li class="<?php echo e(Active::route('products_add', 'active')); ?>"><a  href="<?php echo e(url('client/add/product')); ?>">Add product</a></li>
                      </ul>
                  </li>
                  <li>
                      <a class="<?php echo e(Active::route('account_type', 'active')); ?>" href="<?php echo e(url('client/account')); ?>">
                          <i class="fa fa-user"></i>
                          <span>Account type</span>
                      </a>
                  </li>

              </ul>
          </div>
      </aside>
      <section id="main-content">
          <section class="wrapper">
              <?php echo $__env->yieldContent('content'); ?>
          </section>
      </section>
      <!--main content end-->
  </section>
    <script src="<?php echo e(asset('/js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
    <script class="include" src="<?php echo e(asset('/js/jquery.dcjqaccordion.2.7.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/jquery.scrollTo.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/jquery.nicescroll.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/jquery.customSelect.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('/js/respond.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('/js/common-scripts.js')); ?>"></script>

    
        <script src="<?php echo e(asset('/js/map.js')); ?>"></script>
  <script>
      $(function(){
          $('select.styled').customSelect();
      });
  </script>
  <script src="<?php echo e(asset('/js/photopreview.js')); ?>"></script>
  <script>
    $(function() {
        $('#locale').change(function() {
            this.form.submit();
        });
    });
  </script>
    <script type="text/javascript">
        $(document).on('change', '#first', function () {
        var first = $(this).find(':selected').val();
        var token=$('#token').val();
           $.ajax({
                url: "/ajax",
                type:"POST",
                data: {'_token':token,'first': first },
                success:function(data){
                    var html = '';
                   $.each(data, function (id, name) {
                       html += '<option value="'+id+'">' + name + '</option>';
                   });
                    $('#second').html(html);
                },error:function(){ 
                    alert("error!!!!");
                }
            });
        });
    </script>

    
  <?php echo $__env->yieldContent('scripts'); ?>
  </body>
</html>
