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
            Hardware Type
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Hardware Type</a></li>
            <li class="active">List</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List Hardware Type</h3>
                    <p class="error">{{error}}</p>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered" id="hardware-type-table">
                        <thead>
                            <tr>
                                <th>
                                    _id
                                </th>
                                <th >Name</th>
                                <th >_v</th>
                                <th>
                                    Last Updated
                                </th>
                                <th>
                                    Created Time
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" style="text-align: center">
                                    Loading.....
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


                $http({
                   method : "GET",
                   url : "https://netapi.danderdee.com/api/hardwaretype",
                   withCredentials: true

                }).then(function mySucces(response) {

                   if(response.status == 200)
                   {
                       var html = '';
                       $('#hardware-type-table tbody').html('');
                        var html = '';
                        var count = 1;
                        $('#hardware-type-table tbody').html('');
                        var wikiInfo = '';
                        $(response.data).each(function(i,val){
                            var html = '';

                            html = "<td><a href='edit.php?id=" + val._id + "' class='btn btn-primary btn-xs' title='Edit Hardware Type'><i class='glyphicon glyphicon-edit'></i></a><button type='button' class='btn btn-danger btn-xs' ng-click=delete_button('" + val._id + "') title='Delete Hardware Type'><i class='glyphicon glyphicon-remove'></i></button></td>";

                            var $el = $("<tr>" +

                            '<td>' + val._id + '</td>' +
                            '<td>' + val.name + '</td>' +
                            '<td>' + val.__v + '</td>' +
                            '<td>' + val.lastUpdated + '</td>' +
                            '<td>' + val.createdTime + '</td>' +

                            html +
                            '</tr>').appendTo('#hardware-type-table tbody');
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

                $scope.delete_button = function(id) {
                $scope.isDisabled = true;
                $scope.disabling = 'disabled';
                $scope.error = 'Deleting Hardware Type........';

                $http({
                    method : "DELETE",
                    url : "https://netapi.danderdee.com/api/categories",
                    data : {id:id}
                }).then(function mySucces(response) {
                    $scope.error = 'Hardware Type Deleted Successfully';
                    location.reload();
                }, function myError(response) {
                    if(response.status == 403)
                    {
                        alert("Please login to continue");
                        window.location.href = '/cp/login.html';
                    }
                    $scope.error = response.data.message;
                    $scope.isDisabled = false;
                });
            }

       });
       angular.bootstrap(document.getElementById("myApp"), ['myApp']);
</script>
<?php include('../includes/footer.php'); ?>
