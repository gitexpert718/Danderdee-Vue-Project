<?php
// session_start();
// $white_list = ['admin', 'light_admin', 'wifi_user'];
// if(!in_array($_SESSION['role'], $white_list)){
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
            Classified Ads
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Classified Ads</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create Classified Ads</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                      <div class="box-body">

                        <div class="form-group">
                            <input type="text" id="title" class="form-control" placeholder="Title" ng-model="user.title">
                            <label for="title">Title</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="E-mail" class="form-control" placeholder="Em-ail" ng-model="user.email">
                            <label for="E-mail">E-mail</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="Description" placeholder="Description" ng-model="user.description"></textarea>
                            <label for="Description">Description</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="subCategoryId" class="form-control" ng-model="user.subCategoryId" placeholder="Sub Category ID" >
                            <label for="subCategoryId">Sub Category ID</label>

                        </div>
                        <div class="form-group">
                            <input type="text" id="areaId" class="form-control" placeholder="Area ID" ng-model="user.areaId">
                            <label for="areaId">Area ID</label>

                        </div>
                        <div class="form-group">
                            <input type="text" id="Price" class="form-control" placeholder="Price" ng-model="user.price">
                            <label for="Price">Price</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="Address" placeholder="Address" ng-model="user.address"></textarea>
                            <label for="Address">Address</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="Video" class="form-control" placeholder="Video URL" ng-model="user.videoURL" />
                            <label for="Video">Video URL</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="phoneNumbers" placeholder="Phone Numbers" ng-model="user.phoneNumbers"></textarea>
                            <label for="phoneNumbers">Phone Numbers</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="Photos" placeholder="Photos" ng-model="user.photos"></textarea>
                            <label for="Photos">Photos</label>
                        </div>

                          <div class="form-group">
                             <label >Type</label>
                            <select class="form-control" ng-model="user.type">
                                <option value="forSale">For Sale</option>
                                <option value="wanted">Wanted</option>
                            </select>

                        </div>
                        <div class="form-group">
                           <label >Seller Type</label>
                            <select class="form-control" ng-model="user.sellerType">
                                <option value="trader">Trader</option>
                                <option value="private">Private</option>
                            </select>

                        </div>

                        <div class="form-group">
                           <label >Condition</label>
                            <select class="form-control" ng-model="user.condition">
                                <option value="notUsed">Not Used</option>
                                <option value="working">Working</option>
                                <option value="NA">NA</option>
                            </select>
                        </div>

                          <div class="form-group">
                             <label>Is Active?</label>
                            <select class="form-control" ng-model="user.isActive">
                                <option value="false">No</option>
                                <option value="true">Yes</option>
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
                    $scope.submit = 'Create Classified Ad';
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
                            url : "https://netapi.danderdee.com/api/classifiedad",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Classified Ad Created Successfully';
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Classified Ad';
                        }, function myError(response) {
                            console.log(response);
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Classified Ad';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
