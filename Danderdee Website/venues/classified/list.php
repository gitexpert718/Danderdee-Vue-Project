<?php
// session_start();
//
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
            Classified
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Classified</a></li>
            <li class="active">List</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List Classified</h3>
                    <p class="error">{{error}}</p>
                </div><!-- /.box-header -->
                <div class="col-xs-12" style="margin-top:5px">
                    <div class="col-xs-12 col-sm-4 " style="margin-top:5px">
                        <select class="form-control" id="type">
                            <option value="">---select---</option>
                            <option value="country">Country</option>
                            <option value="district">District</option>
                            <option value="postcode">Postcode</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-4 " style="margin-top:5px">
                        <input type="text" class="form-control" id="text-type" />
                    </div>
                    <div class="col-xs-12 col-sm-4 " style="margin-top:5px">
                        <button type="button" class="col-xs-12 btn btn-success" id="search-button" ng-click="submit()">Search</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered" id="classified-table">
                        <thead>
                            <tr>
                                <th>
                                    _id
                                </th>
                                <th >Title</th>
                                <th >Email</th>
                                <th>
                                    Area
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Condition
                                </th>
                                <th>Price</th>

                                <th>Is Active?</th>
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


            $scope.submit = function() {
                var type = $('#type').val();
                var text = $('#text-type').val();
                if(type == '')
                {
                    $http({
                        method : "GET",
                        url : "https://netapi.danderdee.com/api/classifiedad",
                        withCredentials: true
                    }).then(function mySucces(response) {

                            if(response.status == 200)
                            {
                                var html = '';
                                $('#classified-table tbody').html('');
                                 var html = '';
                                 var count = 1;
                                 $('#classified-table tbody').html('');
                                 var wikiInfo = '';
                                 $(response.data).each(function(i,val){
                                     var html = '';

                                     html = "<td><a href='edit.php?id=" + val._id + "' class='btn btn-primary btn-xs' title='Edit Classified'><i class='glyphicon glyphicon-edit'></i></a><button type='button' class='btn btn-danger btn-xs' ng-click=delete_button('" + val._id + "') title='Delete Classified'><i class='glyphicon glyphicon-remove'></i></button></td>";

                                     var $el = $("<tr>" +

                                     '<td>' + val._id + '</td>' +
                                     '<td>' + val.title + '</td>' +
                                     '<td>' + val.email + '</td>' +
                                     '<td>' + val.areaId.postcode + '</td>' +
                                     '<td>' + val.address + '</td>' +
                                     '<td>' + val.type + '</td>' +
                                     '<td>' + val.condition + '</td>' +
                                     '<td>' + val.price + '</td>' +
                                     '<td>' + val.isActive + '</td>' +

                                     html +
                                     '</tr>').appendTo('#classified-table tbody');
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
                    }
                    else
                    {
                        $http({
                            method : "GET",
                            url : "https://netapi.danderdee.com/api/classifiedad/" + type + "/" + text
                        }).then(function mySucces(response) {

                                if(response.status == 200)
                                {
                                    var html = '';
                                    $('#classified-table tbody').html('');
                                     var html = '';
                                     var count = 1;
                                     $('#classified-table tbody').html('');
                                     var wikiInfo = '';
                                     $(response.data).each(function(i,val){
                                         var html = '';

                                         html = "<td><a href='edit.php?id=" + val._id + "' class='btn btn-primary btn-xs' title='Edit Classified'><i class='glyphicon glyphicon-edit'></i></a><button type='button' class='btn btn-danger btn-xs' ng-click=delete_button('" + val._id + "') title='Delete Classified'><i class='glyphicon glyphicon-remove'></i></button></td>";

                                         var $el = $("<tr>" +

                                         '<td>' + val._id + '</td>' +
                                         '<td>' + val.title + '</td>' +
                                         '<td>' + val.email + '</td>' +
                                         '<td></td>' +
                                         '<td>' + val.address + '</td>' +
                                         '<td>' + val.type + '</td>' +
                                         '<td>' + val.condition + '</td>' +
                                         '<td>' + val.price + '</td>' +
                                         '<td>' + val.isActive + '</td>' +

                                         html +
                                         '</tr>').appendTo('#classified-table tbody');
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
                        }

                        $scope.delete_button = function(id) {
                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.error = 'Deleting Classified........';

                        $http({
                            method : "DELETE",
                            url : "https://netapi.danderdee.com/api/classifiedad",
                            data : {id:id}
                        }).then(function mySucces(response) {
                            $scope.error = 'Classified Deleted Successfully';
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
            };


       });
       angular.bootstrap(document.getElementById("myApp"), ['myApp']);

      $(document).ready(function(){
        $('#search-button').trigger('click');
      });
</script>
<?php include('../includes/footer.php'); ?>
