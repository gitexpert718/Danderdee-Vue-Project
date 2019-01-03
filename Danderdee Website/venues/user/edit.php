<?php
// if(!isset($_GET['id']))
// {
//    header('Location: list.php');
// }
// $id = $_GET['id'];
?>
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
            <small>Edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">Edit</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Edit User</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="update()">
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
                            <input type="password" id="password" class="form-control" placeholder="Password" ng-model="user.password">
                            <label for="password">Password (Leave it blank , if password does not need to be updated)</label>
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
                            <textarea class="form-control" id="address" placeholder="Address" ng-model="user.address"></textarea>
                            <label for="address">Address</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="postcode" class="form-control" placeholder="Post Code" ng-model="user.postcode">
                            <label for="postcode">Post Code</label>
                        </div>
                        <div class="form-group">
                            <input custom-on-change="uploadFile" type="file" id="photo" class="form-control" placeholder="Profile Picture" ng-model="image">
                            <label class="profilePictureLabel" for="photo">Profile Picture</label>
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
    app.directive('customOnChange', function() {
                    return {
                        restrict: 'A',
                        link: function (scope, element, attrs) {
                            var onChangeHandler = scope.$eval(attrs.customOnChange);
                            element.bind('change', onChangeHandler);
                        }
                    };
                });

       app.controller('myCtrl', function($scope, $http) {
           $scope.user = {};
            $scope.isDisabled = true;
            $scope.submit = 'Update User';
            $scope.error = ' ';
            $scope.profilePictureFile = '';
            $scope.userId = window.location.href.split('?')[1].split('=')[1];

                    $scope.uploadFile = function(event) {                        
                        const file = event.target.files[0];
                        const reader = new FileReader();
                        reader.addEventListener('load', async () => {
                            const imageBase = reader.result;
                            $scope.profilePictureFile = imageBase;
                        }, false);
                        if (file) {
                            reader.readAsDataURL(file);
                        }
                    };

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
                  method : "GET",
                  url : `https://netapi.danderdee.com/api/users/me`,
                  withCredentials: true,
               }).then(function mySucces(response) {                   
                   if(response.status == 200)
                   {
                       $scope.isDisabled = false;
                       $scope.user.accountType = response.data.accountType[0];
                       $scope.user.firstName = response.data.firstName;
                       $scope.user.lastName = response.data.lastName;
                       $scope.user.address = response.data.address;
                       $scope.user.postcode = response.data.postcode;
                   }
               }, function myError(response) {
                    if(response.status == 403)
                    {
                        alert("Please login to continue");
                        window.location.href = '/cp/login.html';
                    }
                   $scope.error = 'Error fetching data';
               });
               $scope.update = function() {
                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.submit = 'Updating data';
                        $scope.error = 'Updating data........';
                        if($scope.profilePictureFile !== ''){
                            $scope.user = {...$scope.user , 'profilePicture':$scope.profilePictureFile}    
                        }
                        $http({
                            method : "PUT",
                            url : `https://netapi.danderdee.com/api/users/${$scope.userId}`,
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Data Updated Successfully';
                            $scope.submit = 'Update User';
                        }, function myError(response) {                            
                            if(response.status == 403)
                            {
                                alert("Please login to continue");
                                window.location.href = '/cp/login.html';
                            }
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Update User';
                        });
                    }
       });
       angular.bootstrap(document.getElementById("myApp"), ['myApp']);
</script>
<?php include('../includes/footer.php'); ?>
