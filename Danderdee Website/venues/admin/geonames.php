<?php
//session_start();

//$white_list = ['admin', 'light_admin', 'user', 'light_user'];
//if(!in_array($_SESSION['role'], $white_list)){
//       header('Location: ../index.php');
//      die();
//}

include('../includes/header.php');
include('../includes/sidebar.php');


?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="myApp" ng-app="myApp" ng-controller="myCtrl">
<?php include('../includes/nav-header.php'); ?>
        <section ng-if="selGeoname" class="content-header">
          <h1>
            Geoname
            <small>Edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Geoname</a></li>
            <li class="active">Edit</li>
          </ol>


        </section>

        <section  ng-if="selGeoname" class='content ' >
            <div class="row">
               <div class="col-xs-12 ">
                  <!-- general form elements -->
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Edit Geoname</h3>
                    <p class="error">{{error}}</p>
					 <button role="button" ng-click="backToList();" class="btn btn-sm btn-default">Go Back To List</button>
                  </div><!-- /.box-header -->
					<div class="box-body">


                        <div class="form-group">
                            <input required type="text" id="CountryCode" class="form-control" placeholder="CountryCode" ng-model="selGeoname.CountryCode">
                            <label for="CountryCode">CountryCode</label>
                        </div>
                        <div class="form-group">
                            <input required type="text" id="PostalCode" class="form-control" placeholder="PostalCode" ng-model="selGeoname.PostalCode">
                            <label for="PostalCode">PostalCode</label>
                        </div>
                        <div class="form-group">
                            <input required type="text" id="Latitude" class="form-control" placeholder="Latitude" ng-model="selGeoname.Latitude">
                            <label for="Latitude">Latitude</label>
                        </div>

                        <div class="form-group">
                            <input required type="text" id="Longitude" class="form-control" placeholder="Longitude" ng-model="selGeoname.Longitude">
                            <label for="Longitude">Longitude</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="Region" class="form-control" placeholder="Region" ng-model="selGeoname.Region">
                            <label for="Region">Region</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="City" class="form-control" placeholder="City" ng-model="selGeoname.City">
                            <label for="City">City</label>
                        </div>



                        <div class="form-group">
                            <input type="text" id="Country"  class="form-control" placeholder="Country" ng-model="selGeoname.Country">
                            <label for="Country">Country</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="SubCountry"  class="form-control" placeholder="SubCountry" ng-model="selGeoname.SubCountry">
                            <label for="SubCountry">SubCountry</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="active"  class="form-control" placeholder="active" ng-model="selGeoname.active">
                            <label for="active">active</label>
                        </div>


						<div class="form-group">
                            <button type="button" role="button" ng-click="submitChanges()" style="margin-right:10px"  class="pull-left btn btn-primary"> {{submit}} </button>

							                            <button type="button" style="margin-right:10px" role="button" ng-click="approveChanges()" class="pull-left btn btn-success"> {{approve}} </button>
                        </div>



					</div>
                 </div><!-- /.box -->
              </div>
            </div>
		</section>









        <!-- Content Header (Page header) -->
        <section ng-if="!selGeoname" class="content-header">
          <h1>
            Geonames
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Geonames</a></li>
            <li class="active">List</li>
          </ol>


        </section>

        <section  ng-if="!selGeoname" class='content ' >
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List Geonames</h3>
                    <p class="error">{{error}}</p>
                </div><!-- /.box-header -->




					<div class="form-group" style="margin: 10px 10px 0;">
					  <div class="input-group">
						<div class="input-group-addon"><i class="fa fa-search"></i></div>
						<input type="text" class="form-control" placeholder="Search the table" ng-model="searchTerm">
					  </div>
					</div>



                <div class="box-body table-responsive">
                  <table class="table table-bordered" id="location-list">
                      <thead>
                    <tr>
                        <th >#</th>
                        <th>
						 <a href="javascript:void(0)" ng-click="sortType = 'CountryCode'; sortReverse = !sortReverse">
							Country Code
							<span ng-show="sortType == 'CountryCode' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'CountryCode' && sortReverse" class="fa fa-caret-up"></span>
						  </a>

						</th>
                        <th>
							<a href="javascript:void(0)" ng-click="sortType = 'PostalCode'; sortReverse = !sortReverse">
							Postal Code
							<span ng-show="sortType == 'PostalCode' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'PostalCode' && sortReverse" class="fa fa-caret-up"></span>
						  </a>

						</th>
                        <th >
													<a href="javascript:void(0)" ng-click="sortType = 'Latitude'; sortReverse = !sortReverse">
							Latitude
							<span ng-show="sortType == 'Latitude' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'Latitude' && sortReverse" class="fa fa-caret-up"></span>
						  </a>

						</th>

						 <th>
<a href="javascript:void(0)" ng-click="sortType = 'Longitude'; sortReverse = !sortReverse">
							Longitude
							<span ng-show="sortType == 'Longitude' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'Longitude' && sortReverse" class="fa fa-caret-up"></span>
						  </a>


						 </th>
                        <th >
						<a href="javascript:void(0)" ng-click="sortType = 'Region'; sortReverse = !sortReverse">
							Region
							<span ng-show="sortType == 'Region' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'Region' && sortReverse" class="fa fa-caret-up"></span>
						  </a>

						</th>

                        <th>
												<a href="javascript:void(0)" ng-click="sortType = 'City'; sortReverse = !sortReverse">
							City
							<span ng-show="sortType == 'City' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'City' && sortReverse" class="fa fa-caret-up"></span>
						  </a>


						</th>
                        <th>
						<a href="javascript:void(0)" ng-click="sortType = 'Country'; sortReverse = !sortReverse">
							Country
							<span ng-show="sortType == 'Country' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'Country' && sortReverse" class="fa fa-caret-up"></span>
						  </a>


						</th>
                        <th>
												<a href="javascript:void(0)" ng-click="sortType = 'SubCountry'; sortReverse = !sortReverse">
							SubCountry
							<span ng-show="sortType == 'SubCountry' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'SubCountry' && sortReverse" class="fa fa-caret-up"></span>
						  </a>


						</th>
                        <th>
						  <a href="javascript:void(0)" ng-click="sortType = 'active'; sortReverse = !sortReverse">
							Active
							<span ng-show="sortType == 'active' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'active' && sortReverse" class="fa fa-caret-up"></span>
						  </a>
						</th>

						<th>
						  <a href="javascript:void(0);" ng-click="sortType = 'type'; sortReverse = !sortReverse">
							Type
							<span ng-show="sortType == 'type' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'type' && sortReverse" class="fa fa-caret-up"></span>
						  </a>
						</th>

						<th>
						  <a href="javascript:void(0);" ng-click="sortType = 'createdAt'; sortReverse = !sortReverse">
							Created At
							<span ng-show="sortType == 'createdAt' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'createdAt' && sortReverse" class="fa fa-caret-up"></span>
						  </a>
						</th>

						<th>
						  <a href="javascript:void(0);" ng-click="sortType = 'updatedAt'; sortReverse = !sortReverse">
							Updated At
							<span ng-show="sortType == 'updatedAt' && !sortReverse" class="fa fa-caret-down"></span>
							<span ng-show="sortType == 'updatedAt' && sortReverse" class="fa fa-caret-up"></span>
						  </a>
						</th>

						<th> &nbsp; </th>

                    </tr>
                      </thead>
                      <tbody>


                    <tr ng-repeat="geoname in geonames.records | orderBy:sortType:sortReverse | filter:searchTerm">
                        <td>
							{{$index+1}}.
                        </td>
                        <td>
                            {{geoname.CountryCode}}
                        </td>
                        <td>
                            {{geoname.PostalCode}}
                        </td>
                        <td>
                            {{geoname.Latitude}}
                        </td>
                        <td>
                            {{geoname.Longitude}}
                        </td>

						<td>
                            {{geoname.Region}}
                        </td>
                        <td>
                            {{geoname.City}}
                        </td>

                        <td>
                            {{geoname.Country}}
                        </td>
                        <td>
                            {{geoname.SubCountry}}
                        </td>
						 <td>
                            {{geoname.active}}
                        </td>


						<td>
                            geolocation
                        </td>
                        <td>
                            {{geoname.createdAt | date:'d/M/yy HH:mm':'+0000'}}
                        </td>
						 <td>
                            {{geoname.updatedAt | date:'d/M/yy HH:mm':'+0000'}}
                        </td>


						<td>
                            <button role="button" ng-click="editGeoname(geoname);" class="btn btn-success">Edit</button>
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
       app.controller('myCtrl', function($scope, $http, $httpParamSerializer) {

		  $scope.initId='<?php echo $_GET["id"] ?>';

		      $scope.sortType     = 'active';
			  $scope.sortReverse  = true;
			  $scope.searchTerm   = '';



		  $scope.geonames = {};

		  // $scope.geonames = {
			// "records": [
				// {
					// "CountryCode": "Russia",
					// "PostalCode": "101773",
					// "Latitude": 55.7522,
					// "Longitude": 37.6155556,
					// "Region": "Москва",
					// "City": "Москва-дти",
					// "Country": "Russia",
					// "SubCountry": "",
					// "active": false,
					// "id": "5ab24577562f327f8f5f046e",
					// "createdAt": "2018-03-21T11:43:51.714Z",
					// "updatedAt": "2018-03-21T11:43:51.714Z"
				// },
				// {
					// "CountryCode": "Russia",
					// "PostalCode": "101773",
					// "Latitude": 55.7522,
					// "Longitude": 37.6156,
					// "Region": "Москва",
					// "City": "Москва-дти",
					// "Country": "Russia",
					// "SubCountry": "",
					// "active": false,
					// "id": "5ab243cb562f327f8f5f046c",
					// "createdAt": "2018-03-21T11:36:43.616Z",
					// "updatedAt": "2018-03-21T11:36:43.616Z"
				// },
				// {
					// "CountryCode": "United Kingdom",
					// "PostalCode": "DG1 1HF",
					// "Latitude": 0,
					// "Longitude": 0,
					// "Region": "Dumfries and galloway",
					// "City": "Dumfries",
					// "Country": "",
					// "SubCountry": "",
					// "active": true,
					// "id": "5ab138e27a0d00612031b5b5",
					// "createdAt": "2018-03-20T16:37:54.623Z",
					// "updatedAt": "2018-03-20T16:37:54.623Z"
				// },
								// {
					// "CountryCode": "United Kingdom",
					// "PostalCode": "DG1 1HF",
					// "Latitude": 0,
					// "Longitude": 0,
					// "Region": "Dumfries and galloway",
					// "City": "Dumfries",
					// "Country": "",
					// "SubCountry": "",
					// "active": false,
					// "id": "5ab138e27a0d00612031b5b5",
					// "createdAt": "2018-03-19T16:37:54.623Z",
					// "updatedAt": "2018-03-20T12:37:54.623Z"
				// },
				// {
					// "CountryCode": "UK",
					// "PostalCode": "DG1 3QH",
					// "Latitude": 0,
					// "Longitude": 0,
					// "City": "dumfries",
					// "active": false,
					// "id": "5ab12717a535c23d9713b4d0",
					// "createdAt": "2018-03-20T15:21:59.800Z",
					// "updatedAt": "2018-03-20T15:21:59.800Z"
				// },
				// {
					// "CountryCode": "UK",
					// "PostalCode": "DG1 3QH",
					// "Latitude": 0,
					// "Longitude": 0,
					// "City": "Dumfries",
					// "active": false,
					// "id": "5ab1263fa535c23d9713b4cb",
					// "createdAt": "2018-03-20T15:18:23.928Z",
					// "updatedAt": "2018-03-20T15:18:23.928Z"
				// }
			// ],
			// "count": 5
		// };

		  $scope.selGeoname;
		  $scope.editGeoname = function(geoname){
			  $scope.selGeoname = geoname;
		  };
		  $scope.backToList = function(){
			  $scope.selGeoname = undefined;
		  };


		  	// ---------------------------------
			$scope.submit = 'Submit Changes';

		  	$scope.submitChanges = function(){

				// CountryCode 		formData 	string
				// PostalCode 			formData 	string
				// Latitude 			formData 	double
				// Longitude 			formData 	double

			$http({
			    withCredentials: true,
				method : "PUT",
				url : "https://netapi.danderdee.com/api/geonames/"+$scope.selGeoname.id,
				headers : {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				withCredentials: true,
				data : $httpParamSerializer($scope.selGeoname)
			}).then(function mySucces(response) {
				$scope.error = 'Geoname Changed Successfully';
				$scope.submit = 'Submit Changes';
				$scope.isDisabled = false;
				//location.replace(location.protocol +'//'+location.hostname +'/cp/device/create.php');
				$scope.selGeoname = undefined;

				$scope.getGeonamesList();

			}, function myError(response) {
				$scope.error = 'Something went wrong';
				$scope.submit = 'Submit Changes';
				$scope.isDisabled = false;
			});
		  };

		  // ---------------------------------
		  $scope.approve = 'Approve Changes';

		  $scope.approveChanges = function(){
				// CountryCode 		formData 	string
				// PostalCode 			formData 	string
				// Latitude 			formData 	double
				// Longitude 			formData 	double

			$http({
			    withCredentials: true,
				method : "PUT",
				url : "https://netapi.danderdee.com/api/geonames/activate/"+$scope.selGeoname.id,
				headers : { 'Content-Type': 'application/x-www-form-urlencoded' },
				withCredentials: true,
				data : $httpParamSerializer($scope.selGeoname)
			}).then(function mySucces(response) {
				$scope.error = 'Geoname Approved Successfully';
				$scope.approve = 'Approve Changes';
				$scope.isDisabled = false;
				//location.replace(location.protocol +'//'+location.hostname +'/cp/device/create.php');
				$scope.selGeoname = undefined;

				$scope.getGeonamesList();

			}, function myError(response) {
				$scope.error = 'Something went wrong';
				$scope.approve = 'Approve Changes';
				$scope.isDisabled = false;
			});
		  };

		  // ---------------------------------


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


			   $scope.setInitSelected = function(){

					if($scope.initId && $scope.geonames.records.length>0){

						for(var i=0;i<$scope.geonames.records.length;i++){

							if($scope.geonames.records[i].id==$scope.initId){
								$scope.selGeoname =$scope.geonames.records[i];
								$scope.initId = '';
								break;
							}
						}
					}
			   };


			   	// $scope.sortGeonames = function(){

					// if($scope.geonames.records.length>0){

						// for(var i=0;i<$scope.geonames.records.length;i++){
							// //new Date("2018-03-21T11:43:51.714Z").getTime()
								// $scope.geonames.records[i].createdAtSort = new Date($scope.geonames.records[i].createdAt).getTime();
								// $scope.geonames.records[i].updatedAtSort = new Date($scope.geonames.records[i].updatedAt).getTime();

						// }
					// }
			   // };
			   // $scope.sortGeonames();

			   //$scope.setInitSelected();


				$scope.getGeonamesList = function(){
					$http({
						   method : "GET",
						   url : "https://netapi.danderdee.com/api/geonames",
						   withCredentials: true
					   }).then(function mySucces(response) {
						   //console.log(response);

						   $scope.geonames = response;

							$scope.setInitSelected();

						   // var count = 1;
						   // $('#location-list tbody').html('');
						   // $.each(response.data, function(i,val){
							   // var $el = $("" +
							   // '<tr><td>' + count++ + '</td>' +
							   // '<td>' + val.string_id + '</td>' +
							   // '<td>' + val.notes + '</td>' +
							   // '<td>' + val.address + '</td>' +
							   // '<td>' + val.locationKey + '</td>' +
							   // '<td>' + val.lng + '</td>' +
							   // '<td>' + val.lat + '</td>' +
							   // '<td><a href="edit.php?id=' + val._id + '" class="btn btn-success col-xs-12">Edit</a></td>' +

							   // '</tr>').appendTo('#location-list tbody');
						   // });


					   }, function myError(response) {
						   $scope.error = 'Error fetching data';
					   });
				};

				$scope.getGeonamesList();

       });
       angular.bootstrap(document.getElementById("myApp"), ['myApp']);
</script>
<?php include('../includes/footer.php'); ?>
