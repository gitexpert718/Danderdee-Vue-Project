<?php include('../includes/header.php');
include('../includes/sidebar.php');

 ?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php include('../includes/nav-header.php'); ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sub Category
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Sub Category</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create Sub Category</h3>
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
                                <input type="text" id="categoryId" class="form-control" placeholder="Category ID" ng-model="user.categoryId">
                                <label for="categoryId">Category ID</label>
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
                    $scope.submit = 'Create Sub Category';
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


                    $scope.create = function() {


                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.submit = 'Submitting data';
                        $scope.error = 'Submitting data........';
                        $http({
                            method : "POST",
                            url : "https://netapi.danderdee.com/api/subcategories",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Sub Category Created Successfully';
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Sub Category';
                        }, function myError(response) {
                            console.log(response);
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Sub Category';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
