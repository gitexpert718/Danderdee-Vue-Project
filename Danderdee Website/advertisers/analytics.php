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

    console.log(localStorage.getItem("token"));
    var advertData = [];

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

        var username = localStorage.getItem("userName");
        jQuery(".userName").text(username);

        var token = localStorage.getItem("token");
        if (username != '') {
            jQuery('#graphForm select[name=adverts]').html('');

            jQuery.ajax({
                url: "https://bkapi.danderdee.com/api/data/accounts/" + username + "/adverts",
                type: "GET",
                beforeSend: function (request) {
                    request.setRequestHeader("Authorization", token);
                },
                success: function (result) {
                    jQuery('#loading').hide();
                    var option = '';
                    jQuery(result).each(function (i, value) {

                        advertData[i] = value;
                        option += "<option value='" + value.id + "'>" + (value.friendly_name == "" ? "no-name" : value.friendly_name) + "</option>";
                    });
                    jQuery("#graphForm select[name=adverts]").html(option);
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 401) {
                        window.location.href = 'login.php?message=Invalid%20access%20token';
                    }
                    jQuery('#loading').hide();
                    jQuery('.error-red').html(xhr.responseText);
                },
            });
        }


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
                <h1>Chart
                    <!--<small>it all starts here</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="mainpage.html"><i class="fa fa-home"></i></a></li>
                    <li><a href="Chart.html">Chart</a></li>
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


                        <div>
                           
                                    <form id="graphForm">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="no-floatlabel">Select Adverts:</label>
                                                    <select class="form-control no-floatlabel" name="adverts" multiple="multiple" size="5">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    
                                                    <label for="datepicker" class="no-floatlabel">Select Time:</label>
                                                    <input class="date-range-picker form-control" type="text" id="datepicker">
                                                    
                                                </div>
                                                <br />
                                                <div class="form-inline">
                                                    <!-- <span style="display: inline-block;"> -->
                                                    <div class="form-group">
                                                        <label class="no-floatlabel">Sort By:</label>
                                                        <select name="sortBy" class="form-control no-floatlabel" onchange="sort(this)">
                                                            <option value="type">Type</option>
                                                            <option value="id">Advert Id</option>
                                                            <option value="status">Status</option>
                                                            <option value="rank">Rank</option>
                                                            <option value="category">Category</option>
                                                            <option value="location">Location</option>
                                                            <option value="area_id">Area Id</option>
                                                            <option value="created_at">Launch Time</option>
                                                            <option value="end_time">End Time</option>
                                                        </select>
                                                    </div>
                                                    <!-- </span> -->
                                                    <!-- <span style="display: inline-block;"> -->
                                                    <div class="form-group">
                                                        <label class="no-floatlabel">Filter:</label>
                                                        <select name="filter" class="form-control no-floatlabel" onchange="sort(this)">
                                                            <option value="views">Views</option>
                                                            <option value="clicks">Clicks</option>
                                                        </select>
                                                    </div>
                                                    <!-- </span> -->
                                                    <div class="pull-right">
                                                        <div class="form-group">
                                                            <input class="btn btn-primary"  type="button" value="Preview" onclick="setVal();
                                                                    getAnalytics();" />

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                               
                            <br />
                            <script type="text/javascript">
                                function setVal() {
                                    var chartType0 = document.getElementById('chartType0').value;
                                    var chartType1 = document.getElementById('chartType1').value;
                                    var chartType2 = document.getElementById('chartType2').value;
                                    var chartType3 = document.getElementById('chartType3').value;
                                    var chartType4 = document.getElementById('chartType4').value;
                                }
                                function setVal0() {
                                    var chartType0 = document.getElementById('chartType0').value;
                                    console.log(chartType0);
                                }
                                function setVal1() {
                                    var chartType1 = document.getElementById('chartType1').value;
                                    console.log(chartType1);
                                }
                                function setVal2() {
                                    var chartType2 = document.getElementById('chartType2').value;
                                    console.log(chartType2);
                                }
                                function setVal3() {
                                    var chartType3 = document.getElementById('chartType3').value;
                                    console.log(chartType3);
                                }
                                function setVal4() {
                                    var chartType4 = document.getElementById('chartType4').value;

                                    console.log(chartType4);
                                }
                            </script>
                            <div class="row" style="margin:0;">

                                <div class="col-lg-5 ui-widget-content" style="display:none;margin: 25px 0 25px 15px;padding:10px; height:293px; width:507px;">
                                  <!-- <span  style="display:inline-block;"> -->
                                    <div class="form-group">
                                        <label>Chart Type:</label>
                                        <select name="chartType" class="" id="chartType0"  onchange=" setVal0();
                                                changeChartType('chartType0');
                                                ">
                                            <option value="bar">Bar</option>
                                            <option value="pie">Pie</option>
                                            <option value="polarArea">PolarArea</option>
                                            <option value="doughnut" selected>Doughnut</option>
                                            <option value="line">Line</option>
                                        </select>
                                    </div>
                                    <!-- </span> -->
                                    <span style="position: absolute; top: 40%; left: 10px; transform: rotate(270deg);">Views</span>
                                    <canvas id="canvas"  style="max-width: 90%;max-height: 85%;width:85%; height:85%;"></canvas>
                                    <h4 style="width:100%;text-align:center;position: absolute;bottom:  0;">Analytics</h4>
                                </div>

                                <div class="col-lg-5 ui-widget-content" style="display:none;margin: 25px 0 25px 15px;padding:10px;height:293px; width:507px;">
                                    <!-- <span  style="display:inline-block;"> -->
                                    <label>Chart Type:</label>
                                    <select name="chartType" class="" id="chartType1"  onchange=" setVal1();
                                            changeChartType('chartType1');">
                                        <option value="bar" selected>Bar</option>
                                        <option value="pie">Pie</option>
                                        <option value="polarArea" >PolarArea</option>
                                        <option value="doughnut">Doughnut</option>
                                        <option value="line">Line</option>
                                    </select>
                                    <!-- </span> -->
                                    <span style="position: absolute; top: 40%; left: 10px; transform: rotate(270deg);">Views</span>
                                    <canvas id="canvas1" style="max-width: 90%;max-height: 85%; width:85%; height:85%;"></canvas>
                                    <h4 style="width:100%;text-align:center;position: absolute;bottom:  0;">Category</h4>
                                </div>

                                <div class="col-lg-5 ui-widget-content" style="display:none;margin: 25px 0 25px 15px;padding:10px; height:293px; width:507px;">
                                    <span  style="display:inline-block;">
                                        <label>Chart Type:</label>
                                        <select name="chartType" class="" id="chartType2"  onchange=" setVal2(); changeChartType('chartType2');">
                                            <option value="bar">Bar</option>
                                            <option value="pie">Pie</option>
                                            <option value="polarArea">PolarArea</option>
                                            <option value="doughnut">Doughnut</option>
                                            <option value="line" selected>Line</option>
                                        </select>
                                    </span>
                                    <span style="position: absolute; top: 40%; left: 10px; transform: rotate(270deg);">Views</span>
                                    <canvas id="canvas2"  style="max-width: 90%;max-height: 85%; width:85%; height:85%;"></canvas>
                                    <h4 style="width:100%;text-align:center;position: absolute;bottom:  0;">Media Type</h4>
                                </div>

                                <div class="col-lg-5 ui-widget-content" style="display:none;margin: 25px 0 25px 15px;padding:10px; height:293px; width:507px;">
                                    <span  style="display:inline-block;">
                                        <label>Chart Type:</label>
                                        <select name="chartType" class="" id="chartType3"  onchange=" setVal3(); changeChartType('chartType3');">
                                            <option value="bar">Bar</option>
                                            <option value="pie" selected>Pie</option>
                                            <option value="polarArea">PolarArea</option>
                                            <option value="doughnut">Doughnut</option>
                                            <option value="line">Line</option>
                                        </select>
                                    </span>
                                    <span style="position: absolute; top: 40%; left: 10px; font-size: 16px; transform: rotate(270deg);">Views</span>
                                    <canvas id="canvas3"  style="max-width: 90%;max-height: 85%; width:85%; height:85%;"></canvas>
                                    <h4 style="width:100%;text-align:center;position: absolute;bottom:  0;">Area</h4>
                                </div>

                                <div class="col-lg-5 ui-widget-content" style="display:none;margin: 25px 0 25px 15px;padding:10px; height:293px; width:507px;">
                                    <span  style="display:inline-block;">
                                        <label>Chart Type:</label>
                                        <select name="chartType" class="" id="chartType4"  onchange=" setVal4(); changeChartType('chartType4');">
                                            <option value="bar">Bar</option>
                                            <option value="pie">Pie</option>
                                            <option value="polarArea" selected>PolarArea</option>
                                            <option value="doughnut">Doughnut</option>
                                            <option value="line">Line</option>
                                        </select>
                                    </span>
                                    <span style="position: absolute; top: 40%; left: 10px; transform: rotate(270deg);">Views</span>
                                    <canvas id="canvas4"  style="max-width: 90%;max-height: 85%; width:85%; height:85%;"></canvas>
                                    <h4 style="width:100%;text-align:center;position: absolute;bottom:  0;">Payment Status</h4>
                                </div>
                            </div>
                        </div>
                        <br>


                        <div class="footer">
                            <div class="footer-left">
                                <span>&copy; . Adverts Admin. All Rights Reserved.</span>
                            </div>
                            <div class="footer-right" style="padding-right: 10px">
                            </div>
                        </div>
                        <!--footer-->

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
                <!--<a href="http://www.keyurpatel.co.in">keyurdeveloper</a>-->
                .
            </strong>All rights reserved.
        </footer>


    </div>
    <!-- ./wrapper -->

    <div class="modal fade" id="vidModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                    <video id="vidSrc" width="100%" controls="" autoplay="">
                        <source src="" type="video/mp4"></video>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="imgModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                    <img id="imgSrc" width="100%" src="">
                </div>
            </div>

        </div>
    </div>




    <?php include('includes/footer.php'); ?>

<!-- <script src="js/Chart.js"></script> -->
    <script src="<?php echo SERVER ?>/js/lastChart.min.js"></script>

    <script src="<?php echo SERVER ?>/dateranger/moment.js"></script>
    <script src="<?php echo SERVER ?>/dateranger/daterangepicker.js"></script>


    <script>
                    var startTime = '';
                    var endTime = '';
                    var value;
                    var chartcount = 0;
                    function getAnalytics() {
                        chartcount = 0;
                        var barChartDemo = null,
                                barChartDemo1 = null,
                                barChartDemo2 = null,
                                barChartDemo3 = null,
                                barChartDemo4 = null;
                        new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/', document.getElementById('canvas'), 'friendly_name');
                        new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/categories/', document.getElementById('canvas1'), 'category');
                        new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/mediatype/', document.getElementById('canvas2'), 'media_type');
                        new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/area/', document.getElementById('canvas3'), 'area');
                        new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/paymentstatus/', document.getElementById('canvas4'), 'payment_status');
                    }
                    function changeChartType(selectedChart) {
                        //change chart type:

                        if (selectedChart == "chartType0") {
                            barChartDemo.destroy();
                            value = this.chartType0.value;
                            console.log("the value is " + value);
                            new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/', document.getElementById('canvas'), 'friendly_name');
                        }
                        if (selectedChart == "chartType1") {
                            barChartDemo1.destroy();
                            value = this.chartType1.value;
                            console.log("the value is " + value);
                            new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/categories/', document.getElementById('canvas1'), 'category');
                        }
                        if (selectedChart == "chartType2") {
                            barChartDemo2.destroy();
                            value = this.chartType2.value;
                            console.log("the value is " + value);
                            new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/mediatype/', document.getElementById('canvas2'), 'media_type');
                        }
                        if (selectedChart == "chartType3") {
                            barChartDemo3.destroy();
                            value = this.chartType3.value;
                            console.log("the value is " + value);
                            new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/area/', document.getElementById('canvas3'), 'area');
                        }
                        if (selectedChart == "chartType4") {
                            barChartDemo4.destroy();
                            value = this.chartType4.value;
                            console.log("the value is " + value);
                            new Analyst().getViews('https://bkapi.danderdee.com/api/data/analytics/paymentstatus/', document.getElementById('canvas4'), 'payment_status');
                        }
                    }

                    function sortBy(field, reverse, primer) {

                        var key = primer ?
                                function (x) {
                                    return primer(x[field])
                                } :
                                function (x) {
                                    return x[field]
                                };

                        reverse = !reverse ? 1 : -1;

                        return function (a, b) {
                            return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
                        }
                    }

                    function sort(select) {
                        var field = jQuery(select).val();
                        if (typeof (field) === String) {
                            advertData.sort(sortBy(field, false, function (a) {
                                return a.toUpperCase()
                            }));
                        } else {
                            advertData.sort(sortBy(field, false, parseInt));
                        }
                        fillToSelect();
                    }

                    function fillToSelect() {
                        var options = '';
                        advertData.forEach(function (value, index) {
                            options += "<option value='" + value.id + "'>" + (value.friendly_name == "" ? "no_name" : value.friendly_name);
                            +"</option>";
                        });

                        $("#graphForm select[name=adverts]").html(options);
                    }
                    var Analyst = function () {
                        this.getViews = function (url, canvas, field) {
                            if (this.canClickPreview === undefined) {
                                this.canClickPreview = true;
                            }
                            if (!this.canClickPreview) {
                                return;
                            }

                            this.canClickPreview = false;
                            jQuery('#loading').show();
                            var dData = function () {
                                return Math.round(Math.random() * 90) + 10
                            };
                            var barChartData = {
                                labels: [],
                                datasets: [{
                                        data: [],
                                        backgroundColor: 'rgba(0, 60, 100, 1)',
                                        borderColor: 'black',
                                        hoverBackgroundColor: 'rgba(0, 60, 100, 1)',
                                        hoverBorderColor: 'rgba(255,99,132,1)',
                                        borderWidth: 1
                                    }]
                            }


                            function fillData(barChartData, canvas) {
                                var getRandomColor = function () {
                                    var letters = '0123456789ABCDEF'.split('');
                                    var color = '#';
                                    for (var i = 0; i < 6; i++) {
                                        color += letters[Math.floor(Math.random() * 16)];
                                    }
                                    return color;
                                }
                                if (chartcount == 0) {
                                    value = 'bar';
                                    chartcount = 1;
                                } else if (chartcount == 1) {
                                    value = 'line';
                                    chartcount = 2;
                                } else if (chartcount == 2) {
                                    value = 'pie';
                                    chartcount = 3;
                                } else if (chartcount == 3) {
                                    value = 'polarArea';
                                    chartcount = 4;
                                } else if (chartcount == 4) {
                                    value = 'doughnut';
                                    chartcount = 5;
                                }

                                //var ctx = document.getElementById("canvas").getContext("2d");
                                var ctx = canvas.getContext("2d");
                                var chartOption = {
                                    type: this.value,
                                    data: barChartData,
                                    options: {
                                        animation: {
                                            duration: 3000
                                        },
                                        legend: {
                                            display: false
                                        },
                                        responsive: true,
                                        barValueSpacing: 2,
                                        scales: {
                                            yAxes: [{
                                                    scaleLabel: {
                                                        display: false,
                                                        labelString: 'probability'
                                                    },
                                                    ticks: {
                                                        beginAtZero: true,
                                                        endPoint: 4
                                                    }

                                                }]
                                        }
                                    }
                                }
                                // if (this.barChartDemo) {
                                //   barChartDemo.destroy();
                                // }
                                // barChartDemo = new Chart(ctx, chartOption);
                                //  barChartDemo.data.datasets.forEach(function (value) {
                                //    value.backgroundColor = getRandomColor();
                                // });
                                // barChartDemo.update();
                                if (canvas == document.getElementById('canvas'))
                                {
                                    if (this.barChartDemo) {
                                        barChartDemo.destroy();
                                    }
                                    barChartDemo = new Chart(ctx, chartOption);
                                    barChartDemo.data.datasets.forEach(function (value) {
                                        value.backgroundColor = [
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor()];
                                    });
                                    barChartDemo.update();
                                }
                                ///
                                if (canvas == document.getElementById('canvas1'))
                                {
                                    if (this.barChartDemo1) {
                                        barChartDemo1.destroy();
                                    }
                                    barChartDemo1 = new Chart(ctx, chartOption);
                                    barChartDemo1.data.datasets.forEach(function (value) {
                                        value.backgroundColor = [
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor()];
                                    });
                                    barChartDemo1.update();
                                }
                                ///
                                if (canvas == document.getElementById('canvas2'))
                                {
                                    if (this.barChartDemo2) {
                                        barChartDemo2.destroy();
                                    }
                                    barChartDemo2 = new Chart(ctx, chartOption);
                                    barChartDemo2.data.datasets.forEach(function (value) {
                                        value.backgroundColor = [
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor()];
                                    });
                                    barChartDemo2.update();
                                }
                                if (canvas == document.getElementById('canvas3'))
                                {
                                    if (this.barChartDemo3) {
                                        barChartDemo3.destroy();
                                    }
                                    barChartDemo3 = new Chart(ctx, chartOption);
                                    barChartDemo3.data.datasets.forEach(function (value) {
                                        value.backgroundColor = [
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor()];
                                    });
                                    barChartDemo3.update();
                                }
                                ///
                                if (canvas == document.getElementById('canvas4'))
                                {
                                    if (this.barChartDemo4) {
                                        barChartDemo4.destroy();
                                    }
                                    barChartDemo4 = new Chart(ctx, chartOption);
                                    barChartDemo4.data.datasets.forEach(function (value) {
                                        value.backgroundColor = [
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor(),
                                            getRandomColor()];
                                    });
                                    barChartDemo4.update();
                                }
                            }



                            function getAdvertIds() {
                                var data = '';
                                jQuery('#graphForm select[name=adverts] :selected').each(function (i, selected) {
                                    data += "ad_id=" + $(selected).text() + "&";
                                });
                                //return 'ad_id=569a9399c2c4b002e8755b77&';
                                return data;
                            }
                            console.log(getAdvertIds());

                            function getTimeRange() {
                                return "start_time=" + startTime + "&" + "end_time=" + endTime;
                            }

                            var token = localStorage.getItem("token");
                            var adIds = getAdvertIds();
                            var timeRange = getTimeRange();

                            /*if(adIds === '' || timeRange === '') {
                             this.canClickPreview = true;
                             jQuery('#loading').hide();
                             return;
                             }*/
                            var link = '';
                            var filterMode = jQuery("#graphForm select[name=filter]").val();
                            if (filterMode === "views") {
                                //link = "https://bkapi.danderdee.com/api/data/analytics/views/?" + adIds + "" + timeRange + "";
                                link = url + "/views/?" + adIds + "" + timeRange + "";
                                jQuery(canvas.id).prev().text("Views");
                            } else {
                                //link = "https://bkapi.danderdee.com/api/data/analytics/clicks/?" + adIds + "" + timeRange + "";
                                link = url + "/clicks/?" + adIds + "" + timeRange + "";
                                jQuery(canvas.id).prev().text("Clicks");
                            }
                            console.log(link);
                            jQuery.ajax({
                                url: link,
                                type: "GET",
                                beforeSend: function (request) {
                                    request.setRequestHeader("Authorization", token);
                                },
                                success: function (result) {
                                    canClickPreview = true;
                                    jQuery('#loading').hide();
                                    if (result != null) {
                                        if (result.length > 0) {
                                            canvas.parentElement.style.display = "block";
                                        }
                                        result.forEach(function (value, index) {
                                            barChartData.labels[index] = (value[field] == "" ? "no_name" : value[field]);
                                            barChartData.datasets[0].data[index] = value.view_counter_by_time;
                                        });
                                        fillData(barChartData, canvas);
                                    }

                                    console.log(result);
                                },
                                error: function (xhr, status, error) {
                                    jQuery('#loading').hide();
                                    canClickPreview = true;
                                    if (xhr.status == 401) {
                                        window.location.href = 'login.php?message=Invalid%20access%20token';
                                    }
                                },
                            });


                        }
                    }
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
                            startTime = new Date(start).toISOString();
                            endTime = new Date(end).toISOString();
                        });
                        startTime = new Date().toISOString();
                        endTime = new Date(futureDate).toISOString();
                    });
    </script>

</body>
</html>