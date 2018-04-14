<?php
//
// session_start();
//
// $white_list = ['admin', 'light_admin', 'user', 'light_user'];
//
// if(!in_array($_SESSION['role'], $white_list)){
//   header('Location: ../index.php');
//  die();
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
            Location
            <small>Edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Location</a></li>
            <li class="active">Edit</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Location</h3>
                            <p class="error">{{error}}</p>
                        </div><!-- /.box-header -->
                      <!-- form start -->
                        <form role='form' name="myForm" ng-submit="create()">
                            <div class="box-body">
                                <div class="form-group">
                                    <input ng-required="requireInputs" id="locationId" type="text" class="form-control" placeholder="Location ID" ng-model="user.string_id">
                                    <label for="locationId">ID</label>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="notes" placeholder="Notes" ng-model="user.notes"></textarea>
                                    <label for="notes">Notes</label>
                                </div>

								<div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" placeholder="Country" ng-model="user.country"
									 ng-options="c[1] as c[1] for c in countries">
									</select>
                                </div>

                                <div class="form-group">
                                    <textarea  ng-required="requireInputs" id="address" class="form-control" ng-required="requireInputs" placeholder="Address" ng-model="user.address"></textarea>
                                    <label for="address">Address</label>
                                </div>
                                <div class="form-group hide">
                                    <input type="text" id="locationKey" class="form-control" placeholder="Location key" ng-model="user.locationKey">
                                    <label for="locationKey">Location key</label>
                                </div>
                                <div class="form-group">
                                    <label >Location Type</label>
									<select  ng-required="requireInputs" class="form-control" placeholder="Location Type" ng-model="user.locationType"
									 ng-options="ltype as ltype for ltype in locationTypes">
									</select>
                                </div>
                                <div class="form-group">
                                    <input  ng-required="requireInputs" id="postCode" type="text" class="form-control" ng-required="requireInputs" placeholder="Post Code" ng-model="user.postCode">
                                    <label for="postCode">Post Code</label>
                                </div>
                                <div class="form-group hide">
                                    <input type="text" id="Longitude" class="form-control" placeholder="Longitude" ng-model="user.lng">
                                    <label for="Longitude">Longitude</label>
                                </div>
                                <div class="form-group hide">
                                    <textarea class="form-control" id="Latitude" placeholder="Latitude" ng-model="user.lat"></textarea>
                                    <label for="Latitude">Latitude</label>
                                </div>
                            </div><!-- /.box-body -->


                            <div class="box-footer">

								<div ng-if="intervalPromise.$$state.status==0" class="alert alert-warning alert-dismissible fade in">
									<a href="javascript:void(0)" class="close" ng-click="reviseChanges()" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Please, revise the data and confirm.
									<br />
									If no action is taken, you'll be redirected to the Create Device page.
									<br />
									Redirect in: {{redirectCountdown}}
									<br />
									<button type="button" class="btn btn-danger" ng-click="reviseChanges()">Revise changes</button>
								</div>


                              <button type="submit" class="btn btn-primary submit-button"
							    ng-disabled="!myForm.$valid && isDisabled">{{submit}}</button>
                              <button ng-click="onFormReset()" type="reset" class="btn btn-default">Reset</button>
                            </div>


                        </form>
                    </div><!-- /.box -->



                </div><!--/.col (left) -->
            </div>

        </section>

</div>
<script>

            var app = angular.module('myApp', []);
                app.controller('myCtrl', function($scope, $http, $httpParamSerializer, $interval) {

					var initLocationId='<?php echo $_GET["id"] ?>';

					$scope.redirectCountdown = 10;
					$scope.intervalPromise;
					$scope.postToGeonames = false;

					$scope.onFormReset = function(){
						if(!!$scope.intervalPromise){
							stopCountdown($scope.intervalPromise);
						}
					};

					var startCountdown = function(){

						var intervalPromise = $interval(function(){
						if($scope.redirectCountdown > 0){
							$scope.redirectCountdown--;
						} else {
							$interval.cancel(intervalPromise);
							console.log("redirect!");
							//window.location.href = '/cp/device/create.html';
						}

						}, 1000);
						return intervalPromise;
					};

					var stopCountdown = function(intervalPromise){
						$interval.cancel(intervalPromise);
						$scope.redirectCountdown = 10;
					};
					$scope.reviseChanges = function(){
						stopCountdown($scope.intervalPromise);
					};

					$scope.requireInputs = true;
					$scope.loc = {};

					$scope.locationTypes = [
						'Business','Public'
					];

					$scope.user = {};

					if(typeof $scope.user.locationType == "unedfined" || !$scope.user.locationType){
						$scope.user.locationType ='Business';
					}


					$scope.countries = [
							["A1","Anonymous Proxy"],
							["A2","Satellite Provider"],
							["O1","Other Country"],
							["AD","Andorra"],
							["AE","United Arab Emirates"],
							["AF","Afghanistan"],
							["AG","Antigua and Barbuda"],
							["AI","Anguilla"],
							["AL","Albania"],
							["AM","Armenia"],
							["AO","Angola"],
							["AP","Asia/Pacific Region"],
							["AQ","Antarctica"],
							["AR","Argentina"],
							["AS","American Samoa"],
							["AT","Austria"],
							["AU","Australia"],
							["AW","Aruba"],
							["AX","Aland Islands"],
							["AZ","Azerbaijan"],
							["BA","Bosnia and Herzegovina"],
							["BB","Barbados"],
							["BD","Bangladesh"],
							["BE","Belgium"],
							["BF","Burkina Faso"],
							["BG","Bulgaria"],
							["BH","Bahrain"],
							["BI","Burundi"],
							["BJ","Benin"],
							["BL","Saint Bartelemey"],
							["BM","Bermuda"],
							["BN","Brunei Darussalam"],
							["BO","Bolivia"],
							["BQ","Bonaire, Saint Eustatius and Saba"],
							["BR","Brazil"],
							["BS","Bahamas"],
							["BT","Bhutan"],
							["BV","Bouvet Island"],
							["BW","Botswana"],
							["BY","Belarus"],
							["BZ","Belize"],
							["CA","Canada"],
							["CC","Cocos (Keeling) Islands"],
							["CD","Congo, The Democratic Republic of the"],
							["CF","Central African Republic"],
							["CG","Congo"],
							["CH","Switzerland"],
							["CI","Cote d'Ivoire"],
							["CK","Cook Islands"],
							["CL","Chile"],
							["CM","Cameroon"],
							["CN","China"],
							["CO","Colombia"],
							["CR","Costa Rica"],
							["CU","Cuba"],
							["CV","Cape Verde"],
							["CW","Curacao"],
							["CX","Christmas Island"],
							["CY","Cyprus"],
							["CZ","Czech Republic"],
							["DE","Germany"],
							["DJ","Djibouti"],
							["DK","Denmark"],
							["DM","Dominica"],
							["DO","Dominican Republic"],
							["DZ","Algeria"],
							["EC","Ecuador"],
							["EE","Estonia"],
							["EG","Egypt"],
							["EH","Western Sahara"],
							["ER","Eritrea"],
							["ES","Spain"],
							["ET","Ethiopia"],
							["EU","Europe"],
							["FI","Finland"],
							["FJ","Fiji"],
							["FK","Falkland Islands (Malvinas)"],
							["FM","Micronesia, Federated States of"],
							["FO","Faroe Islands"],
							["FR","France"],
							["GA","Gabon"],
							["GB","United Kingdom"],
							["GD","Grenada"],
							["GE","Georgia"],
							["GF","French Guiana"],
							["GG","Guernsey"],
							["GH","Ghana"],
							["GI","Gibraltar"],
							["GL","Greenland"],
							["GM","Gambia"],
							["GN","Guinea"],
							["GP","Guadeloupe"],
							["GQ","Equatorial Guinea"],
							["GR","Greece"],
							["GS","South Georgia and the South Sandwich Islands"],
							["GT","Guatemala"],
							["GU","Guam"],
							["GW","Guinea-Bissau"],
							["GY","Guyana"],
							["HK","Hong Kong"],
							["HM","Heard Island and McDonald Islands"],
							["HN","Honduras"],
							["HR","Croatia"],
							["HT","Haiti"],
							["HU","Hungary"],
							["ID","Indonesia"],
							["IE","Ireland"],
							["IL","Israel"],
							["IM","Isle of Man"],
							["IN","India"],
							["IO","British Indian Ocean Territory"],
							["IQ","Iraq"],
							["IR","Iran, Islamic Republic of"],
							["IS","Iceland"],
							["IT","Italy"],
							["JE","Jersey"],
							["JM","Jamaica"],
							["JO","Jordan"],
							["JP","Japan"],
							["KE","Kenya"],
							["KG","Kyrgyzstan"],
							["KH","Cambodia"],
							["KI","Kiribati"],
							["KM","Comoros"],
							["KN","Saint Kitts and Nevis"],
							["KP","Korea, Democratic People's Republic of"],
							["KR","Korea, Republic of"],
							["KW","Kuwait"],
							["KY","Cayman Islands"],
							["KZ","Kazakhstan"],
							["LA","Lao People's Democratic Republic"],
							["LB","Lebanon"],
							["LC","Saint Lucia"],
							["LI","Liechtenstein"],
							["LK","Sri Lanka"],
							["LR","Liberia"],
							["LS","Lesotho"],
							["LT","Lithuania"],
							["LU","Luxembourg"],
							["LV","Latvia"],
							["LY","Libyan Arab Jamahiriya"],
							["MA","Morocco"],
							["MC","Monaco"],
							["MD","Moldova, Republic of"],
							["ME","Montenegro"],
							["MF","Saint Martin"],
							["MG","Madagascar"],
							["MH","Marshall Islands"],
							["MK","Macedonia"],
							["ML","Mali"],
							["MM","Myanmar"],
							["MN","Mongolia"],
							["MO","Macao"],
							["MP","Northern Mariana Islands"],
							["MQ","Martinique"],
							["MR","Mauritania"],
							["MS","Montserrat"],
							["MT","Malta"],
							["MU","Mauritius"],
							["MV","Maldives"],
							["MW","Malawi"],
							["MX","Mexico"],
							["MY","Malaysia"],
							["MZ","Mozambique"],
							["NA","Namibia"],
							["NC","New Caledonia"],
							["NE","Niger"],
							["NF","Norfolk Island"],
							["NG","Nigeria"],
							["NI","Nicaragua"],
							["NL","Netherlands"],
							["NO","Norway"],
							["NP","Nepal"],
							["NR","Nauru"],
							["NU","Niue"],
							["NZ","New Zealand"],
							["OM","Oman"],
							["PA","Panama"],
							["PE","Peru"],
							["PF","French Polynesia"],
							["PG","Papua New Guinea"],
							["PH","Philippines"],
							["PK","Pakistan"],
							["PL","Poland"],
							["PM","Saint Pierre and Miquelon"],
							["PN","Pitcairn"],
							["PR","Puerto Rico"],
							["PS","Palestinian Territory"],
							["PT","Portugal"],
							["PW","Palau"],
							["PY","Paraguay"],
							["QA","Qatar"],
							["RE","Reunion"],
							["RO","Romania"],
							["RS","Serbia"],
							["RU","Russia"],
							["RW","Rwanda"],
							["SA","Saudi Arabia"],
							["SB","Solomon Islands"],
							["SC","Seychelles"],
							["SD","Sudan"],
							["SE","Sweden"],
							["SG","Singapore"],
							["SH","Saint Helena"],
							["SI","Slovenia"],
							["SJ","Svalbard and Jan Mayen"],
							["SK","Slovakia"],
							["SL","Sierra Leone"],
							["SM","San Marino"],
							["SN","Senegal"],
							["SO","Somalia"],
							["SR","Suriname"],
							["SS","South Sudan"],
							["ST","Sao Tome and Principe"],
							["SV","El Salvador"],
							["SX","Sint Maarten"],
							["SY","Syrian Arab Republic"],
							["SZ","Swaziland"],
							["TC","Turks and Caicos Islands"],
							["TD","Chad"],
							["TF","French Southern Territories"],
							["TG","Togo"],
							["TH","Thailand"],
							["TJ","Tajikistan"],
							["TK","Tokelau"],
							["TL","Timor-Leste"],
							["TM","Turkmenistan"],
							["TN","Tunisia"],
							["TO","Tonga"],
							["TR","Turkey"],
							["TT","Trinidad and Tobago"],
							["TV","Tuvalu"],
							["TW","Taiwan"],
							["TZ","Tanzania, United Republic of"],
							["UA","Ukraine"],
							["UG","Uganda"],
							["UM","United States Minor Outlying Islands"],
							["US","United States"],
							["UY","Uruguay"],
							["UZ","Uzbekistan"],
							["VA","Holy See (Vatican City State)"],
							["VC","Saint Vincent and the Grenadines"],
							["VE","Venezuela"],
							["VG","Virgin Islands, British"],
							["VI","Virgin Islands, U.S."],
							["VN","Vietnam"],
							["VU","Vanuatu"],
							["WF","Wallis and Futuna"],
							["WS","Samoa"],
							["YE","Yemen"],
							["YT","Mayotte"],
							["ZA","South Africa"],
							["ZM","Zambia"],
							["ZW","Zimbabwe"]
					];




                    $scope.isDisabled = false;
                    $scope.submit = 'Update Location';

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

                    $scope.create = function() {


							//$scope.intervalPromise = startCountdown();
							//$scope.postToGeonames = true;

						$scope.isDisabled = true;
						$scope.disabling = 'disabled';
						$scope.submit = 'Submitting data';
						$scope.error = 'Submitting data........';
						$http({
							method : "POST",
							url : "https://netapi.danderdee.com/api/locations",
							headers : {
								'Content-Type': 'application/x-www-form-urlencoded'
							},
							withCredentials: true,
							data : $httpParamSerializer($scope.user)
						}).then(function mySucces(response) {
							$scope.error = 'Location Added Successfully';
							//$scope.submit = 'Update Location';
							$scope.submit = 'Accept Location Data';


							//$scope.intervalPromise = startCountdown();
							//$scope.postToGeonames = true;

							$scope.isDisabled = false;


							$scope.user.country = response.data.country;

							$scope.user.address = response.data.city;
							$scope.user.postCode = response.data.zip_code;
							$scope.user.lng = response.data.lng;
							$scope.user.lat = response.data.lat;

							$scope.user.city = response.data.city;
							$scope.user.region = response.data.region;
							$scope.user.locationKey = response.data.locationKey;

							$scope.user.stringId = response.data.string_id;

							$scope.user.address = response.data.address;
							$scope.user.locationType = response.data.locationType;
							$scope.user.postCode = response.data.postCode;

							location.replace(location.protocol +'//'+location.hostname +'/cp/index.php');
						}, function myError(response) {
							$scope.error = 'Something went wrong';
							$scope.submit = 'Update Location';
							$scope.isDisabled = false;
						});

                    };


					var findSelectedLocation = function(){
							for(var i=0;i<$scope.locations.length;i++){
								if($scope.locations[i]._id==initLocationId){
									$scope.user.country = $scope.locations[i].country;
									$scope.user.city = $scope.locations[i].city;
									$scope.user.region = $scope.locations[i].region;

									$scope.user.locationKey = $scope.locations[i].locationKey;
									$scope.user.locationId = $scope.locations[i].locationKey;
									$scope.loc.locationId = $scope.locations[i].locationKey;

									$scope.user.address = $scope.locations[i].address;
									$scope.user.postCode = $scope.locations[i].postCode;

									$scope.user.locationType = $scope.locations[i].locationType;

									$scope.user.string_id = $scope.locations[i].string_id;

									$scope.user.notes = $scope.locations[i].notes;
									$scope.user.lng = $scope.locations[i].lng;
									$scope.user.lat = $scope.locations[i].lat;

									break;
								}
							}
					};

					$http({
                            method : "GET",
                            url : "https://netapi.danderdee.com/api/locations",
							withCredentials: true
                        }).then(function successCallback(response) {
                            $scope.locations = response.data;

							findSelectedLocation();

                        }, function errorCallback(response) {

							// $scope.locations =
							// [
									// {
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
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab1f94f7a0d00612031b5cc",
										// "country": "Poland",
										// "lng": 20.886118737639,
										// "lat": 52.410386132099845,
										// "city": "Chotomów",
										// "region": "Mazovia",
										// "locationKey": "jiuH2AHuMcO5g6xIiJqYtQ==",
										// "string_id": "qwe",
										// "address": "qwe",
										// "locationType": "Public",
										// "postCode": "123",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab2172b7a0d00612031b5cd",
										// "city": "Москва-Дти",
										// "region": "Москва",
										// "locationKey": "N46Idk9Hwu2kjkEAn0BM+A==",
										// "address": "MSK",
										// "country": "Russia",
										// "lat": 55.7522,
										// "lng": 37.6156,
										// "locationType": "Public",
										// "notes": "notes notes",
										// "postCode": "101773",
										// "string_id": "test4",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab22481c0a1b97e86bc0d4c",
										// "city": "Москва-Дти",
										// "region": "Москва",
										// "locationKey": "1sKLU7JXN69zzyxvAREwrw==",
										// "address": "MSK",
										// "country": "Russia",
										// "lat": 55.7522,
										// "lng": 37.6156,
										// "locationType": "Public",
										// "notes": "notes notes",
										// "postCode": "101773",
										// "string_id": "test4",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab2306b562f327f8f5f0469",
										// "country": "Poland",
										// "lng": 20.886118737639,
										// "lat": 52.410386132099845,
										// "city": "Chotomów",
										// "region": "Mazovia",
										// "locationKey": "Sblmvf3gQk8xvuv/iW3lxQ==",
										// "string_id": "qwe2",
										// "address": "qwe",
										// "locationType": "Business",
										// "postCode": "123",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab2316c562f327f8f5f046a",
										// "city": "Москва-Дти",
										// "region": "Москва",
										// "locationKey": "tQKgPQujmiZHe1GSFDCESg==",
										// "address": "MSK",
										// "country": "Russia",
										// "lat": 55.7522,
										// "lng": 37.6156,
										// "locationType": "Public",
										// "notes": "notes notes",
										// "postCode": "101773",
										// "string_id": "test4",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab243c2562f327f8f5f046b",
										// "city": "Москва-Дти",
										// "region": "Москва",
										// "locationKey": "s1ytaJ5uiFKXgYR2YFYowg==",
										// "address": "Moscow",
										// "country": "Russia",
										// "lat": 55.7522,
										// "lng": 37.6156,
										// "locationType": "Business",
										// "notes": "asd",
										// "postCode": "101773",
										// "string_id": "qwe",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab24573562f327f8f5f046d",
										// "city": "Москва-Дти",
										// "region": "Москва",
										// "locationKey": "2HKyQTJ6+ei63TK3q+ZrVg==",
										// "address": "mmm",
										// "country": "Russia",
										// "lat": 55.7522,
										// "lng": 37.6155556,
										// "locationType": "Public",
										// "postCode": "101773",
										// "string_id": "qweqwe3",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// },
									// {
										// "_id": "5ab2b22b562f327f8f5f047e",
										// "city": "Москва-Дти",
										// "region": "Москва",
										// "locationKey": "djW8redSuWlFoHVDmwiv0A==",
										// "address": "MSK",
										// "country": "Russia",
										// "lat": 55.7522,
										// "lng": 37.6156,
										// "locationType": "Public",
										// "notes": "notes notes",
										// "postCode": "101773",
										// "string_id": "test4",
										// "__v": 1,
										// "users": [
											// "5a8c8d962ce61414ca3d1e80"
										// ]
									// }
								// ];

							// findSelectedLocation();

							console.log("locations fetch error", response);
                    });

                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
