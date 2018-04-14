<?php include('../includes/header.php'); ?>

<?php include('../includes/sidebar.php'); ?>

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php include('../includes/nav-header.php'); ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Order
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Order</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create Order</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" id="Key" class="form-control" placeholder="Key" ng-model="user.key">
                                <label for="Key">Key</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="Customer" class="form-control" placeholder="Customer" ng-model="user.customerId" />
                                <label for="Customer">Customer</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="Space" class="form-control" placeholder="Space" ng-model="user.spaceId" />
                                <label for="Space">Space</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="Device" class="form-control" placeholder="Device" ng-model="user.deviceId" />
                                <label for="Device">Device</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="validFrom" class="form-control" placeholder="Valid From" ng-model="user.validFrom" />
                                <label for="validFrom">Valid From</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="validTo" class="form-control" placeholder="Valid To" ng-model="user.validTo" />
                                <label for="validTo">Valid To</label>
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
                    $scope.submit = 'Create Order';
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
                    $scope.create = function() {
                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.submit = 'Submitting data';
                        $scope.error = 'Submitting data........';
                        $http({
                            method : "POST",
                            url : "https://netapi.danderdee.com/api/orders",
                            data : $scope.user
                        }).then(function mySucces(response) {
                            $scope.error = 'Order Created Successfully';
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Order';
                        }, function myError(response) {
                            console.log(response);
                            $scope.error = response.data.errors.name.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Create Order';
                        });
                    }
                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
