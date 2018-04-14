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
            Device Stats
            <small>Edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Device Stats</a></li>
            <li class="active">Edit</li>
          </ol>
        </section>


        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Create Device</h3>
                      <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role='form' name="myForm" ng-submit="create()">
                      <div class="box-body">


						<div ng-if="locations.length>0" class="form-group">
							<label>Location</label>
							<select ng-change="updateFields()" class="form-control" placeholder="Location" ng-model="loc.locationId"
								ng-options="location._id as location.string_id for location in locations">

							</select>
						</div>

						<button  ng-if="locations.length==0" type="button" class="btn btn-primary" ng-click="goToLocationCreate();">Create Location</button>


                        <div class="form-group">
                            <input type="text"  id="deviceid"  ng-required="requireInputs" ng-readonly="inputsDisabled" class="form-control" placeholder="Device ID" ng-model="user.stringId">
                            <label for="deviceid">Device ID</label>
                        </div>




                        <div class="form-group">
                            <label >Hardware Type</label>

							<style>
							.robo-hardwaretype-selected{
								background-color: #ecf0f5;
							}
							</style>
						<div class="row">
						  <div class="col-md-3" style="cursor:pointer;" ng-repeat="hardwaretype in hardwaretypes" ng-click="selectHardwaretype(hardwaretype)">
							<div ng-class="{'robo-hardwaretype-selected':user.hardwareType==hardwaretype._id}"  class="thumbnail">
								<img src="https://place-hold.it/200x150" alt="hardware type {{$index}}" style="width:100%">
								<div class="caption">
								  <p> {{hardwaretype.name}} </p>
								</div>
							</div>
						  </div>
						</div>

                            <input type="hidden"  ng-required="requireInputs" ng-readonly="inputsReadonly" class="form-control" placeholder="Hardware Type" ng-model="user.hardwareType">
                        </div>
                        <div class="form-group">
                            <input type="text" id="macAddress"  ng-required="requireInputs" ng-readonly="inputsReadonly" class="form-control" placeholder="MAC Address" ng-model="user.macAddress">
                            <label for="macAddress">MAC Address</label>
                        </div>
<!--                        <div class="form-group">
                            <label >Portal key</label>
                            <input type="text" class="form-control" placeholder="Portal Key" ng-model="user.portalKey">
                        </div>-->
                        <div class="form-group hide">
                            <input type="text" id="location"  ng-required="requireInputs"  ng-readonly="inputsReadonly" class="form-control" placeholder="Location" ng-model="user.locationId">
                            <label for="location">Location ID</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="notes" ng-readonly="inputsReadonly" placeholder="Notes" ng-model="user.notes"></textarea>
                            <label for="notes">Notes</label>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="address" placeholder="Address" ng-model="user.address"></textarea>
                            <label for="address">Address</label>
                        </div>
                        <div class="form-group">
                            <input ng-required="requireInputs" id="postCode" type="text" class="form-control" placeholder="Postcode" ng-model="user.postCode">
                            <label for="postCode">Postcode</label>
                        </div>
                        <div class="form-group hide">
                            <input ng-readonly="inputsReadonly" id="Longitude" type="text" class="form-control" placeholder="Longitude" ng-model="user.lng">
                            <label for="Longitude">Longitude</label>
                        </div>
                        <div class="form-group hide">
                            <input ng-readonly="inputsReadonly"id="Latitude" type="text" class="form-control" placeholder="Latitude" ng-model="user.lat">
                            <label for="Latitude">Latitude</label>
                        </div>


                      </div><!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary submit-button" ng-readonly="!myForm.$valid && isDisabled">{{submit}}</button>
                        <button type="reset" ng-click="onFormReset()" class="btn btn-default">Reset</button>
                      </div>
                    </form>
                  </div><!-- /.box -->



                </div><!--/.col (left) -->
            </div>

        </section>



</div>







<script>

            var app = angular.module('myApp', []);
                app.controller('myCtrl', function($scope, $http, $httpParamSerializer) {

					var initDeviceId='<?php echo $_GET["id"] ?>';

					$scope.loc = {};
					//$scope.locationId = "";
					$scope.locations = [];

					// $scope.locations =
					// [
						// {
							// _id:"5aa59c895279a156dafee7b1",
							// address:"1 maplebank loaning",
							// city:"Dumfries",
							// country:"United Kingdom",
							// lat:"55.06957659956703",
							// lng:"-3.5805039840541384",
							// locationKey:"myJxtHfIUH309LOqS57G8Q==",
							// locationType:"Public",
							// postCode:"DG1 3HQ",
							// region:"Scotland",
							// string_id:"test1",
						// },{
							// _id:"5ab1f94f7a0d00612031b5cc",
							// address:"qwe",
							// city:"Chotomów",
							// country:"Poland",
							// lat:"52.410386132099845",
							// lng:"20.886118737639",
							// locationKey:"jiuH2AHuMcO5g6xIiJqYtQ==",
							// locationType:"Public",
							// postCode:"123",
							// region:"Mazovia",
							// string_id:"qwe",
						// },
					// ];


					$scope.devices = [];

					$scope.hardwaretypes = [];

					$scope.onFormReset = function(){
						$scope.requireInputs = true;
						$scope.inputsReadonly = false;
						$scope.loc.locationId = undefined;
					};

					$scope.selectHardwaretype = function(hardwaretype){
						$scope.user.hardwareType = hardwaretype._id;
					};

					$scope.requireInputs = true;
					$scope.inputsReadonly = false;
					$scope.user = {};
					$scope.goToLocationCreate = function(){
						location.replace(location.protocol +'//'+location.hostname +'/cp/location/create.php');
					};
					$scope.updateFields = function(){
						for(var i=0;i<$scope.locations.length;i++){

							//console.log(i,$scope.locations[i]._id,$scope.loc.locationId);

							if($scope.locations[i]._id==$scope.loc.locationId){
								$scope.user.country = $scope.locations[i].country;
								$scope.user.locationKey = $scope.locations[i].locationKey;
								$scope.user.locationId = $scope.locations[i].locationKey;
								$scope.user.address = $scope.locations[i].address;
								$scope.user.postCode = $scope.locations[i].postCode;
								$scope.user.stringId = $scope.locations[i].string_id;
								$scope.user.notes = $scope.locations[i].notes;
								$scope.user.lng = $scope.locations[i].lng;
								$scope.user.lat = $scope.locations[i].lat;

								$scope.inputsReadonly = true;
								break;
							}
						}

					};


					$scope.hardwaretypes = [];

					// $scope.hardwaretypes = [
						// {
							// "_id": "5a9adb6fd9d0cd386168452f",
							// "name": "hotspot mk1",
							// "__v": 1,
							// "lastUpdated": "2018-03-17T12:15:37.970Z",
							// "createdTime": "2018-03-03T17:29:19.272Z",
							// "numOfSpaces": [
								// {
									// "templateId": "5aa59cf25279a156dafee7b2",
									// "count": 10
								// }
							// ],
							// "spaceTemplates": [
								// {
									// "_id": "5aa59cf25279a156dafee7b2",
									// "name": "test space template 1",
									// "mediaType": "image",
									// "advertType": "abc",
									// "duration": 2,
									// "aspectRatio": "abc",
									// "weather": "abc",
									// "mood": "abc",
									// "notes": "abc",
									// "height": 2,
									// "width": 2,
									// "minHeight": 2,
									// "maxHeight": 2,
									// "minWidth": 2,
									// "maxWidth": 2,
									// "__v": 0,
									// "lastUpdated": "2018-03-11T21:17:38.690Z",
									// "createdTime": "2018-03-11T21:17:38.688Z"
								// }
							// ]
						// },
						// {
							// "_id": "5aa59d3a5279a156dafee7b5",
							// "name": "test hardware type 1",
							// "__v": 1,
							// "lastUpdated": "2018-03-17T12:16:24.640Z",
							// "createdTime": "2018-03-11T21:18:50.259Z",
							// "numOfSpaces": [
								// {
									// "templateId": "5aa59cf25279a156dafee7b2",
									// "count": 5
								// }
							// ],
							// "spaceTemplates": [
								// {
									// "_id": "5aa59cf25279a156dafee7b2",
									// "name": "test space template 1",
									// "mediaType": "image",
									// "advertType": "abc",
									// "duration": 2,
									// "aspectRatio": "abc",
									// "weather": "abc",
									// "mood": "abc",
									// "notes": "abc",
									// "height": 2,
									// "width": 2,
									// "minHeight": 2,
									// "maxHeight": 2,
									// "minWidth": 2,
									// "maxWidth": 2,
									// "__v": 0,
									// "lastUpdated": "2018-03-11T21:17:38.690Z",
									// "createdTime": "2018-03-11T21:17:38.688Z"
								// }
							// ]
						// },
						// {
							// "_id": "5aad163c7203301864fb5a9d",
							// "name": "test 2",
							// "__v": 0,
							// "lastUpdated": "2018-03-17T13:21:00.497Z",
							// "createdTime": "2018-03-17T13:21:00.496Z",
							// "numOfSpaces": [],
							// "spaceTemplates": []
						// }
					// ];


                    $scope.isDisabled = false;
                    $scope.submit = 'Update Device';
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
                        method : "GET",
                        url : "https://netapi.danderdee.com/api/users/me",
                        withCredentials: true
                    }).then(function mySucces(response) {

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




                    $scope.create = function() {

						// required

						// stringId 			formData 	string
						// hardwareType 		formData 	string
						// macAddress 			formData 	string
						// locationId 			formData 	string
						// postcode 			formData 	string


						if(typeof $scope.user.macAddress === "undefined" || !!$scope.user.macAddress){
							$scope.user.macAddress = '00.00.00.00';
						}

                        $scope.isDisabled = true;
                        $scope.disabling = 'disabled';
                        $scope.submit = 'Submitting data';
                        $scope.error = 'Submitting data........';
                        $http({
							method : "PUT",
                            url : "https://netapi.danderdee.com/api/devices" ,
                            headers : {
								'Content-Type': 'application/x-www-form-urlencoded'
							},
							withCredentials: true,
                            data : $httpParamSerializer($scope.user)

                        }).then(function mySucces(response) {
                            $scope.error = 'Device Data Updated Successfully';
                            $scope.isDisabled = false;
                            $scope.submit = 'Update Device';

							location.replace(location.protocol +'//'+location.hostname+'/cp/index.php');

                        }, function myError(response) {
                            console.log(response);
                            $scope.error = response.data.message;
                            $scope.isDisabled = false;
                            $scope.submit = 'Update Device';
                        });
                    };



					var findSelectedDevice = function(){

						for(var i=0;i<$scope.devices.length;i++){
							if($scope.devices[i]._id==initDeviceId){

								$scope.user.country = $scope.devices[i].location.country;
								$scope.user.locationKey = $scope.devices[i].locationId;
								$scope.user.locationId = $scope.devices[i].locationId;
								$scope.loc.locationId = $scope.devices[i].locationId;
								$scope.user.address = $scope.devices[i].location.address;
								$scope.user.postCode = $scope.devices[i].location.postCode;
								$scope.user.stringId = $scope.devices[i].stringId;
								if(typeof $scope.devices[i].notes !== "undefined" ){
									$scope.user.notes = $scope.devices[i].notes;
								}
								$scope.user.lng = $scope.devices[i].location.lng;
								$scope.user.lat = $scope.devices[i].location.lat;
								$scope.user.hardwareType  = $scope.devices[i].hardwareType;
								$scope.user.macAddress  = $scope.devices[i].macAddress;

								break;
							}
						}
					};

					$http({
                            method : "GET",
                            url : "https://netapi.danderdee.com/api/devices",
							withCredentials: true
                        }).then(function successCallback(response) {
                            $scope.devices  = response.data;

							findSelectedDevice();


                        }, function errorCallback(response) {
							console.log("locations fetch error", response);

							// $scope.devices =
								// [
									// {
										// "_id": "5aa59d7c5279a156dafee7b6",
										// "portalKey": "MS4iTsRkerZfJA+eCpuY9g==",
										// "stringId": "test device 1",
										// "hardwareType": "5aa59d3a5279a156dafee7b5",
										// "macAddress": "abc",
										// "notes": "sdf",
										// "locationId": "5aa59c895279a156dafee7b1",
										// "stats": [],
										// "interfaces": [],
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ],
										// "reachableNeighbours": [],
										// "isConnected": true,
										// "__v": 1,
										// "location": {
											// "_id": "5aa59c895279a156dafee7b1",
											// "country": "United Kingdom",
											// "lng": -3.5805039840541384,
											// "lat": 55.06957659956703,
											// "city": "Dumfries",
											// "region": "Scotland",
											// "locationKey": "myJxtHfIUH309LOqS57G8Q==",
											// "string_id": "test1",
											// "address": "1 maplebank loaning",
											// "locationType": "Public",
											// "postCode": "DG1 3HQ",
											// "users": [
												// "5a8c8d962ce61414ca3d1e80"
											// ],
											// "__v": 1
										// }
									// },
									// {
										// "_id": "5ab108b0a535c23d9713b4b4",
										// "lng": -3.5718542350979994,
										// "lat": 55.095814371864364,
										// "portalKey": "lwQ6WOTZYiAeu2b78ep46A==",
										// "stringId": "geo-test1",
										// "hardwareType": "5a9adb6fd9d0cd386168452f",
										// "macAddress": "1234",
										// "locationId": "5aa59c895279a156dafee7b1",
										// "address": "22 anson avenue",
										// "postCode": "dg1 3qh",
										// "stats": [],
										// "interfaces": [],
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ],
										// "reachableNeighbours": [],
										// "isConnected": true,
										// "__v": 1,
										// "location": {
											// "_id": "5aa59c895279a156dafee7b1",
											// "country": "United Kingdom",
											// "lng": -3.5805039840541384,
											// "lat": 55.06957659956703,
											// "city": "Dumfries",
											// "region": "Scotland",
											// "locationKey": "myJxtHfIUH309LOqS57G8Q==",
											// "string_id": "test1",
											// "address": "1 maplebank loaning",
											// "locationType": "Public",
											// "postCode": "DG1 3HQ",
											// "users": [
												// "5a8c8d962ce61414ca3d1e80"
											// ],
											// "__v": 1
										// }
									// },
									// {
										// "_id": "5ab225b6562f327f8f5f0450",
										// "lng": -3.5805039840541384,
										// "lat": 55.06957659956703,
										// "portalKey": "earzlV2s0LWQT0SHs9Oqgw==",
										// "stringId": "testing",
										// "hardwareType": "5a9adb6fd9d0cd386168452f",
										// "macAddress": "1234",
										// "locationId": "5aa59c895279a156dafee7b1",
										// "postCode": "dg13hq",
										// "stats": [],
										// "interfaces": [],
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ],
										// "reachableNeighbours": [],
										// "isConnected": true,
										// "__v": 1,
										// "location": {
											// "_id": "5aa59c895279a156dafee7b1",
											// "country": "United Kingdom",
											// "lng": -3.5805039840541384,
											// "lat": 55.06957659956703,
											// "city": "Dumfries",
											// "region": "Scotland",
											// "locationKey": "myJxtHfIUH309LOqS57G8Q==",
											// "string_id": "test1",
											// "address": "1 maplebank loaning",
											// "locationType": "Public",
											// "postCode": "DG1 3HQ",
											// "users": [
												// "5a8c8d962ce61414ca3d1e80"
											// ],
											// "__v": 1
										// }
									// }
								// ]
								// ;
								// findSelectedDevice();
                    });



					$http({
                            method : "GET",
                            url : "https://netapi.danderdee.com/api/locations",
							withCredentials: true
                        }).then(function successCallback(response) {
                            $scope.locations = response.data;

                        }, function errorCallback(response) {
							console.log("locations fetch error", response);
                    });



					$http({
                            method : "GET",
                            url : "https://netapi.danderdee.com/api/hardwaretype",
							withCredentials: true
                        }).then(function successCallback(response) {
                            $scope.hardwaretypes = response.data;



                        }, function errorCallback(response) {
							console.log("hardwaretype fetch error", response);
                    });

                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>




<?php include('../includes/footer.php'); ?>
