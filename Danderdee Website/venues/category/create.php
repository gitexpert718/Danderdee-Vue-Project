<?php
// session_start();
//
// $white_list = ['admin', 'light_admin', 'user'];
// if(!in_array($_SESSION['role'], $white_list)){
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
            Category
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Category</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create Category</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" id="name" class="form-control" placeholder="Name" ng-model="user.name">
                                <label for="name">Name</label>
                            </div>
<!--                        <div class="form-group">
                            <label >Post Code</label>
                            <input type="text" class="form-control" placeholder="Post Code" ng-model="user.postCode">
                        </div>
                        <div class="form-group">
                            <label >Region</label>
                            <input type="text" class="form-control" placeholder="Region" ng-model="user.region">
                        </div>
                        <div class="form-group">
                            <label >Admin District</label>
                            <input type="text" class="form-control" placeholder="Admin District" ng-model="user.admin_district">
                        </div>
                        <div class="form-group">
                            <label >Country</label>
                            <input type="text" class="form-control" placeholder="Country" ng-model="user.country">
                        </div>
                        <div class="form-group">
                            <label >Admin Country</label>
                            <input type="text" class="form-control" placeholder="Admin Country" ng-model="user.admin_county">
                        </div>
                        <div class="form-group">
                            <label >Notes</label>
                            <textarea class="form-control" placeholder="Notes" ng-model="user.notes"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Wiki Custom Info</label>
                            <textarea class="form-control" placeholder="Wiki Custom Info" ng-model="user.wikiCustomInfo"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Wiki Original Info</label>
                            <textarea class="form-control" placeholder="Wiki Original Info" ng-model="user.wikiOriginalInfo"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Is Approved</label>
                            <select class="form-control" ng-model="user.isApproved">
                                <option value="false">No</option>
                                <option value="true">Yes</option>
                            </select>

                        </div>-->

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
                    $scope.submit = 'Create Category';
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
                        method : "GET",
                        url : "https://netapi.danderdee.com/api/users/me",
                        withCredentials: true
                    }).then(function mySucces(response) {

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
                            url : "https://netapi.danderdee.com/api/categories",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Category Created Successfully';
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Category';
                        }, function myError(response) {
                            console.log(response);
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Category';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
