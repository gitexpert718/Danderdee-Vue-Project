<?php include('../includes/header.php');
include('../includes/sidebar.php');

?>

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php include('../includes/nav-header.php'); ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Password
            <small>Change</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Password</a></li>
            <li class="active">Change</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Change Password</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                      <div class="box-body">

                        <div class="form-group">
                            <input type="password" id="current" class="form-control" placeholder="Current Password" ng-model="user.currentPassword" />
                            <label for="current">Current Password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" id="newP" class="form-control" placeholder="New Password" ng-model="user.newPassword" />
                            <label for="newP">New Password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" id="Reenter" class="form-control" placeholder="Re-enter Password" ng-model="user.verifyPassword" />
                            <label for="Reenter">Re-neter New Password</label>
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
                    $scope.submit = 'Change Password';

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
                        $scope.submit = 'Changing Password';
                        $scope.error = 'Changing Password........';
                        $http({
                            method : "POST",
                            url : "https://netapi.danderdee.com/api/users/password",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            if(response.status == 200)
                            {
                                $scope.isDisabled = false;
                                $scope.submit = 'Change Password';
                                $scope.error = 'Password Changed Successfully';
                            }
                        }, function myError(response) {
                            if(response.status == 403)
                            {
                                alert("Please login to continue");
                                window.location.href = '/cp/login.html';
                            }
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Change Password';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
