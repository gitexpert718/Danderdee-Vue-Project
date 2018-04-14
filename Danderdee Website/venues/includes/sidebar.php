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
          <li class="header">MAIN NAVIGATION</li>

          <li class=" treeview">
              <a href="<?php echo SERVER ?>/index.php">
                  <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>

          </li>

      <li class=" treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span> Notifications </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li class="active"><a href="<?php echo SERVER ?>/admin/geonames.php"><i class="fa fa-circle-o"></i> Geonames</a></li>

              </ul>
          </li>




          <li class=" treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li class="active"><a href="<?php echo SERVER ?>/user/create.php"><i class="fa fa-circle-o"></i> Create User</a></li>
                  <li><a href="<?php echo SERVER ?>/user/list.php"><i class="fa fa-circle-o"></i> List User</a></li>
              </ul>
          </li>
          <li class=" treeview" id='nav_area'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Areas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo SERVER ?>/area/create.php"><i class="fa fa-circle-o"></i> Create Area</a></li>
                  <li><a href="<?php echo SERVER ?>/area/list.php"><i class="fa fa-circle-o"></i> List Areas</a></li>
                  <li><a href="<?php echo SERVER ?>/area/approved_list.php"><i class="fa fa-circle-o"></i> Approved Areas</a></li>

              </ul>
          </li>
          <li class=" treeview" id='nav_categories'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo SERVER ?>/category/create.php"><i class="fa fa-circle-o"></i> Create Category</a></li>
                  <li><a href="<?php echo SERVER ?>/category/list.php"><i class="fa fa-circle-o"></i> List Categories</a></li>

              </ul>
          </li>
          <li class=" treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Sub Categories</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo SERVER ?>/subcategory/create.php"><i class="fa fa-circle-o"></i> Create Sub Category</a></li>
                  <li><a href="<?php echo SERVER ?>/subcategory/list.php"><i class="fa fa-circle-o"></i> List Sub Categories</a></li>

              </ul>
          </li>
          <li class=" treeview" id='nav_business'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Business Directory</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/business/create.php"><i class="fa fa-circle-o"></i> Create Business Directory</a></li>
                  <li ><a href="<?php echo SERVER ?>/business/list.php"><i class="fa fa-circle-o"></i> List Business Directory</a></li>
              </ul>
          </li>
          <li class=" treeview" id='nav_classified'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Classified</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/classified/create.php"><i class="fa fa-circle-o"></i> Create Classified</a></li>
                  <li ><a href="<?php echo SERVER ?>/classified/list.php"><i class="fa fa-circle-o"></i> List Classified</a></li>
              </ul>
          </li>
          <li class=" treeview" id='nav_device'>
              <a href="#" >
                  <i class="fa fa-dashboard"></i> <span>Device</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/device/create.php"><i class="fa fa-circle-o"></i> Create Device</a></li>
                  <li><a href="<?php echo SERVER ?>/device/list.php"><i class="fa fa-circle-o"></i> List Devices</a></li>
                  <li><a href="<?php echo SERVER ?>/device/check/access.php"><i class="fa fa-circle-o"></i> Check Access</a></li>
              </ul>
          </li>
          <li class=" treeview" id='nav_hardware'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Hardware Type</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo SERVER ?>/hardwareType/create.php"><i class="fa fa-circle-o"></i> Create Hardware Type</a></li>
                  <li><a href="<?php echo SERVER ?>/hardwareType/list.php"><i class="fa fa-circle-o"></i> List Hardware Type</a></li>
              </ul>
          </li>
<!--                <li class=" treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Order</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/order/create.php"><i class="fa fa-circle-o"></i> Create Order</a></li>
                  <li ><a href="<?php echo SERVER ?>/order/list.php"><i class="fa fa-circle-o"></i> List Order</a></li>
              </ul>
          </li>-->
          <li class=" treeview" id='nav_space'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Space</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/space/create.php"><i class="fa fa-circle-o"></i> Create Space</a></li>
                  <li ><a href="<?php echo SERVER ?>/space/list.php"><i class="fa fa-circle-o"></i> List Space</a></li>
              </ul>
          </li>
          <li class=" treeview" id='nav_space_templates'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Space Templates</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/spaceTemplates/create.php"><i class="fa fa-circle-o"></i> Create Space</a></li>
                  <li ><a href="<?php echo SERVER ?>/spaceTemplates/list.php"><i class="fa fa-circle-o"></i> List Space</a></li>
              </ul>
          </li>
          <li class=" treeview" id='nav_templates'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Templates</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/template/create.php"><i class="fa fa-circle-o"></i> Create Template</a></li>
                  <li ><a href="<?php echo SERVER ?>/template/list.php"><i class="fa fa-circle-o"></i> List Template</a></li>
              </ul>
          </li>
          <li class=" treeview" id='nav_location'>
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Locations</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li ><a href="<?php echo SERVER ?>/location/create.php"><i class="fa fa-circle-o"></i> Create Location</a></li>
                  <li><a href="<?php echo SERVER ?>/location/list.php"><i class="fa fa-circle-o"></i> List Location</a></li>
                  <li><a href="<?php echo SERVER ?>/location/user/add.php"><i class="fa fa-circle-o"></i> Add User</a></li>
                  <li><a href="<?php echo SERVER ?>/location/user/access.php"><i class="fa fa-circle-o"></i> Check User Location</a></li>
              </ul>
          </li>

          <li >
              <a href="<?php echo SERVER ?>/password/change.php" ><i class="fa fa-dashboard"></i> <span>Change Password</span> </a>

          </li>
          <li ng-app="signOutApp" ng-controller="signOutCtrl">
              <a data-href="/api/signout" id="signout" ng-click="signOut()" style="cursor: pointer"><i class="fa fa-dashboard"></i> <span>Sign Out</span> </a>

          </li>
      </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<!-- =============================================== -->
