<?php include('../includes/header.php');
include('../includes/sidebar.php');

?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php include('../includes/nav-header.php'); ?>
   
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">List</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List Users</h3>

                    <p class="error">{{error}}</p>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-bordered" id="table">
                      <thead>
                            <tr>
                                <th >#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th >Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>

                                </th>
                            </tr>
                      </thead>
                      <tbody>
                            <tr compile-data template="{{newTransaction}}">
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
                    method: "GET",
                    url: "https://netapi.danderdee.com/api/users/me"

                }).then(function myFunction(response){

                      $(response.data).each(function(i,val){
                            if(response.status == 200){

                                $('#username').text(val.username);
                            }

                    });

                }, function myError(error){

                  console.log(error);
                });





               $http({
                    withCredentials: true,
                    method : "GET",
                    url : "https://netapi.danderdee.com/api/users"

               }).then(function mySucces(response) {
                  console.log(response);
                   if(response.status == 200)
                   {
                       var html = '';
                       $('#table tbody').html('');
                       $(response.data).each(function(i,val){
                           var $el = $("" +
                           " <tr><td></td> " +
                           " <td>" + val.firstName + "</td> " +
                           " <td>" + val.lastName + "</td> " +
                           " <td>" + val.email + "</td> " +
                           " <td>" + val.phoneNumber + "</td> " +
                           " <td></td> " +
                           " <td><a class='btn btn-primary btn-xs' href='edit.php?id=" + val._id + "' title='Edit User'><i class='glyphicon glyphicon-edit'></i></a><a class='btn btn-danger btn-xs del-button' ng-click=removeUser('" + val._id + "') data-id='" + val._id + "' ng-disabled='isDisabled' title='Delete User'><i class='glyphicon glyphicon-remove'></i></a>" +
                           " </td></tr> ").appendTo('#table tbody');
                         //  $('#table tbody').append(html);
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

               $scope.removeUser = function(id) {
                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.error = 'Deleting user........';

                        $http({
                            method : "DELETE",
                            url : "https://netapi.danderdee.com/api/users/" + id,
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'User Deleted Successfully';
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
