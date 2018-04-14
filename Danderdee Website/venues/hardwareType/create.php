<?php
// session_start();
//
// $white_list = 'admin';
// if($_SESSION['role'] != $white_list){
//       header('Location: ../index.php');
//       die();
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
            Hardware Types
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Hardware Types</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create Hardware Types</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" id="name" class="form-control" placeholder="Name" ng-model="user.name">
                                <label for="name">Name</label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="space" placeholder="Space" ng-model="user.space"></textarea>
                                <label for="space">Space</label>
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
                    $scope.submit = 'Create Hardware Types';
//                    $http({
//                   method : "GET",
//                   url : "https://netapi.danderdee.com/api/locations"
//               }).then(function mySucces(response) {
//                   console.log(response);
//                   var html = '';
//                   $.each(response.data, function(i,val){
//                       html = '';
//                       html+= '<option val=>' + val.lng + '</option>';
//                       html+= '<option>' + val.lat + '</option>';
//                       $('#location').append(html);
//                   });
//               }, function myError(response) {
//                   $scope.error = 'Error fetching location data';
//               });

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
                            url : "https://netapi.danderdee.com/api/hardwaretype",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Hardware Type Created Successfully';
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Hardware Types';
                        }, function myError(response) {
                            console.log(response);
                            $scope.error = response.data.errors.name.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Hardware Type';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
