<?php
// session_start();
//
// $white_list = ['admin', 'light_admin', 'user', 'light_user'];
//
// if(!in_array($_SESSION['role'], $white_list)){
//       header('Location: ../../index.php');
//       die();
// }


?>
<?php include('../../includes/header.php'); ?>
<?php include('../../includes/sidebar.php'); ?>

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php include('../../includes/nav-header.php'); ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Device
            <small>Check Access</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Device</a></li>
            <li class="active">Access</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Check Access</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="check()">
                      <div class="box-body">

                        <div class="form-group">
                            <label >Device </label>
                            <select class="form-control" id="device-area" ng-model="user.hardwareId">

                            </select>
                        </div>
                        <div class="form-group">
                            <label >User </label>
                            <select class="form-control" id="user-area" ng-model="user.userId">

                            </select>
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
                    $scope.submit = 'Check Access';
                    $http({
                        method : "GET",
                        url : "https://netapi.danderdee.com/api/users/me",
                        withCredentials: true
                    }).then(function mySucces(response) {
                        if(response.status == 200)
                        {
                            var html = '';
                            $('#user-area').html('<option>--select--</option>');
                            $(response.data).each(function(i,val){
                                var $el = $("<option value='" + val._id + "'>" + val.firstName + ' ' + val.lastName + "</option>").appendTo('#user-area');
                              //  $('#table tbody').append(html);

                              var role = val.accountType[0];
                                $http({
                                    method : "POST",
                                    url : "../../insert.php",
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

                    $http({
                        method : "GET",
                        url : "https://netapi.danderdee.com/api/devices",
                        withCredentials: true
                    }).then(function mySucces(response) {
                        if(response.status == 200)
                        {
                            console.log(response);
                            var html = '';
                            $('#device-area').html('<option>--select--</option>');
                            $(response.data).each(function(i,val){

                                var $el = $("<option value='" + val._id + "'>" + val.address + "</option>").appendTo('#device-area');
                              //  $('#table tbody').append(html);

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

                    $scope.check = function() {
                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.submit = 'Checking Access';
                        $scope.error = 'Checking........';
                        $http({
                            method : "POST",
                            url : "https://netapi.danderdee.com/api/devices/access",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            alert(reponse.message);
                            $scope.error = '';
                            $scope.submit = 'Check Access';
                            $scope.isDisabled = false;
                        }, function myError(response) {
                            $scope.error = 'Something went wrong';
                            $scope.submit = 'Check Access';
                            $scope.isDisabled = false;
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../../includes/footer.php'); ?>
