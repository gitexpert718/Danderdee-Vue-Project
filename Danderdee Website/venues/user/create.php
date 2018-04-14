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
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create User</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                      <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Account Type</label>
                            <select name='accountType' class='form-control' ng-model="user.accountType">
                                <option value=''>---select---</option>
                                <option value='admin'>Admin</option>
                                <option value='light_admin'>Light Admin</option>
                                <option value='user'>User</option>
                                <option value='light_user'>Light User</option>
                                <option value='wifi_user'>Wifi User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="username" class="form-control" placeholder="Username" ng-model="user.username">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" class="form-control" placeholder="Password" ng-model="user.password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="firstName" class="form-control" placeholder="First Name" ng-model="user.firstName">
                            <label for="firstName">First name</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="lastName" class="form-control" placeholder="Last Name" ng-model="user.lastName">
                            <label for="lastName">Last name</label>
                        </div>
                          <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Email" ng-model="user.email">
                            <label for="email">Email</label>
                        </div>
                        <div class="form-group">
                           <label>Age</label>
                            <input type="number" class="form-control" placeholder="Age" ng-model="user.age">
                        </div>

                        <div class="form-group">
                           <label >Gender</label>
                            <select name='accountType' class='form-control' ng-model="user.gender">
                                <option value="">---select---</option>
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="phoneNumber" class="form-control" placeholder="Phone Number" ng-model="user.phoneNumber">
                            <label for="phoneNumber">Phone Number</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="address" placeholder="Address" ng-model="user.address"></textarea>
                            <label for="address">Address</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="postcode" class="form-control" placeholder="Post Code" ng-model="user.postcode">
                            <label for="postcode">Post Code</label>
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
//            var headers = {
//				'Access-Control-Allow-Origin' : '*',
//				'Access-Control-Allow-Methods' : 'POST, GET, OPTIONS, PUT',
//				'Content-Type': 'application/json',
//				'Accept': 'application/json'
//			};
                app.controller('myCtrl', function($scope, $http) {
                    $scope.isDisabled = false;
                    $scope.submit = 'Create User';

                    $http({
                        withCredentials: true,
                        method: "GET",
                        url: "https://netapi.danderdee.com/api/users/me"

                    }).then(function myFunction(response){
                          console.log(response);
                          $(response.data).each(function(i,val){
                                if(response.status == 200){

                                    $('#username').text(val.username);
                                }

                        });

                    }, function myError(error){

                      console.log(error);
                    });



                    $scope.create = function() {
                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.submit = 'Submitting data';
                        $scope.error = 'Submitting data........';
                        $http({
                            method : "POST",
                         //   headers: headers,
                            url : "https://netapi.danderdee.com/api/auth/signup",
                            data : $scope.user
                          //  data : $httpParamSerializerJQLike($scope.user),
                     //       headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).then(function mySucces(response) {
                            localStorage.setItem("__id", response.data['_id']);
                            $scope.error = 'Data Submitted Successfully';
                            $scope.submit = 'Create User';
                            $scope.isDisabled = false;
                        }, function myError(response) {
                            if(response.status == 403)
                            {
                                alert("Please login to continue");
                                window.location.href = '/cp/login.html';
                            }
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Create User';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
