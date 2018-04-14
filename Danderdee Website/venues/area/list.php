<?php
// session_start();
//
// $white_list = ['admin', 'light_admin', 'user', 'light_user'];
// if(!in_array($_SESSION['role'], $white_list)){
//        header('Location: ../index.php');
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
            Area
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Area</a></li>
            <li class="active">List</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List Area</h3>
                    <p class="error">{{error}}</p>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered" id="area-table">
                        <thead>
                            <tr>
                                <th>
                                    _id
                                </th>
                                <th >Post Code</th>
                                <th>__v</th>

                                <th>Approved?</th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" style="text-align: center">
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


            $scope.user = {};
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
            withCredentials: true,
            method : "GET",
            url : "https://netapi.danderdee.com/api/areas"

            }).then(function mySucces(response) {
                   console.log(response);
                   if(response.status == 200)
                   {
                       var html = '';
                       $('#area-table tbody').html('');
                        var html = '';
                        var count = 1;
                        $('#area-table tbody').html('');
                        var wikiInfo = '';
                        $(response.data).each(function(i,val){

                            var html = '';
                            if(val.isApproved == false)
                            {
                                html = "<td><button type='button' class='btn btn-success btn-xs' ng-click=approve_button('" + val._id + "') >Approve</button><button type='button' class='btn btn-danger btn-xs' ng-click=add_wiki('" + val._id + "') title='Add Wiki'><i class='glyphicon glyphicon-plus'></i></button><a href='edit.php?id=" + val._id + "' class='btn btn-primary btn-xs' title='Edit Wiki'><i class='glyphicon glyphicon-edit'></i></a></td>";
                            }
                            else
                            {
                                html = "<td><button type='button' class='btn btn-danger btn-xs' ng-click=disapprove_button('" + val._id + "') >DisApprove</button><button type='button' class='btn btn-danger btn-xs' ng-click=add_wiki('" + val._id + "') title='Add Wiki'><i class='glyphicon glyphicon-plus'></i></button><a href='edit.php?id=" + val._id + "' class='btn btn-primary btn-xs'  title='Edit Wiki'><i class='glyphicon glyphicon-edit'></i></a></td>";
                            }


                            var $el = $("<tr>" +

                            '<td>' + val._id + '</td>' +
                            '<td>' + val.postCode + '</td>' +
                            '<td>' + val.__v + '</td>' +
                            '<td>' + val.isApproved + '</td>' +

                            html +
                            '</tr>').appendTo('#area-table tbody');
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

            $scope.approve_button = function(id) {
                $scope.isDisabled = true;
                $scope.disabling = 'disabled';
                $scope.error = 'Approving user........';

                $http({
                    method : "POST",
                    url : "https://netapi.danderdee.com/api/areas/approve",
                    data : {id:id}
                }).then(function mySucces(response) {
                    $scope.error = 'User Approved Successfully';
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

            $scope.disapprove_button = function(id) {
                $scope.isDisabled = true;
                $scope.disabling = 'disabled';
                $scope.error = 'Approving user........';

                $http({
                    method : "POST",
                    url : "https://netapi.danderdee.com/api/areas/disapprove",
                    data : {id:id}
                }).then(function mySucces(response) {
                    $scope.error = 'User DisApproved Successfully';
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

            $scope.add_wiki = function(id) {
                $scope.isDisabled = true;
                $scope.disabling = 'disabled';
                $scope.error = 'Adding Information from Wikipedia........';

                $http({
                    method : "POST",
                    url : "https://netapi.danderdee.com/api/areas/addwiki",
                    data : {id:id}
                }).then(function mySucces(response) {
                    $scope.error = 'Wiki Added Successfully';
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
