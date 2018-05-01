<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo SERVER ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

                  <li class="header">Navigate</li>
                  <li class="treeview">
                      <a href="<?php echo SERVER ?>/mainpage.php">
                          <i class="fa fa-circle"></i> <span>Dashboard</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
                      </a>
                  </li>
                  <li class="treeview">
                      <a href="<?php echo SERVER ?>/adverts.php">
                          <i class="fa fa-list"></i> <span>Adverts</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
                      </a>
                  </li>
                  <li class="treeview">
                      <a href="<?php echo SERVER ?>/create_ad.php">
                          <i class="fa fa-cloud"></i> <span>Create Ad</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
                      </a>
                  </li>
                  <li class="treeview" id='manage-user' style="<?php echo $display; ?>">
                      <a href="<?php echo SERVER ?>/user_management.php">
                          <i class="fa fa-group"></i> <span>Manage Users</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
                      </a>
                  </li>
                  <li class="treeview" id='create-user' style="<?php echo $display; ?>">
                      <a href="<?php echo SERVER ?>/new_user.php">
                          <i class="fa fa-book"></i> <span>Create User</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
                      </a>
                  </li>
             </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<!-- =============================================== -->
