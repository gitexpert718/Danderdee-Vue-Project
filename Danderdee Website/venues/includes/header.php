<?php
//$server = $_SERVER['DOCUMENT_ROOT'] . '/cp';
//DEFINE('SERVER', '/venues/');
 DEFINE('SERVER', 'https://netapi.danderdee.com/venues');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo SERVER ?>/css/style.css">
        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/plugins/iCheck/flat/blue.css">
        <!--     Morris chart
            <link rel="stylesheet" href="/plugins/morris/morris.css">-->
        <!--     jvectormap  -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo SERVER ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="../https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="../https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery 2.1.4 -->
        <script type="text/javascript" src="<?php echo SERVER ?>/js/jquery-1.11.2.min.js"></script>

        <script type="text/javascript" src="<?php echo SERVER ?>/js/angular.min.js"></script> 
        <script>
            var app = angular.module('signOutApp', []);
            app.controller('signOutCtrl', function ($scope, $http) {
                $scope.signOut = function () {
                    $http({
                        method: "GET",
                        url: "https://netapi.danderdee.com/api/auth/signout"
                    }).then(function mySucces(response) {
                        window.location.href = 'login.html';
                    }, function myError(response) {
                        alert("There was a problem. Please try to sign out again");
                    });
                }
            });
        </script>

    </head>

    <body class="skin-blue sidebar-mini">


        <!-- Site wrapper -->
        <div class="wrapper">
