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

<script src="<?php echo SERVER ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>


<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo SERVER ?>/js/jquery.cookie.js"></script>
<script src="<?php echo SERVER ?>/js/jquery-ui-1.9.2.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<script type="text/javascript" src="<?php echo SERVER ?>/js/custom.js"></script>

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!--
 <script src="js/angular.min.js" type="text/javascript"></script>
-->
<!-- LOAD ANGULAR -->
<!--
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
-->
<!-- PROCESS FORM WITH AJAX (NEW) -->
<script>
    var launch_time, end_time;
    function getPageName(url) {
        var currurl = window.location.pathname;
        var index = currurl.lastIndexOf("../index.html") + 1;
        var filenameWithExtension = currurl.substr(index);
        var filename = filenameWithExtension.split(".")[0]; // <-- added this line
        return filename;                                    // <-- added this line
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return sParameterName[1];
            }
        }
    }
    jQuery(document).ready(function () {

        if (localStorage.getItem("token") == null) {
            window.location.href = 'login.php';
        }


        var user = localStorage.getItem("userName");



        jQuery(".userName").text(user);
        $('a[href="edit_user.html?user="]').attr("href", "edit_user.html?user=" + user);

        // jQuery(".userName").text(user);

        var type = window.location.hash.substr(1);
        if (type == 'add') {
            jQuery('.stdform').hide();
            jQuery('#form2').show();
            jQuery('.active').removeClass('active');
            jQuery('.media-li').addClass('active');
        } else {
            jQuery('.stdform').hide();
            jQuery('#form1').show();
        }

        jQuery('#check_enable').click(function () {
            if (jQuery(this).is(":checked")) {
                jQuery('#password').removeAttr('disabled');
            } else {
                jQuery('#password').attr('disabled', 'disabled');
            }
        });

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


        var id = getUrlParameter('id');
        jQuery('#submit').click(function () {

            jQuery('.error-red').html('Updating Adv');
            var data = jQuery("#form1").serializeArray();

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
            // console.log(data);
            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + id,
                type: "PUT",
                data: data,
                success: function (result) {
                    jQuery('.error-red').html('Ad updated Successfully');
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        });

        jQuery('#media_url_button').click(function () {

            jQuery('.error-red').html('Setting Adverts Media');
            var data = jQuery("#form2").serializeArray();
            jQuery.each(data, function (i, val) {
                if (this.name == 'access_token') {
                    this.value = token;
                }
            });

            // console.log(data);
            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + id + "/media/link",
                type: "POST",
                data: data,
                success: function (result) {
                    jQuery('.error-red').html('Media link set Successfully');
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        });

        jQuery('#media_button').click(function () {
            jQuery('.error-red').html('Setting Adverts Media');
            var data = jQuery("#form3").serializeArray();
            jQuery.each(data, function (i, val) {
                if (this.name == 'access_token') {
                    this.value = token;
                }
            });



            // console.log(data);

            var fd = new FormData();
            fd.append("media", jQuery("#media")[0].files[0]);
            fd.append("storage", "local");
            //fd.append("access_token", token);



            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + id + "/media/file",
                type: "POST",
                beforeSend: function (request) {
                    request.setRequestHeader("Authorization", token);
                },
                data: fd,
                //enctype: 'multipart/form-data',
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function (result) {
                    jQuery('.error-red').html('Media link set Successfully');
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        // window.location.href = 'login.php?message=Invalid%20access%20token';
                    } else if (xhr.status == 200) {
                        jQuery('.error-red').html('Media link set Successfully');
                    } else {
                        jQuery('.error-red').html(xhr.responseText);
                    }
                },
            });
        });

        jQuery('#state_button').click(function () {
            jQuery('.error-red').html('Setting Adverts State');
            var data = jQuery("#form4").serializeArray();
            jQuery.each(data, function (i, val) {
                if (this.name == 'access_token') {
                    this.value = token;
                }
            });

            // console.log(data);
            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + id + "/state",
                type: "POST",
                data: data,
                success: function (result) {
                    jQuery('.error-red').html('Adverts State set Successfully');
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        //window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        });

        jQuery('#modal_html_button').click(function () {
            jQuery('.error-red').html('Uploading modal html');
            var data = jQuery("#form5").serializeArray();
            jQuery.each(data, function (i, val) {
                if (this.name == 'access_token') {
                    this.value = token;
                }
            });

            // console.log(data);
            var fd = new FormData();
            fd.append("html", jQuery("#html")[0].files[0]);
            fd.append("access_token", token);

            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + id + "/html/file",
                type: "POST",
                data: fd,
                enctype: 'multipart/form-data',
                processData: false,
                success: function (result) {
                    jQuery('.error-red').html('modal html uploaded Successfully');
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        });

        jQuery.ajax({
            url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + id + "?access_token=" + token,
            type: "GET",
            success: function (result) {
                result = result[0];
                jQuery('#id').val(result.id);
                jQuery('#type').val(result.type);
                jQuery('#category').val(result.category);
                jQuery('#location').val(result.location);
                jQuery('#area_id').val(result.area_id);
                jQuery('#link').val(result.media_URL);
                jQuery('#state').val(result.status);
                jQuery('#rank').val(result.rank);
                jQuery('#friendly_name').val(result.friendly_name);
                jQuery('#native_stats').val(result.native_stats);
                //var launch_time = result.launch_time;
                //var dateTimeArray = launch_time.split('T');
                //var dateArray = dateTimeArray[0].split('-');
                //var timeArray = dateTimeArray[1].split(':');
                //var secondsArray = timeArray[2].split('+');
                //var secondsOnlyArray = secondsArray[0].split('.');

                //jQuery("#timeRange").data('daterangepicker').setStartDate(new Date(result.launch_time));
                /*       $('#datetimepicker6').datetimepicker({
                 defaultDate: new Date(result.launch_time)
                 }); */
                //var launch_time = result.end_time;
                //var dateTimeArray = launch_time.split('T');
                //var dateArray = dateTimeArray[0].split('-');
                //var timeArray = dateTimeArray[1].split(':');
                //var secondsArray = timeArray[2].split('+');
                //var secondsOnlyArray = secondsArray[0].split('.');
                //jQuery('#end_time').val(dateArray[2] + '/' + dateArray[1] + '/' + dateArray[0] + ' ' + timeArray[0] + ':' + timeArray[1] + ':' + secondsOnlyArray[0]);
                //jQuery("#timeRange").data('daterangepicker').setEndDate(dateArray[2] + '/' + dateArray[1] + '/' + dateArray[0] + ' ' + timeArray[0] + ':' + timeArray[1] + ':' + secondsOnlyArray[0]);
                //jQuery("#timeRange").data('daterangepicker').setStartDate(result.end_time.format("YYYYY/MM/DD h:mm A"));
                //jQuery("#timeRange").data('daterangepicker').setStartDate(new Date(result.end_time));
                //$('#datetimepicker7').datetimepicker('setDate', new Date(result.end_time));
                //$('#datetimepicker7').data("DateTimePicker").val(new Date());
                /*           $('#datetimepicker7').datetimepicker({
                 defaultDate: new Date(result.end_time)
                 });
                 //  jQuery('.error-red').html('User created Successfully');
                 
                 $("#datetimepicker6").on("dp.change", function (e) {
                 $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                 launch_time = e.date;
                 });
                 $("#datetimepicker7").on("dp.change", function (e) {
                 $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                 end_time = e.date;
                 });
                 
                 */

                jQuery('.date-range-picker').daterangepicker({
                    "linkedCalendars": false,
                    "autoUpdateInput": true,
                    "showCustomRangeLabel": false,
                    "startDate": new Date(result.launch_time),
                    "endDate": new Date(result.end_time),
                    locale: {
                        format: 'DD/MM/YYYY h:mm A'
                    },
                    timePicker: true,
                    timePickerIncrement: 30
                }, function (start, end, label) {
                    jQuery("#form1 input[name=launch_time]").val(start.format('DD/MM/YYYY h:mm A'));
                    jQuery("#form1 input[name=end_time]").val(end.format('DD/MM/YYYY h:mm A'));
                });
            },
            error: function (xhr, status, error) {
                if (xhr.status == 401) {
                    window.location.href = 'login.php?message=Invalid%20access%20token';
                }
                jQuery('.error-red').html(xhr.responseText);
            },
        });


        jQuery('#delete').click(function () {
            jQuery('.error-red').html('Deleting User');

            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + id + "?access_token=" + token,
                type: "DELETE",
                access_token: token,
                success: function (result) {
                    jQuery('.error-red').html('Adv deleted Successfully');
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        });


        jQuery('.main-li').click(function () {
            jQuery('.stdform').hide();
            jQuery('#form1').show();
            jQuery('.active').removeClass('active');
            jQuery(this).addClass('active');
        });
        jQuery('.media-li').click(function () {
            jQuery('.stdform').hide();
            jQuery('#form2').show();
            jQuery('.active').removeClass('active');
            jQuery(this).addClass('active');
        });
        jQuery('.file-li').click(function () {
            jQuery('.stdform').hide();
            jQuery('#form3').show();
            jQuery('.active').removeClass('active');
            jQuery(this).addClass('active');
        });

        jQuery('.htmlmodal-li').click(function () {
            jQuery('.stdform').hide();
            jQuery('#form5').show();
            jQuery('.active').removeClass('active');
            jQuery(this).addClass('active');
        });

        jQuery('.state-li').click(function () {
            jQuery('.stdform').hide();
            jQuery('#form4').show();
            jQuery('.active').removeClass('active');
            jQuery(this).addClass('active');
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
        } else {
            jQuery('#main').addClass('active');

            /*jQuery('.leftmenu #dashboard > a').trigger('click');*/
        }
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
                <h1>Edit Ad
                    <!--<small>it all starts here</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="mainpage.html"><i class="fa fa-home"></i></a></li>
                    <li><a href="edit_ad.html">Edit Ad</a></li>
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
                        <div class="widgetcontent">
                            <ul class="nav nav-tabs">
                                <li class="active main-li">
                                    <a href="#">Main</a>
                                </li>
                                <li class="media-li">
                                    <a href="#">Media URL</a>
                                </li>
                                <li class="file-li">
                                    <a href="#">File</a>
                                </li>
                                <li class="htmlmodal-li">
                                    <a href="#">Modal HTML</a>
                                </li>
                                <li class="state-li">
                                    <a href="#">State</a>
                                </li>
                            </ul>
                            <div class="error-red" style="color: red">
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 center-block" style="float:none;">
                                    <form id="form1" class="stdform">


                                        <div class="form-group">
                                            <input type="text" id="id" name="id" value="" class="form-control required" />
                                            <label for="id">Advert ID</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="access_token" id="access_token" />
                                            <label for="name" class=" no-floatlabel">Advert type</label>
                                            <select name="type" id="type" class="form-control required">
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
                                            <label for="Location">Location:</label>

                                        </div>

                                        <div class="form-group" id="active-group">

                                            <input type="text" name="area_id" id="area_id" class="form-control required" />
                                            <label for="area_id">Area ID</label>

                                        </div>

                                        <div class="form-group" id="active-group">

                                            <input type="number" name="rank" id="rank" min="0" max="10" value="" class="form-control required" />
                                            <label for="rank">Advert Rank</label>

                                        </div>

                                        <div class="form-group" id="placement-group">

                                            <input type="text" name="friendly_name" id="friendly_name" class="form-control" />
                                            <label for="friendly_name">Friendly Name</label>

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
                                                                  
                                                                  
                                                                      <input type="text" name="rank_to" value="" class="form-control required"/>
                                                                  <label class="control-label" for="rank_to">Rank To</label>
                                                              </div>
          
                                        -->

                                        <div class="form-group" id="duration-group">
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

                                        <div class="form-group">
                                            <label for="Date" class="no-floatlabel">Time Range</label>
                                            <div id="datetimepicker2" class="controls input-append date hidden">
                                                <input data-format="dd/MM/yyyy hh:mm:ss" type="text" name="end_time" class="form-control no-floatlabel">
                                                <span class="add-on">
                                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                                </span>
                                                <!-- <input type="text" name="end_time" id="datepicker1" class="required " /></div>-->

                                            </div>

                                            <div class="date-range">
                                                <div class="form-group">
                                                    <input type="text" id="Text1" class="date-range-picker form-control">
                                                </div>
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

                                        <!--<div class="par control-group form-group">
                                            <label class="control-label" for="Date"> End Time:</label>
                                            <div id="datetimepicker2" class="controls input-append date">
                                                <input data-format="dd/MM/yyyy hh:mm:ss" type="text" name="end_time" id="end_time" class="form-control required">
                                                <span class="add-on">
                                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                            <input type="checkbox"  id="check_enable" />
                                            <label class="no-floatlabel">
                                                Change Password
                                            </label>
                                        </div>

                                        <div class="form-group">

                                            <label for="password">Password</label>
                                            <div class="formwrapper">
                                                <input type="password" name="password" id="password" disabled class="form-control required" />
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
                                        <p class="stdformbutton" align="center">
                                            <input type="button" id="submit" name="submit" class="btn btn-primary" value="Submit" />
                                            <input type="button" id="delete" name="delete" class="btn btn-danger" value="Delete Adv" />

                                        </p>
                                    </form>

                                    <form id="form2" class="form2 stdform">
                                        <div class="form-group">
                                            <!--checker-->
                                            <div class="control-group">
                                                <input type="hidden" name="access_token" id="access_token" />
                                                <input type="text" id="link" name="link" class="form-control required">
                                                <label class="control-label" for="Date">Media URL</label>
                                            </div>
                                        </div>
                                        <p class="stdformbutton">
                                            <input type="button" id="media_url_button" name="submit" class="btn btn-primary" value="Submit" />

                                        </p>
                                    </form>

                                    <form id="form3" class="form3 stdform">
                                        <div class="form-group">
                                            <!--checker-->
                                            <input type="hidden" name="access_token" id="access_token" />
                                            <label class="no-floatlabel"  for="Date">Media</label>
                                            <input type="file" id="media" name="media" class="form-control no-floatlabel required">
                                        </div>
                                        <p class="stdformbutton">
                                            <input type="button" id="media_button" name="submit" class="btn btn-primary" value="Submit" />

                                        </p>
                                    </form>

                                    <form id="form4" class="form4 stdform">
                                        <div class="form-group">
                                            <!--checker-->
                                            <input type="hidden" name="access_token" id="access_token" />
                                            <label class=" no-floatlabel" for="Date">State</label>
                                            <select name="state" id="state" class="form-control required">
                                                <option value="paused">paused</option>
                                                <option value="active">active</option>
                                            </select>
                                        </div>
                                        <p class="stdformbutton">
                                            <input type="button" id="state_button" name="submit" class="btn btn-primary" value="Submit" />

                                        </p>
                                    </form>
                                    <form id="form5" class="form5 stdform">
                                        <div class="form-group">
                                            <!--checker-->
                                            <label class="no-floatlabel" for="Date">Modal HTML</label>
                                            <input type="hidden" name="access_token" id="access_token" />
                                            <input type="file" id="html" name="html" class="form-control no-floatlabel required">
                                        </div>
                                        <p class="stdformbutton">
                                            <input type="button" id="modal_html_button" name="submit" class="btn btn-primary" value="Submit" />

                                        </p>
                                    </form>
                                </div>
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
                <a href="mainpage.html">Aaron Sarginson</a>.
            </strong>All rights reserved.
        </footer>



        <?php include('includes/footer.php'); ?>

    <!-- <script src="<?php //echo SERVER   ?>/js/moment.js"></script> -->

    <!--<script src="js/bootstrap-datetimepicker.min.js"></script>-->
  <!--  <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script> -->
  <!--  <script src="https://cdn.jsdelivr.net/momentjs.timezone/0.5.4/moment-timezone-with-data.min.js"></script> -->

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