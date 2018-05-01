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

<script src="<?php echo SERVER ?>/js/jquery-1.11.2.min.js"></script>
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

        if (localStorage.getItem("token") == null) {
            window.location.href = 'login.php';
        }

        var user = localStorage.getItem("userName");
        jQuery(".userName").text(user);
        $('a[href="edit_user.html?user="]').attr("href", "edit_user.html?user=" + user);

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



        jQuery('#submit').click(function () {
            jQuery('.error-red').html('Creating User');
            var data = jQuery("#form1").serializeArray();
            jQuery.each(data, function (i, val) {
                if (this.name == 'access_token') {
                    this.value = token;
                }
            });

            var password = jQuery('#password').val();
            var cnfpassword = jQuery('#cnfpassword').val();
            if (password != cnfpassword) {
                jQuery('.error-red').html('Password and confirm password doesnot match');
                return;
            }

            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/public/accounts",
                type: "POST",
                data: data,
                success: function (result) {
                    jQuery('.error-red').html('User created Successfully');
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        });
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
                <h1>
                    New User
                    <!--<small>it all starts here</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="mainpage.html"><i class="fa fa-home"></i></a></li>
                    <li><a href="new_user.html">New User</a></li>
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
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4 center-block" style="float:none;">
                                <form id="form1" class="stdform" method="post" action="#">
                                    <div class="error-red" style="color:red">
                                    </div>
                                    <div style="color:red">Fields with * are mandatory</div>


                                    <div class="form-group">
                                        <input type="hidden" name="access_token" id="access_token" />
                                        <input type="text" id="username" class="form-control required"  name="id" value="" >
                                        <label for="Username">Username</label>
                                    </div>



                                    <div class="form-group">
                                        <input type="text" id="Forename" class="form-control required" name="forename" value="" >
                                        <label for="Forename">Forename</label>
                                    </div>



                                    <div class="form-group">
                                        <input type="text" id="Surname" class="form-control required" name="surname" value="" >
                                        <label for="Surname">Surname</label>
                                    </div>



                                    <div class="form-group">
                                        <input type="text" id="Email" class="form-control required" name="email" value="" >
                                        <label for="Email">Email</label>
                                    </div>




                                    <div class="form-group">
                                        <input type="Password" id="Password" class="form-control required" name="Password" value="" >
                                        <label for="Password">Password</label>
                                    </div>



                                    <div class="form-group">
                                        <input type="Password" id="cnfpassword" class="form-control required" name="cnfpassword" value="" >
                                        <label for="cnfpassword">Confirm Password</label>
                                    </div>



                                    <div class="form-group">
                                        <textarea id="comments" class="form-control required" name="notes"></textarea>
                                        <label for="comments">Notes</label>
                                    </div>




                                    <div class="box-footer text-center">
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary submit-button">{{submit}}</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <!--<div class="box-footer">
                        Footer
                    </div>-->
                    <!-- /.box-footer-->
                </div><!-- /.box -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <!--<b>Version</b> 2.0-->
            </div>
            <strong>Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> <a href="mainpage.html">Aaron Sarginson</a>.</strong> All rights reserved.
        </footer>



        <?php include('includes/footer.php'); ?>
</body>
</html>