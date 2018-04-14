<?php include('../includes/header.php');
include('../includes/sidebar.php');

 ?>
 <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
   <?php include('../includes/nav-header.php'); ?>
   
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mohammed Shayas
            <small>Profile</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">

                  <h3 class="profile-username text-center">Mohammed Shayas</h3>
                  <p class="text-muted text-center">shayasmk@gmail.com</p>
                  <p class="text-muted text-center">+919946005652</p>
                  <p class="text-muted text-center">Kasaragod</p>

                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Mohammed Shayas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Username</strong>
                  <p class="text-muted">
                    shayasmk
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted">P T HOUSE, KATTAKAL, P O KALANAD, KASARAGOD, KASARAGOD</p>

                  <hr>

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Age</strong>
                  <p class="text-muted">25</p>

                  <hr>

                  <strong><i class="fa fa-circle margin-r-5"></i> Gender</strong>
                  <p>Male</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            </div>

        </section>

</div>

<?php include('../includes/footer.php'); ?>
