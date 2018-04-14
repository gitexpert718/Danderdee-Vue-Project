<?php

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
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Location</a></li>
            <li class="active">Create</li>
          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Location</h3>
                            <p class="error">{{error}}</p>
                        </div><!-- /.box-header -->
                      <!-- form start -->
                        <form role='form' name="myForm" ng-submit="create()">
                            <div class="box-body">
                                <div class="form-group">
                                    <input ng-required="requireInputs"id="locationid" type="text" class="form-control" placeholder="Location ID" ng-model="user.string_id">
                                    <label for="locationid">ID</label>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="notes" placeholder="Notes" ng-model="user.notes"></textarea>
                                    <label for="notes">Notes</label>
                                </div>

								<div class="form-group">
                                    <select class="form-control" placeholder="Country" ng-model="user.country"
                                    <label>Country</label>
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
                                    <input type="text" id="longitude" class="form-control" placeholder="Longitude" ng-model="user.lng">
                                    <label for="longitude">Longitude</label>
                                </div>
                                <div class="form-group hide">
                                    <textarea class="form-control" id="latitude" placeholder="Latitude" ng-model="user.lat"></textarea>
                                    <label for="latitude">Latitude</label>
                                </div>
                            </div><!-- /.box-body -->


                            <div class="box-footer">

								<div ng-if="intervalPromise.$$state.status==0"
									style="display:none;" id="yellowAlert"
									class="alert alert-warning alert-dismissible fade in">
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

					$("#yellowAlert").show();


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
                    $scope.submit = 'Create Location';

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


						if(!!$scope.postToGeonames){

							console.log("posting to geonames");
							stopCountdown($scope.intervalPromise);


							var postData = {
								CountryCode: $scope.user.country,
								PostalCode: $scope.user.postCode,
								Latitude: $scope.user.lat,
								Longitude: $scope.user.lng,
								Region: $scope.user.region,
								City: $scope.user.city,
								Country: $scope.user.country,
								SubCountry: '',
							};


							$scope.isDisabled = true;
							$scope.disabling = 'disabled';
							$scope.submit = 'Submitting data';
							$scope.error = 'Submitting data........';
							$http({
								method : "POST",
								url : "https://netapi.danderdee.com/api/geonames",
								headers : {
									'Content-Type': 'application/x-www-form-urlencoded'
								},
								withCredentials: true,
								data : $httpParamSerializer(postData)
							}).then(function mySucces(response) {
								$scope.error = 'Geoname Added Successfully';
								$scope.submit = 'Submit';
								$scope.isDisabled = false;
								location.replace(location.protocol +'//'+location.hostname +'/cp/device/create.php');

							}, function myError(response) {
								$scope.error = 'Something went wrong';
								$scope.submit = 'Create Geoname';
								$scope.isDisabled = false;
							});


						}else{
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
								//$scope.submit = 'Create Location';
								$scope.submit = 'Accept Location Data';


								$scope.intervalPromise = startCountdown();
								$scope.postToGeonames = true;

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


							}, function myError(response) {
								$scope.error = 'Something went wrong';
								$scope.submit = 'Create Location';
								$scope.isDisabled = false;
							});
						}
                    };



					$scope.freegeoipData = {};
					$http({
                            method : "GET",
                            url : "https://freegeoip.net/json/",
                        }).then(function successCallback(response) {
							//console.log("freegeoip success", response);
                            $scope.freegeoipData = response.data;
							for(var i=0;i<$scope.countries.length;i++){
								if($scope.countries[i][0] == response.data.country_code){
									$scope.user.country = $scope.countries[i][1];
									//$scope.user.locationKey = response.data.region_code;
									$scope.user.address = response.data.city;
									$scope.user.postCode = response.data.zip_code;
									$scope.user.lng = response.data.longitude;
									$scope.user.lat = response.data.latitude;

									break;
								}
							}


                        }, function errorCallback(response) {
							console.log("freegeoip error", response);
                    });


                });
                angular.bootstrap(document.getElementById("myApp"), ['myApp']);
        </script>
<?php include('../includes/footer.php'); ?>
