<?php
session_start();

// $white_list = ['admin', 'light_admin', 'user'];
//
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
            Business
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Business Directory</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create Business Directory</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                      <div class="box-body">

                        <div class="form-group">
                            <input type="text" id="title" class="form-control" placeholder="Title" ng-model="user.title">
                            <label for="title" >Title</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="e-mail" class="form-control" placeholder="E-mail" ng-model="user.email">
                            <label for="e-mail" >E-mail</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="infoText" class="form-control" placeholder="Info Text" ng-model="user.infoText">
                            <label for="infoText" >Info Text</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="subCategoryId" class="form-control" placeholder="Sub Category ID" ng-model="user.subCategoryId">
                            <label for="subCategoryId" >Sub Category ID</label>
                        </div>
                           <div class="form-group">
                            <input type="text" id="areaId" class="form-control" placeholder="Area ID" ng-model="user.areaId">
                            <label for="areaId" >Area</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="Url" class="form-control" placeholder="Url" ng-model="user.url">
                            <label for="Url" >Url</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="address" placeholder="Address" ng-model="user.address"></textarea>
                            <label for="address" >Address</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="phoneNumbers" class="form-control" placeholder="Phone Numbers" ng-model="user.phoneNumbers" />
                            <label for="phoneNumbers">Phone Numbers</label>
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
                    $scope.submit = 'Create Business';
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
                            url : "https://netapi.danderdee.com/api/business",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Business Created Successfully';
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Business';
                        }, function myError(response) {
                            console.log(response);
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Business';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
