<?php

// session_start();
//
// $white_list = 'admin';
// if($_SESSION['role'] != $white_list){
//     header('Location: ../index.php');
//     die();
// }
include('../includes/header.php');
include('../includes/sidebar.php');

?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php include('../includes/nav-header.php'); ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Template
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Template</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Template</h3>
                            <p class="error">{{error}}</p>
                        </div><!-- /.box-header -->
                      <!-- form start -->
                        <form role='form' name="myForm" ng-submit="create()">
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" id="hardwareType" class="form-control" placeholder="Hardware Type" ng-model="user.hardwareType">
                                    <label for="hardwareType">Hardware Type</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="fileFolderUrl" class="form-control" placeholder="File Folder URL" ng-model="user.fileFolderUrl" />
                                    <label for="fileFolderUrl">File Folder Url</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="version" class="form-control" placeholder="Advert Type" ng-model="user.version" />
                                    <label for="version">Version</label>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary submit-button" ng-disabled="isDisabled">{{submit}}</button>
                              <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </form>
                    </div><!-- /.box -->



                </div><!--/.col (left) -->
            </div>

        </section>

</div>
<script>

            var app = angular.module('myApp', []);
                app.controller('myCtrl', function($scope, $http) {
                    $scope.isDisabled = false;
                    $scope.submit = 'Create Template';

                    $http({
                        withCredentials: true,
                        method : "GET",
                        url : "https://netapi.danderdee.com/api/users/me"

            }).then(function mySucces(response) {
                   console.log(response);
                   if(response.status == 200)
                   {

                        $(response.data).each(function(i,val){

                            var role = val.accountType[0];
                            $http({
                                method : "POST",
                                url : "../insert.php",
                                data: {"role" : role}
                            }).then(function mySuccess(response){
                                  console.log(response.data);
                            });

                            if(role !="admin" && role !="light_admin" && role !="user" && role !="light_user"){
                                    $('#nav_area').css('display', 'none');
                                    $('#nav_categories').css('display', 'none');
                                    $('#nav_business').css('display', 'none');
                                    $('#nav_device').css('display', 'none');
                                    $('#nav_location').css('display', 'none');
                                }

                                if(role !="admin" && role !="light_admin" && role !="wifi_user"){

                                    $('#nav_classified').css('display', 'none');
                                }

                                if(role !="admin"){

                                    $('#nav_hardware').css('display', 'none');
                                    $('#nav_space').css('display', 'none');
                                    $('#nav_space_templates').css('display', 'none');
                                    $('#nav_templates').css('display', 'none');
                                }

                                $('#username').text(val.username);

                        });
                    }
               }, function myError(response) {
                   if(response.status == 403)
                    {
                        alert("Please login to continue");
                        window.location.href = '/cp/login.html';
                    }
                   $scope.error = 'Error fetching data';
               });



                    $scope.create = function() {
                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.submit = 'Submitting data';
                        $scope.error = 'Submitting data........';
                        $http({
                            method : "POST",
                            url : "https://netapi.danderdee.com/api/templates",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Template Added Successfully';
                            $scope.submit = 'Create Template';
                            $scope.isDisabled = false;
                        }, function myError(response) {
                            $scope.error = response.data.message;
                            $scope.submit = 'Create Template';
                            $scope.isDisabled = false;
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
