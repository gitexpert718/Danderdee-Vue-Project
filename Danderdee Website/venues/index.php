<?php
// session_start();
// $class = '';
// if (isset($_SESSION['role']) && $_SESSION['role'] != "") {
//
//     $class = 'role';
// }

 include('includes/header.php');  

 include('includes/sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php include('includes/nav-header.php'); ?>
   <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard - My Profile
        </h1>
    </section>
    <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
        <div class="row">
            <div class="col-xs-12">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center" ng-bind-html="user.name"></h3>
                        <p class="profile-email text-muted text-center" ng-bind-html="user.email">shayasmk@gmail.com</p>
                        <p class="profile-number text-muted text-center" ng-bind-html="user.phone">+919946005652</p>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i>  Username</strong>
                        <p class="text-muted" ng-bind-html="user.username">

                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                        <p class="text-muted" ng-bind-html="user.address">P T HOUSE, KATTAKAL, P O KALANAD, KASARAGOD, KASARAGOD</p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Age</strong>
                        <p class="text-muted" ng-bind-html="user.age">25</p>

                        <hr>

                        <strong><i class="fa fa-circle margin-r-5"></i> Gender</strong>
                        <p ng-bind-html="user.gender">Male</p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </section>
</div>
<script>
    var app = angular.module('myApp', []);
    app.controller('myCtrl', function ($scope, $http, $sce) {
        $scope.user = {};
        $scope.error = ' ';


        $http({
            withCredentials: true,
            method: "GET",
            url: "https://netapi.danderdee.com/api/users/me"

        }).then(function mySucces(response) {

            if (response.status == 200)
            {
                console.log(response);

                $scope.user.username = $sce.trustAsHtml(response.data.username || '');
                $scope.user.email = $sce.trustAsHtml(response.data.email || '');
                $scope.user.phone = $sce.trustAsHtml(response.data.phoneNumber || '');
                $scope.user.name = $sce.trustAsHtml((response.data.firstName + response.data.lastName) || '');
                $scope.user.address = $sce.trustAsHtml(response.data.address || '');
                $scope.user.age = $sce.trustAsHtml(response.data.age || '');
                $scope.user.gender = $sce.trustAsHtml(response.data.gender || '');

                $(response.data).each(function (i, val) {

                    var role = val.accountType[0];
                    $http({
                        method: "POST",
                        url: "insert.php",
                        data: {"role": role}
                    }).then(function mySuccess(response) {
                        console.log(response.data);
                    });
                    //'admin''light_admin', 'user', 'light_user'va

                    //role = 'light_admin';

                    if (role != "admin" && role != "light_admin" && role != "user" && role != "light_user") {
                        $('#nav_area').css('display', 'none');
                        $('#nav_categories').css('display', 'none');
                        $('#nav_business').css('display', 'none');
                        $('#nav_device').css('display', 'none');
                        $('#nav_location').css('display', 'none');
                    }

                    if (role != "admin" && role != "light_admin" && role != "wifi_user") {

                        $('#nav_classified').css('display', 'none');
                    }

                    if (role != "admin") {

                        $('#nav_hardware').css('display', 'none');
                        $('#nav_space').css('display', 'none');
                        $('#nav_space_templates').css('display', 'none');
                        $('#nav_templates').css('display', 'none');
                    }

                    $('#username').text(val.username);

                });
            }
        }, function myError(response) {
            $scope.error = 'Error fetching data';
        });
    });
    angular.bootstrap(document.getElementById("myApp"), ['myApp']);
</script>

<?php

//$path = $_SERVER['DOCUMENT_ROOT'];
//   $path .= "/projects/netapi-cp/netapi-cp-latest/includes/footer.php";
//   include_once($path);

 include('includes/footer.php'); 
 
 ?>
