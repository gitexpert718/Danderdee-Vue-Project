
<?php
//session_start();
//$role = $_SESSION['json'];
//$display = "";
//
//if($role != "admin"){
//    $display = "display:none;";
//}
?>
<?php include('includes/header.php'); ?>

<style type="text/css">
    .date-range {
        position: relative;
    }

    .date-range i {
        position: absolute;
        bottom: 10px;
        right: 10px;
        top: auto;
        cursor: pointer;
    }
</style>

<script src="<?php echo SERVER ?>/js/jquery-1.9.1.min.js"></script>

<script type="text/javascript">

    jQuery(document).ready(function () {

        if (localStorage.getItem("token") == null) {
            window.location.href = 'login.php';
        }


        var token = localStorage.getItem("token");
        jQuery.ajax({
            url: "https://bkapi.danderdee.com/api/auth/accounts/?access_token=" + token,
            type: "GET",
            success: function (result) {

                jQuery(result).each(function (i, value) {

                    $.post('insert.php', {
                        task: "json",
                        res: value.role_id
                    }).success(function () {

                    });
                });



            },
            error: function (xhr, status, error) {
                if (xhr.status == 401) {
                    window.location.href = 'login.php?message=Invalid%20access%20token';
                }
                jQuery('.error-red').html(xhr.responseText);
            },
        });


    });

</script>

</head>

<body class="skin-blue sidebar-mini">


    <!-- Site wrapper -->
    <div class="wrapper">

        <?php include('includes/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php include('includes/nav-header.php'); ?>

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Create Ad
                    <!--<small>it all starts here</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="mainpage.html"><i class="fa fa-home"></i></a></li>
                    <li><a href="create_ad.html">Create Ad</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <!--<div class="box-header with-border">
                        <h3 class="box-title">Create Ad</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>-->
                    <div class="box-body">
                        <div id="loading" style="width: 100%; text-align: center">
                            <img src="images/loading.gif" />
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4 center-block" style="float:none;">
                                <form id="form1" class="stdform">
                                    <div class="error-red" style="color: red">
                                    </div>


                                    <div class="form-group">
                                        <label for="category" class=" no-floatlabel">Username</label>
                                        <select name="id" id="username" class="form-control required">

                                        </select>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="access_token" id="access_token" />
                                        <label for="name" class=" no-floatlabel">Advert type</label>
                                        <select name="type" class="form-control">
                                            <option value="local">Local</option>
                                            <option value="global">Global</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="category" id="category" value="" class="form-control required" />
                                        <label for="category">Category</label>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="form-group" id="placement-group">

                                        <input type="text" name="location" id="location" value="" class="form-control required" />
                                        <label for="Location">Location</label>

                                    </div>

                                    <div class="form-group" id="active-group">

                                        <input type="text" name="area_id" id="area_id" class="form-control required" />
                                        <label for="area_id">Area ID</label>

                                    </div>
                                    <!--
        
                                                            <div class="par control-group form-group" id="active-group">
                                                                <label class="control-label" for="rank">Advert Rank</label>
                                                                <div class="controls">
                                                                    <input type="text" name="rank" value="" class="form-control required"/>
                                                                </div>
                                                            </div>
                                    -->
                                    <div class="form-group" id="active-group">

                                        <input type="number" name="rank" id="rank" min="0" max="10" value="" class="form-control required" />
                                        <label for="rank">Advert Rank</label>

                                    </div>

                                    <div class="form-group" id="placement-group">

                                        <input type="text" name="friendly_name" id="friendly_name" class="form-control" />
                                        <label for="friendly_name">Friendly Name</label>

                                    </div>

                                    <div class="form-group" id="placement-group">

                                        <input type="text" name="paid-type" id="paidType" class="form-control" />
                                        <label class="control-label" for="paidType">Paid Type</label>

                                    </div>


                                    <div class="form-group" id="name-group">

                                        <input type="hidden" name="native_stats" id="native_stats" />
                                        <label for="nativestats" class=" no-floatlabel">Remote Stats</label>
                                        <select name="native_stats" class="form-control">
                                            <option value="true">Disabled</option>
                                            <option value="false">Enabled</option>
                                        </select>

                                    </div>

                                    <!--
                                                            <div class="par control-group form-group" id="active-group">
                                                                <label class="control-label" for="rank_to">Rank To</label>
                                                                <div class="formwrapper">
                                                                    <input type="text" name="rank_to" value="" class="form-control required"/>
                                                                </div>
                                                            </div>
        
                                    -->
                                    <div class="par control-group form-group" id="duration-group">
                                        <!--checker-->
                                        <div class="par control-group hidden">
                                            <label class="control-label no-floatlabel" for="Date">Launch Time:</label>
                                            <div id="datetimepicker1" class="controls input-append date">
                                                <input data-format="dd/MM/yyyy hh:mm:ss" type="text" name="launch_time" class="form-control no-floatlabel">
                                                <span class="add-on">
                                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="par control-group form-group">
                                        <label class="control-label no-floatlabel" for="Date">Time Range</label>
                                        <div id="datetimepicker2" class="controls input-append date hidden">
                                            <input data-format="dd/MM/yyyy hh:mm:ss" type="text" name="end_time" class="form-control no-floatlabel">
                                            <span class="add-on">
                                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                            </span>
                                            <!-- <input type="text" name="end_time" id="datepicker1" class="required " /></div>-->

                                        </div>

                                        <div class="date-range">
                                            <input type="text" id="Text1" class="date-range-picker form-control">
                                        </div>
                                        <br />
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                            <label class="control-label no-floatlabel" for="Date">Link(s)</label>
                                                            <div class="div-links">
                                                                <div class="div-link">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control no-floatlabel" placeholder="Link" name="link[]" onkeyup="saveText(this)" />
                                                                        <span class="input-group-addon btn" onclick="addLink()" style="background-color: #1779cc;">
                                                                            <i class="fa fa-plus" style="color: #fff;"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                </div>
                                                <div class="col-sm-6">
                                                            <label class="control-label no-floatlabel" for="Date">Caption(s)</label>
                                                            <div class="div-captions">
                                                                <div class="div-caption">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control no-floatlabel" placeholder="Caption" name="caption[]" onkeyup="saveText(this)" />
                                                                        <span class="input-group-addon btn" onclick="addCaption()" style="background-color: #1779cc;">
                                                                            <i class="fa fa-plus" style="color: #fff;"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="par control-group form-group" id="active-group">
                                        <label class="control-label" for="areaid">Area ID</label>
                                        <div class="formwrapper">
                                            <select name="status" >
                                                <option value="active">Active</option>
                                                <option value="scheduled">Scheduled</option>
                                                <option value="suspended">Suspended</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <br />

                                    <p class="stdformbutton" align="center">
                                        <input type="button" id="submit" name="submit" class="btn btn-primary" value="Submit" />
                                    </p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <!--<div class="box-footer">
                    Footer
                </div>-->
                <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <!--<b>Version</b> 2.0-->
    </div>
    <strong>Copyright &copy;
        <script>document.write(new Date().getFullYear());</script>
        <a href="mainpage.html">Aaron Sarginson</a>.</strong> All rights reserved.
</footer>



<?php include('includes/footer.php'); ?>

<script>
    /*
     // define angular module/app
     var formApp = angular.module('formApp', []);
     
     // create angular controller and pass in $scope and $http
     function formController($scope, $http) {
     
     // create a blank object to hold our form information
     // $scope will allow this to pass between controller and view
     $scope.formData = {};
     
     // process the form
     $scope.processForm = function() {
     $http({
     method  : 'POST',
     url     : 'process.php',
     data    : $.param($scope.formData),  // pass in data as strings
     headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
     })
     .success(function(data) {
     console.log(data);
     
     if (!data.success) {
     // if not successful, bind errors to error variables
     $scope.errorName = data.errors.name;
     $scope.errorSuperhero = data.errors.superheroAlias;
     } else {
     // if successful, bind success message to message
     $scope.message = data.message;
     }
     });
     };
     
     }
     */
    jQuery(document).ready(function () {
        if (localStorage.getItem("token") == null) {
            window.location.href = 'login.php';
        }
        var token = localStorage.getItem("token");
        jQuery.ajax({
            url: "https://bkapi.danderdee.com/api/auth/accounts/?access_token=" + token,
            type: "GET",
            success: function (result) {
                jQuery('#loading').hide();
                jQuery('form').show();
                var option = '';
                jQuery(result).each(function (i, value) {
                    option += "<option value='" + value.id + "'>" + value.id + "</option>";
                });
                jQuery('#username').append(option);
            },
            error: function (xhr, status, error) {
                if (xhr.status == 401) {
                    window.location.href = 'login.php?message=Invalid%20access%20token';
                }
                jQuery('.error-red').html(xhr.responseText + " .Please refresh page");
            },
        });
        jQuery('#submit').click(function () {
            jQuery('#loading').show();
            jQuery('.error-red').html('Creating Adv');
            var data = jQuery("form").serializeArray();

            jQuery.each(data, function (i, val) {

                if (this.name == 'launch_time' || this.name == 'end_time') {
                    //if (this.value != '') {
                    if (false) {
                        var date1 = this.value;
                        var dateTimeArray = date1.split(' ');
                        var dateArray = dateTimeArray[0].split('../index.html');
                        var timeArray = dateTimeArray[1].split(':');
                        this.value = dateArray[2] + '-' + dateArray[1] + '-' + dateArray[0] + 'T' + timeArray[0] + ':' + timeArray[1] + ':' + timeArray[2] + '.000Z';
                    }
                } else if (this.name == 'access_token') {
                    this.value = token;
                }
            });

            var username = jQuery('#username').val();
            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/" + username + "/adverts",
                type: "POST",
                data: data,
                success: function (result) {
                    jQuery('#loading').hide();

                    jQuery('.error-red').html('Ad created Successfully');
                    window.location.href = "edit_ad.html?id=" + result.id + ""
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('#loading').hide();
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        });
    });
</script>
<script type="text/javascript">
    //for menu

    function getPageName(url) {
        var currurl = window.location.pathname;
        var index = currurl.lastIndexOf("../index.html") + 1;
        var filenameWithExtension = currurl.substr(index);
        var filename = filenameWithExtension.split(".")[0]; // <-- added this line
        return filename;                                    // <-- added this line
    }
    jQuery(document).ready(function () {
        var pname = getPageName(window.location);
        if (pname == 'Adverts') {
            jQuery('#adverts').addClass('active');
            jQuery('.leftmenu #adverts > a').trigger('click');
            jQuery('li#' + pname).addClass('active');
        } else if (pname == 'create_ad') {
            jQuery('#create_ad').addClass('active');
            jQuery('.leftmenu #create_ad > a').trigger('click');
            jQuery('li#' + pname).addClass('active');
        } else if (pname == 'edit_ad') {
            jQuery('#edit_ad').addClass('active');
            jQuery('.leftmenu #edit_ad > a').trigger('click');
            jQuery('li#' + pname).addClass('active');
        } else if (pname == 'user') {
            jQuery('#user').addClass('active');
            jQuery('.leftmenu #user > a').trigger('click');
            jQuery('li#' + pname).addClass('active');
        } else if (pname == 'new_user') {
            jQuery('#new_user').addClass('active');
            jQuery('.leftmenu #new_user > a').trigger('click');
            jQuery('li#' + pname).addClass('active');
        } else if (pname == 'edit_user') {
            jQuery('#edit_user').addClass('active');
            jQuery('.leftmenu #edit_user > a').trigger('click');
            jQuery('li#' + pname).addClass('active');
        } else if (pname == 'analytics') {
            jQuery('#analytics').addClass('active');
            jQuery('.leftmenu #analytics > a').trigger('click');
            jQuery('li#' + pname).addClass('active');
        } else {
            jQuery('#main').addClass('active');

            /*jQuery('.leftmenu #dashboard > a').trigger('click');*/
        }
    });
</script>
<script>
    jQuery(function () {
        return;
        jQuery('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
        jQuery('#datetimepicker2').datetimepicker({
            language: 'pt-BR'
        });
    });
</script>
<script type="text/javascript">
    var linkCode = '<div class="div-link">' +
            '<div class="input-group">' +
            '<input type="text" class="form-control no-floatlabel" placeholder="Link" name="link[]" onkeyup="saveText(this)" />' +
            '<span class="input-group-addon btn" onclick="removeSelf(this)" style="background-color:#f00;">' +
            '<i class="fa fa-minus" style="color:#fff;"></i>' +
            '</span>' +
            '</div><br>' +
            '</div>';

    var captionCode = '<div class="div-caption">' +
            '<div class="input-group">' +
            '<input type="text" class="form-control no-floatlabel" placeholder="Caption" name="caption[]" onkeyup="saveText(this)" />' +
            '<span class="input-group-addon btn" onclick="removeSelf(this)" style="background-color:#f00;">' +
            '<i class="fa fa-minus" style="color:#fff;"></i>' +
            '</span>' +
            '</div><br>' +
            '</div>';
    function addLink() {
        jQuery(".div-links").html(linkCode + jQuery(".div-links").html());
    }
    function addCaption() {
        jQuery(".div-captions").html(captionCode + jQuery(".div-captions").html());
    }
    function removeSelf(c) {
        jQuery(c).closest(".div-caption, .div-link").remove();
    }
    function saveText(i) {
        var val = jQuery(i).val();
        jQuery(i).attr('value', val);
    }
</script>
<script src="<?php echo SERVER ?>/dateranger/moment.js"></script>
<script src="<?php echo SERVER ?>/dateranger/daterangepicker.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var futureDate = new Date();
        futureDate.setDate(futureDate.getDate() + 30);
        jQuery('.date-range-picker').daterangepicker({
            "linkedCalendars": false,
            "autoUpdateInput": true,
            "showCustomRangeLabel": false,
            "startDate": new Date(),
            "endDate": futureDate,
            locale: {
                format: 'DD/MM/YYYY h:mm A'
            },
            timePicker: true,
            timePickerIncrement: 30
        }, function (start, end, label) {
            jQuery("#form1 input[name=launch_time]").val(new Date(start).toISOString());//.format('DD/MM/YYYY h:mm A')
            jQuery("#form1 input[name=end_time]").val(new Date(end).toISOString());
        });
        jQuery("#form1 input[name=launch_time]").val(new Date().toISOString());
        jQuery("#form1 input[name=end_time]").val(futureDate.toISOString());
    });
</script>

</body>
</html>