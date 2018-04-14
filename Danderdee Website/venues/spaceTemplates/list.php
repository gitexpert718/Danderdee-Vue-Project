<?php
//
// session_start();
//
// $white_list = 'admin';
// if($_SESSION['role'] != $white_list){
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
            Space Templates
            <small>Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Space Templates</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
        <div class="row">
            <div class="col-xs-12 ">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Space Templates</h3>
                        <p class="error">{{error}}</p>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered" id="space-table">
                            <thead>
                                <tr>
                                    <th>
                                        SI
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Media Type
                                    </th>
                                    <th>
                                        Duration
                                    </th>
                                    <th>
                                        Aspect Ratio
                                    </th>
                                    <th>
                                        Weather
                                    </th>
                                    <th>
                                        Mood
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box -->



            </div><!--/.col (left) -->
        </div>

    </section>

</div>

 <script>
    var app = angular.module('myApp', []);
       app.controller('myCtrl', function($scope, $http, $compile) {
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

                                $('#username').text(val.username);

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



               $http({
                   method : "GET",
                   url : "https://netapi.danderdee.com/api/space-templates"
               }).then(function mySucces(response) {
                   console.log(response);

                   if(response.status == 200)
                   {
                       var html = '';
                       $('#space-table tbody').html('');
                        var html = '';
                        var count = 1;
                        $(response.data).each(function(i,val){
                            var $el = $("" +
                            '<tr><td>' + count++ + '</td>' +
                            '<td>' + val.name + '</td>' +
                            '<td>' + val.mediaType + '</td>' +
                            '<td>' + val.duration + '</td>' +
                            '<td>' + val.aspectRatio + '</td>' +
                            '<td>' + val.weather + '</td>' +
                            '<td>' + val.mood + '</td>' +
                            '<td><a href="<?php echo SERVER ?>/space/edit.php" class="btn btn-success btn-xs" title="edit"><i class="glyphicon glyphicon-edit"></i></a><button type="button" class="btn btn-danger btn-xs" title="edit"><i class="glyphicon glyphicon-remove-circle"></i></button></td>' +
                            '</tr>').appendTo('#space-table tbody');
                            $compile($el)($scope);
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
       });
       angular.bootstrap(document.getElementById("myApp"), ['myApp']);
</script>
<?php include('../includes/footer.php'); ?>
