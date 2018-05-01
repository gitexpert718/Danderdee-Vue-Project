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
//        for menu

    function getPageName(url) {
        var currurl = window.location.pathname;
        var index = currurl.lastIndexOf("../index.html") + 1;
        var filenameWithExtension = currurl.substr(index);
        var filename = filenameWithExtension.split(".")[0]; // <-- added this line
        return filename;                                    // <-- added this line
    }
    jQuery(document).ready(function () {
        var user = localStorage.getItem("userName");

        var token = localStorage.getItem("token");

        jQuery.ajax({
            url: "https://bkapi.danderdee.com/api/auth/accounts/?access_token=" + token,
            type: "GET",
            success: function (result) {
                var dataString = JSON.stringify(result);

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


        jQuery(".userName").text(user);
        $('a[href="edit_user.html?user="]').attr("href", "edit_user.html?user=" + user);

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
<?php include('includes/sidebar.php'); ?>

<body class="skin-blue sidebar-mini">


    <!-- Site wrapper -->
    <div class="wrapper">



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php include('includes/nav-header.php'); ?>


            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Main Page
                    <!--<small>it all starts here</small>-->
                </h1>


            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <!--<div class="box">-->
                <!--<div class="box-header with-border">
                            <h3 class="box-title">Create Ad</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>-->
                <!--<div class="box-body">

                    </div>
                </div>-->
                <div class="alert alert-success"><strong>Server Status OK.</strong></div>
                <!--<strong style="vertical-align: middle; padding: 0 0 0 48%">Active Ads</strong>-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Active Ads</h3>
                            </div>
                            <div class="box-body">
                                <h4><strong style="vertical-align: middle;">Local</strong></h4>
                                <table id="dyntable" class="table table-bordered responsive">
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%;" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="menu-a">Advert Name</th>
                                            <th class="menu-a">Company Name</th>
                                            <th class="menu-a">Description</th>
                                            <th class="menu-a">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeA" id="Advert_ID">
                                            <td>Advert</td>
                                            <td>XYZ.co.in</td>
                                            <td>Loreum Ipsum</td>
                                            <td>
                                                <a href="edit.html" alt="edit" title="edit"><i class="fa fa-pencil"></i></a> &nbsp;
                                                <a href="view.html" id="medialist"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a href="#" class="delet1" alt="delete" title="delete"><span class="fa fa-trash"></span></a>&nbsp;
                                                <a href="#" alt="print" title="print" onclick=""><i class="fa fa-print"></i></a>&nbsp;
                                                <a href="#" alt="downloadpdf" title="downloadpdf"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-body">
                                <h4><strong style="vertical-align: middle;">Global</strong></h4>
                                <table id="dyntable" class="table table-bordered responsive">
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="menu-a">Advert Name</th>
                                            <th class="menu-a">Company Name</th>
                                            <th class="menu-a">Description</th>
                                            <th class="menu-a">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeA" id="Advert_ID">
                                            <td>Advert</td>
                                            <td>XYZ.co.in</td>
                                            <td>Loreum Ipsum</td>
                                            <td>
                                                <a href="edit.html" alt="edit" title="edit"><i class="fa fa-pencil"></i></a> &nbsp;
                                                <a href="view.html" id="medialist"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a href="#" class="delet1" alt="delete" title="delete"><span class="fa fa-trash"></span></a>&nbsp;
                                                <a href="#" alt="print" title="print" onclick=""><i class="fa fa-print"></i></a>&nbsp;
                                                <a href="#" alt="downloadpdf" title="downloadpdf"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Scheduled Ads</h3>
                            </div>
                            <div class="box-body">
                                <h4><strong style="vertical-align: middle;">Local</strong></h4>
                                <table id="dyntable" class="table table-bordered responsive">
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="menu-a">Advert Name</th>
                                            <th class="menu-a">Company Name</th>
                                            <th class="menu-a">Description</th>
                                            <th class="menu-a">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeA" id="Advert_ID">
                                            <td>Advert</td>
                                            <td>XYZ.co.in</td>
                                            <td>Loreum Ipsum</td>
                                            <td>
                                                <a href="edit.html" alt="edit" title="edit"><i class="fa fa-pencil"></i></a> &nbsp;
                                                <a href="view.html" id="medialist"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a href="#" class="delet1" alt="delete" title="delete"><span class="fa fa-trash"></span></a>&nbsp;
                                                <a href="#" alt="print" title="print" onclick=""><i class="fa fa-print"></i></a>&nbsp;
                                                <a href="#" alt="downloadpdf" title="downloadpdf"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-body">
                                <h4><strong style="vertical-align: middle;">Global</strong></h4>
                                <table id="dyntable" class="table table-bordered responsive">
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="menu-a">Advert Name</th>
                                            <th class="menu-a">Company Name</th>
                                            <th class="menu-a">Description</th>
                                            <th class="menu-a">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeA" id="Advert_ID">
                                            <td>Advert</td>
                                            <td>XYZ.co.in</td>
                                            <td>Loreum Ipsum</td>
                                            <td>
                                                <a href="edit.html" alt="edit" title="edit"><i class="fa fa-pencil"></i></a> &nbsp;
                                                <a href="view.html" id="medialist"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a href="#" class="delet1" alt="delete" title="delete"><span class="fa fa-trash"></span></a>&nbsp;
                                                <a href="#" alt="print" title="print" onclick=""><i class="fa fa-print"></i></a>&nbsp;
                                                <a href="#" alt="downloadpdf" title="downloadpdf"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><div class="col-md-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Suspended Ads</h3>
                            </div>
                            <div class="box-body">
                                <h4><strong style="vertical-align: middle;">Local</strong></h4>
                                <table id="dyntable" class="table table-bordered responsive">
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="menu-a">Advert Name</th>
                                            <th class="menu-a">Company Name</th>
                                            <th class="menu-a">Description</th>
                                            <th class="menu-a">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeA" id="Advert_ID">
                                            <td>Advert</td>
                                            <td>XYZ.co.in</td>
                                            <td>Loreum Ipsum</td>
                                            <td>
                                                <a href="edit.html" alt="edit" title="edit"><i class="fa fa-pencil"></i></a> &nbsp;
                                                <a href="view.html" id="medialist"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a href="#" class="delet1" alt="delete" title="delete"><span class="fa fa-trash"></span></a>&nbsp;
                                                <a href="#" alt="print" title="print" onclick=""><i class="fa fa-print"></i></a>&nbsp;
                                                <a href="#" alt="downloadpdf" title="downloadpdf"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-body">
                                <h4><strong style="vertical-align: middle;">Global</strong></h4>
                                <table id="dyntable" class="table table-bordered responsive">
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="menu-a">Advert Name</th>
                                            <th class="menu-a">Company Name</th>
                                            <th class="menu-a">Description</th>
                                            <th class="menu-a">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeA" id="Advert_ID">
                                            <td>Advert</td>
                                            <td>XYZ.co.in</td>
                                            <td>Loreum Ipsum</td>
                                            <td>
                                                <a href="edit.html" alt="edit" title="edit"><i class="fa fa-pencil"></i></a> &nbsp;
                                                <a href="view.html" id="medialist"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a href="#" class="delet1" alt="delete" title="delete"><span class="fa fa-trash"></span></a>&nbsp;
                                                <a href="#" alt="print" title="print" onclick=""><i class="fa fa-print"></i></a>&nbsp;
                                                <a href="#" alt="downloadpdf" title="downloadpdf"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
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