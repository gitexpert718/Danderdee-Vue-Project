<?php
// session_start();
//
// $white_list = ['admin', 'light_admin', 'user', 'light_user'];
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
            Device
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Device</a></li>
            <li class="active">List</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List Devices</h3>
                    <p class="error">{{error}}</p>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered" id="device-table">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th>String ID</th>
                                <th>Hardware Type</th>
                                <th >MAC Address</th>
                                <th>Location</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1.
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div><!-- /.box -->
            </div>
            </div>

        </section>

</div>
<script>
    var app = angular.module('myApp', []);
       app.controller('myCtrl', function($scope, $http, $compile) {
            $scope.error = ' ';

              $http({
                    method : "GET",
                    url : "https://netapi.danderdee.com/api/users/me",
                    withCredentials: true
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


               $http({
                    method : "GET",
                    url : "https://netapi.danderdee.com/api/devices",
                    withCredentials: true
               }).then(function mySucces(response) {
                   console.log(response);

                   if(response.status == 200)
                   {
                       var html = '';
                       $('#device-table tbody').html('');
                        var html = '';
                        var count = 1;
                        $(response.data).each(function(i,val){
                            var $el = $("" +
                            '<tr><td>' + count++ + '</td>' +
                            '<td>' + val.stringId + '</td>' +
                            '<td>' + val.hardwareType + '</td>' +
                            '<td>' + val.macAddress + '</td>' +
                            '<td>' + val.location + '</td>' +
                            '<td>' + val.lat + '</td>' +
                            '<td>' + val.lng + '</td>' +
                            '<td><a href="edit.php?id=' + val._id + '" class="btn btn-success col-xs-12">Edit Device Stats</a></td>' +
                            '</tr>').appendTo('#device-table tbody');
                            $compile($el)($scope);

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
       });
       angular.bootstrap(document.getElementById("myApp"), ['myApp']);
</script>
<?php include('../includes/footer.php'); ?>
