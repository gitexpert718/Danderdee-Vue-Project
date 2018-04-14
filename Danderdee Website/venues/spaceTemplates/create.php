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
           Space
           <small>Create</small>
         </h1>
         <ol class="breadcrumb">
           <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <li><a href="#">Space</a></li>
           <li class="active">Create</li>
         </ol>
      </section>
      <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
           <div class="row">
               <div class="col-xs-12 ">
                 <!-- general form elements -->
                   <div class="box box-primary">
                       <div class="box-header with-border">
                           <h3 class="box-title">Create Space</h3>
                           <p class="error">{{error}}</p>
                       </div><!-- /.box-header -->
                     <!-- form start -->
                       <form role='form' name="myForm" ng-submit="create()">
                           <div class="box-body">
                              <div class="form-group">
                                   <input type="text" id="Name" class="form-control" placeholder="Name" ng-model="user.name">
                                   <label for="Name">Name</label>
                              </div>
                              <div class="form-group">
                                   <label >Media Type</label>
                                   <select ng-model="user.mediaType" class="form-control">
                                       <option value=""></option>
                                       <option value="video">Video</option>
                                       <option value="audio">Audio</option>
                                   </select>

                              </div>
                              <div class="form-group">
                                   <textarea class="form-control" id="advertType" placeholder="Advert Type" ng-model="user.advertType"></textarea>
                                   <label for="advertType">Advert Type</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="Duration" class="form-control" placeholder="Duration" ng-model="user.duration">
                                   <label for="Duration">Duration</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="aspectRatio" class="form-control" placeholder="Aspect Ratio" ng-model="user.aspectRatio">
                                   <label for="aspectRatio">Aspect Ratio</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="weather" class="form-control" placeholder="Weather" ng-model="user.weather">
                                   <label for="weather">Weather</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="Mood" class="form-control" placeholder="Mood" ng-model="user.mood">
                                   <label for="Mood">Mood</label>
                              </div>
                              <div class="form-group">
                                   <textarea class="form-control" id="notes" placeholder="Notes" ng-model="user.notes"></textarea>
                                   <label for="notes">Notes</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="Height" class="form-control" placeholder="Height" ng-model="user.height">
                                   <label for="Height">Height</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="Width" class="form-control" placeholder="Width" ng-model="user.width">
                                   <label for="Width">Width</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="minHeight" class="form-control" placeholder="Min Height" ng-model="user.minHeight">
                                   <label for="minHeight">Min Height</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="minWidth" class="form-control" placeholder="Min Width" ng-model="user.minWidth">
                                   <label for="minWidth">Min Width</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="maxHeight" class="form-control" placeholder="Max Height" ng-model="user.maxHeight">
                                   <label for="maxHeight">Max Height</label>
                              </div>
                              <div class="form-group">
                                   <input type="text" id="maxWidth" class="form-control" placeholder="Max Width" ng-model="user.maxWidth">
                                   <label for="maxWidth">Max Width</label>
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
                    $scope.submit = 'Create Space Template';

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
                            url : "https://netapi.danderdee.com/api/space-templates",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Space Template Added Successfully';
                            $scope.submit = 'Create Space Template';
                            $scope.isDisabled = false;
                        }, function myError(response) {
                            var html = '';
                            console.log(response.data.errors);
                            angular.forEach(response.data.errors, function (value, index) {
                                html+= value.message + '\n'
                            });
                            $scope.error = html;
                            $scope.submit = 'Create Space Template';
                            $scope.isDisabled = false;
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
