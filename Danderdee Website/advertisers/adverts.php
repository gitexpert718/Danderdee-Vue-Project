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
    var globalResult;

    var tableActive;
    var tablePaused;
    var tableStarting;
    var tableEnding;
    var tableAdvertView;
    var tableAdvertArea;
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
                    }).success(function (data) {
                        console.log(data);
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



        jQuery.ajax({
            url: "https://bkapi.danderdee.com/api/auth/accounts/",
            type: "GET",
            beforeSend: function (request) {
                request.setRequestHeader("Authorization", token);
            },
            success: function (result) {
                jQuery('#loading').hide();
                jQuery('.maincontentinner').show();
                jQuery('table').show();
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
                jQuery('.error-red').html(xhr.responseText);
            },
        });

        var table;

        jQuery('#username').change(function () {
            $('#ad_table').dataTable().fnDestroy();
            $('#ad_table_active').dataTable().fnDestroy();
            jQuery('#loading1').show();
            jQuery('#ad_table').hide();
            jQuery('#ad_table_active').hide();
            var username = jQuery(this).val();
            if (username != '') {
                jQuery('#ad_table tbody').html('');
                jQuery('#ad_table_active tbody').html('');
                jQuery.ajax({
                    url: "https://bkapi.danderdee.com/api/data/accounts/" + username + "/adverts",
                    type: "GET",
                    beforeSend: function (request) {
                        request.setRequestHeader("Authorization", token);
                    },
                    success: function (result) {
                        globalResult = result;
                        jQuery('#loading1').hide();
                        jQuery('#ad_table').show();
                        var option = '';
                        jQuery(result).each(function (i, value) {
                            var tr = "<tr>";
                            tr += "<td>" + value.id + "</td>";
                            tr += "<td>" + createTag(value.media_URL) + "</td>";
                            tr += "<td>" + value.type + "</td>";
                            tr += "<td>" + value.id + "</td>";
                            tr += "<td>" + value.status + "</td>";
                            tr += "<td>" + value.rank + "</td>";
                            tr += "<td>" + value.category + "</td>";
                            tr += "<td>" + value.location + "</td>";
                            tr += "<td>" + value.area_id + "</td>";

                            tr += "<td>" + moment(new Date(value.launch_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
                            tr += "<td>" + moment(new Date(value.end_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
                            //var launch_time = value.launch_time;
                            //var dateTimeArray = launch_time.split('T');
                            //var dateArray = dateTimeArray[0].split('-');
                            //var timeArray = dateTimeArray[1].split(':');
                            //var secondsArray = timeArray[2].split('+');
                            //var secondsOnlyArray = secondsArray[0].split('.');
                            //var current_launch_time = dateArray[2] + '/' + dateArray[1] + '/' + dateArray[0] + ' ' + timeArray[0] + ':' + timeArray[1] + ':' + secondsOnlyArray[0];
                            //tr += "<td>" + current_launch_time + "</td>";
                            //var launch_time = value.end_time;
                            //var dateTimeArray = launch_time.split('T');
                            //var dateArray = dateTimeArray[0].split('-');
                            //var timeArray = dateTimeArray[1].split(':');
                            //var secondsArray = timeArray[2].split('+');
                            //var secondsOnlyArray = secondsArray[0].split('.');
                            //var current_end_time = dateArray[2] + '/' + dateArray[1] + '/' + dateArray[0] + ' ' + timeArray[0] + ':' + timeArray[1] + ':' + secondsOnlyArray[0];
                            //tr += "<td>" + current_end_time + "</td>";
                            tr += "<td><a href='edit_ad.html?id=" + value.id + "' ><button type='button' class='btn btn-success'>edit</button></a></td>";
                            tr += "</tr>";
                            jQuery('#ad_table tbody').append(tr);
                        });
                        jQuery('#username').append(option);
                        table = $('#ad_table').DataTable({
                            "order": [[4, "asc"]],
                            'columnDefs': [{
                                    'targets': 0,
                                    'searchable': false,
                                    'orderable': false,
                                    'className': 'dt-body-center',
                                    'render': function (data, type, full, meta) {
                                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                                    }
                                }],
                        });


                        AdvertsPerView = function () {
                            jQuery.ajax({
                                url: "https://bkapi.danderdee.com/api/data/analytics/views",
                                type: "GET",
                                beforeSend: function (request) {
                                    request.setRequestHeader("Authorization", token);
                                },
                                success: function (result) {
                                    jQuery('#ad_table_advert_view').show();
                                    var option = '';
                                    jQuery(result).each(function (i, value) {
                                        var tr = "<tr>";
                                        tr += "<td>" + value.id + "</td>";
                                        tr += "<td>" + createTag(value.media_URL) + "</td>";
                                        tr += "<td>" + value.type + "</td>";
                                        tr += "<td>" + value.id + "</td>";
                                        tr += "<td>" + value.status + "</td>";
                                        tr += "<td>" + value.rank + "</td>";
                                        tr += "<td>" + value.category + "</td>";
                                        tr += "<td>" + value.view_counter_by_time + "</td>";
                                        tr += "<td>" + value.area_id + "</td>";

                                        tr += "<td>" + moment(new Date(value.launch_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
                                        tr += "<td>" + moment(new Date(value.end_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
                                        tr += "<td><a href='edit_ad.html?id=" + value.id + "' ><button type='button' class='btn btn-success'>edit</button></a></td>";
                                        tr += "</tr>";
                                        jQuery('#ad_table_advert_view tbody').append(tr);
                                    });

                                    if ($.fn.dataTable.isDataTable('#ad_table_advert_view')) {
                                        $('#ad_table_advert_view').DataTable().destroy();
                                    }

                                    tableAdvertView = $('#ad_table_advert_view').DataTable({
                                        "order": [[4, "asc"]],
                                        'columnDefs': [{
                                                'targets': 0,
                                                'searchable': false,
                                                'orderable': false,
                                                'className': 'dt-body-center',
                                                'render': function (data, type, full, meta) {
                                                    return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                                                }
                                            }],
                                    });
                                },
                                error: function (xhr, status, error) {
                                    if (xhr.status == 401) {
                                        window.location.href = 'login.php?message=Invalid%20access%20token';
                                    }
                                    jQuery('#ad_table').show();

                                    jQuery('.error-red').html(xhr.responseText);
                                },
                            });
                        }
                        AreaWithMoreAdvert = function () {
                            jQuery.ajax({
                                url: "https://bkapi.danderdee.com/api/data/analytics/area/clicks",
                                type: "GET",
                                beforeSend: function (request) {
                                    request.setRequestHeader("Authorization", token);
                                },
                                success: function (result) {
                                    jQuery('#ad_table_advert_area').show();
                                    var option = '';
                                    jQuery(result).each(function (i, value) {
                                        var tr = "<tr>";
                                        tr += "<td>" + value.area + "</td>";
                                        tr += "<td>" + value.view_counter_by_time + "</td>";
                                        tr += "<td>" + value.click_counter_by_time + "</td>";
                                        tr += "</tr>";

                                        jQuery('#ad_table_advert_area tbody').append(tr);
                                    });

                                    if ($.fn.dataTable.isDataTable('#ad_table_advert_area')) {
                                        $('#ad_table_advert_area').DataTable().destroy();
                                    }

                                    //tableAdvertArea = $('#ad_table_advert_area').DataTable({
                                    //    "order": [[3, "asc"]],
                                    //    'columnDefs': [{
                                    //        'targets': 0,
                                    //        'searchable': false,
                                    //        'orderable': false,
                                    //        'className': 'dt-body-center'
                                    //    }],
                                    //});
                                },
                                error: function (xhr, status, error) {
                                    if (xhr.status == 401) {
                                        window.location.href = 'login.php?message=Invalid%20access%20token';
                                    }
                                    jQuery('#ad_table_advert_area').show();

                                    jQuery('.error-red').html(xhr.responseText);
                                },
                            })
                        }

                        setActiveAdverts(result);
                        setPausedAdverts(result);
                        setAdvertStartingSoon(parseInt(jQuery("#startSoonDays").val()), result);
                        setAdvertEndingSoon(parseInt(jQuery("#endSoonDays").val()), result);
                        AdvertsPerView();
                        AreaWithMoreAdvert();
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status == 401) {
                            window.location.href = 'login.php?message=Invalid%20access%20token';
                        }
                        jQuery('#loading1').hide();
                        jQuery('#ad_table').show();

                        jQuery('.error-red').html(xhr.responseText);
                    },
                });
            }
        });

        var rows_selected = [];

        $('#ad_table tbody').on('change', 'input[type="checkbox"]', function () {
            var index = $.inArray(this.value, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(this.value);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }
        });

        $('#ad_table_active tbody').on('change', 'input[type="checkbox"]', function () {
            var index = $.inArray(this.value, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(this.value);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }
        });

        $('#ad_table_paused tbody').on('change', 'input[type="checkbox"]', function () {
            var index = $.inArray(this.value, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(this.value);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }
        });

        $('#ad_table_starting tbody').on('change', 'input[type="checkbox"]', function () {
            var index = $.inArray(this.value, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(this.value);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }
        });

        $('#ad_table_ending tbody').on('change', 'input[type="checkbox"]', function () {
            var index = $.inArray(this.value, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(this.value);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }
        });

        $('#ad_table_advert_view tbody').on('change', 'input[type="checkbox"]', function () {
            var index = $.inArray(this.value, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(this.value);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }
        });

        $('#ad_table-select-all').on('click', function () {
            var rows = table.rows({page: 'current'}).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            if (this.checked) {
                $.each(rows, function (index, value) {
                    rows_selected.push($(value.cells[0]).find(":checkbox").val());
                });
            } else {
                rows_selected = [];
            }

        });

        $('#ad_table_active-select-all').on('click', function () {
            var rows = tableActive.rows({page: 'current'}).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            if (this.checked) {
                $.each(rows, function (index, value) {
                    rows_selected.push($(value.cells[0]).find(":checkbox").val());
                });
            } else {
                rows_selected = [];
            }

        });

        $('#ad_table_paused-select-all').on('click', function () {
            var rows = tablePaused.rows({page: 'current'}).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            if (this.checked) {
                $.each(rows, function (index, value) {
                    rows_selected.push($(value.cells[0]).find(":checkbox").val());
                });
            } else {
                rows_selected = [];
            }

        });

        $('#ad_table_starting-select-all').on('click', function () {
            var rows = tableStarting.rows({page: 'current'}).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            if (this.checked) {
                $.each(rows, function (index, value) {
                    rows_selected.push($(value.cells[0]).find(":checkbox").val());
                });
            } else {
                rows_selected = [];
            }

        });

        $('#ad_table_ending-select-all').on('click', function () {
            var rows = tableEnding.rows({page: 'current'}).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            if (this.checked) {
                $.each(rows, function (index, value) {
                    rows_selected.push($(value.cells[0]).find(":checkbox").val());
                });
            } else {
                rows_selected = [];
            }

        });

        $('#ad_table_advert_view-select-all').on('click', function () {
            var rows = tableEnding.rows({page: 'current'}).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            if (this.checked) {
                $.each(rows, function (index, value) {
                    rows_selected.push($(value.cells[0]).find(":checkbox").val());
                });
            } else {
                rows_selected = [];
            }

        });

        $('#startSoonDays').change(function () {
            setAdvertStartingSoon(parseInt($(this).val()), globalResult);
        });

        $('#endSoonDays').change(function () {
            setAdvertEndingSoon(parseInt($(this).val()), globalResult);
        });

        jQuery('#delete').click(function () {
            if (confirm("Are you sure want to delete selected Ads?")) {
                jQuery('.error-red').html('Deleting User');
                var count = 0;
                $.each(rows_selected, function (index, value) {
                    jQuery.ajax({
                        url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + value + "?access_token=" + token,
                        type: "DELETE",
                        access_token: token,
                        success: function (result) {
                            jQuery('.error-red').html('Adv deleted Successfully');
                        },
                        error: function (xhr, status, error) {
                            jQuery('.error-red').html('Adv deleted Successfully');
                            count++;
                            if (count == rows_selected.length) {
                                var select_Val = $('#username').val();
                                $('#username').val(select_Val).trigger('change');
                            }
                        },
                    });
                });
            }
        });

        jQuery('#state_button').click(function () {
            jQuery('.error-red').html('Setting Adverts State');
            var count = 0;
            var data = jQuery("#form4").serializeArray();
            jQuery.each(data, function (i, val) {
                if (this.name == 'access_token') {
                    this.value = token;
                }
            });
            $.each(rows_selected, function (index, value) {
                jQuery.ajax({
                    url: "https://bkapi.danderdee.com/api/data/accounts/admin/adverts/" + value + "/state",
                    type: "POST",
                    data: data,
                    success: function (result) {
                        count++;
                        if (count == rows_selected.length) {
                            var select_Val = $('#username').val();
                            $('#username').val(select_Val).trigger('change');
                        }
                        jQuery('.error-red').html('Adverts State set Successfully');
                    },
                    error: function (xhr, status, error) {
                        count++;
                        if (count == rows_selected.length) {
                            var select_Val = $('#username').val();
                            $('#username').val(select_Val).trigger('change');
                        }
                        jQuery('.error-red').html("Adverts State set Successfully");
                    },
                });
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


    function setActiveAdverts(result) {
        jQuery('#ad_table_active').show();
        var option = '';
        jQuery(result).each(function (i, value) {
            if (value.status !== 'active') {
                return;
            }
            var tr = "<tr>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + createTag(value.media_URL) + "</td>";
            tr += "<td>" + value.type + "</td>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + value.status + "</td>";
            tr += "<td>" + value.rank + "</td>";
            tr += "<td>" + value.category + "</td>";
            tr += "<td>" + value.location + "</td>";
            tr += "<td>" + value.area_id + "</td>";

            tr += "<td>" + moment(new Date(value.launch_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td>" + moment(new Date(value.end_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td><a href='edit_ad.html?id=" + value.id + "' ><button type='button' class='btn btn-success'>edit</button></a></td>";
            tr += "</tr>";
            jQuery('#ad_table_active tbody').append(tr);
        });

        if ($.fn.dataTable.isDataTable('#ad_table_active')) {
            $('#ad_table_active').DataTable().destroy();
        }
        //jQuery('#username').append(option);
        tableActive = $('#ad_table_active').DataTable({
            "order": [[4, "asc"]],
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
                }],
        });
    }

    function setPausedAdverts(result) {
        jQuery('#ad_table_paused').show();
        var option = '';
        jQuery(result).each(function (i, value) {
            if (value.status !== 'paused') {
                return;
            }
            var tr = "<tr>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + createTag(value.media_URL) + "</td>";
            tr += "<td>" + value.type + "</td>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + value.status + "</td>";
            tr += "<td>" + value.rank + "</td>";
            tr += "<td>" + value.category + "</td>";
            tr += "<td>" + value.location + "</td>";
            tr += "<td>" + value.area_id + "</td>";

            tr += "<td>" + moment(new Date(value.launch_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td>" + moment(new Date(value.end_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td><a href='edit_ad.html?id=" + value.id + "' ><button type='button' class='btn btn-success'>edit</button></a></td>";
            tr += "</tr>";
            jQuery('#ad_table_paused tbody').append(tr);
        });

        if ($.fn.dataTable.isDataTable('#ad_table_paused')) {
            $('#ad_table_paused').DataTable().destroy();
        }

        tablePaused = $('#ad_table_paused').DataTable({
            "order": [[4, "asc"]],
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
                }],
        });
    }

    function setAdvertStartingSoon(days, result) {
        jQuery('#ad_table_starting').show();
        var option = '';
        jQuery(result).each(function (i, value) {
            compare = function () {
                var currentDate = new Date();
                var futureDate = new Date();
                futureDate.setDate(futureDate.getDate() + days);
                var targetDate = new Date(value.launch_time);
                var result = futureDate.getTime() > targetDate.getTime() && targetDate.getTime() > currentDate;
                return result;
            }
            if (!compare()) {
                return;
            }
            var tr = "<tr>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + createTag(value.media_URL) + "</td>";
            tr += "<td>" + value.type + "</td>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + value.status + "</td>";
            tr += "<td>" + value.rank + "</td>";
            tr += "<td>" + value.category + "</td>";
            tr += "<td>" + value.location + "</td>";
            tr += "<td>" + value.area_id + "</td>";

            tr += "<td>" + moment(new Date(value.launch_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td>" + moment(new Date(value.end_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td><a href='edit_ad.html?id=" + value.id + "' ><button type='button' class='btn btn-success'>edit</button></a></td>";
            tr += "</tr>";
            jQuery('#ad_table_starting tbody').append(tr);
        });

        if ($.fn.dataTable.isDataTable('#ad_table_starting')) {
            $('#ad_table_starting').DataTable().destroy();
        }

        tableStarting = $('#ad_table_starting').DataTable({
            "order": [[4, "asc"]],
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
                }],
        });
    }

    function setAdvertEndingSoon(days, result) {
        jQuery('#ad_table_ending').show();
        var option = '';
        jQuery(result).each(function (i, value) {
            compare = function () {
                var currentDate = new Date();
                var futureDate = new Date();
                futureDate.setDate(futureDate.getDate() + days);
                var targetDate = new Date(value.end_time);
                var result = futureDate.getTime() > targetDate.getTime() && targetDate.getTime() > currentDate;
                return result;
            }
            if (!compare()) {
                return;
            }
            var tr = "<tr>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + createTag(value.media_URL) + "</td>";
            tr += "<td>" + value.type + "</td>";
            tr += "<td>" + value.id + "</td>";
            tr += "<td>" + value.status + "</td>";
            tr += "<td>" + value.rank + "</td>";
            tr += "<td>" + value.category + "</td>";
            tr += "<td>" + value.location + "</td>";
            tr += "<td>" + value.area_id + "</td>";

            tr += "<td>" + moment(new Date(value.launch_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td>" + moment(new Date(value.end_time)).format("MM/DD/YYYY HH:mm:ss") + "</td>";
            tr += "<td><a href='edit_ad.html?id=" + value.id + "' ><button type='button' class='btn btn-success'>edit</button></a></td>";
            tr += "</tr>";
            jQuery('#ad_table_ending tbody').append(tr);
        });

        if ($.fn.dataTable.isDataTable('#ad_table_ending')) {
            $('#ad_table_ending').DataTable().destroy();
        }

        tableEnding = $('#ad_table_ending').DataTable({
            "order": [[4, "asc"]],
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
                }],
        });
    }
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
                <h1>Adverts
                    <!--<small>it all starts here</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="mainpage.html"><i class="fa fa-home"></i></a></li>
                    <li><a href="Adverts.html">Adverts</a></li>
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
                        <div class="">

                            <div class="row">
                                <div class="col-lg-5 col-lg-offset-5 center-block" style="float:none;">

                                    <div class="controls form-group">
                                        <select name="username" id="username" class="required form-control">
                                            <option value="">---select---</option>
                                        </select>
                                    </div>
                                    <div class="row-fluid">

                                        <div class="">
                                            <div id="loading1" style="width: 100%; text-align: center; display: none">
                                                <img src="images/loading.gif" />
                                            </div>
                                            <div class="error-red" style="color: red">
                                            </div>

                                            <form id="form4" class="form4 stdform form-inline">
                                                <input type="hidden" name="access_token" id="access_token" />

                                                <div class="form-group">
                                                    <select style="margin-top:3px;" name="state" id="state" class="form-control required">
                                                        <option value="paused">paused</option>
                                                        <option value="active">active</option>
                                                    </select>
                                                    <input style="margin-top:3px;" type="button" id="state_button" name="submit" class="form-control btn btn-primary" value="Submit" />
                                                    <input style="margin-top:3px;" type="button" id="delete" name="delete" class="form-control btn btn-danger" value="Delete Selected Adv" />
                                                </div>

                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="table-responsive">
                                <table id="ad_table" class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" value="1" id="ad_table-select-all"></th>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Advert id</th>
                                            <th>Status</th>
                                            <th>Rank</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Area id</th>
                                            <th>Launch Time</th>
                                            <th>End Time</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <br />
                            <h3>Active Adverts</h3>

                            <div class="table-responsive">
                                <table id="ad_table_active" class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" value="1" id="ad_table_active-select-all"></th>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Advert id</th>
                                            <th>Status</th>
                                            <th>Rank</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Area id</th>
                                            <th>Launch Time</th>
                                            <th>End Time</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <br />
                            <h3>Paused Adverts</h3>

                            <div class="table-responsive">
                                <table id="ad_table_paused" class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" value="1" id="ad_table_paused-select-all"></th>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Advert id</th>
                                            <th>Status</th>
                                            <th>Rank</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Area id</th>
                                            <th>Launch Time</th>
                                            <th>End Time</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <br />
                            <h3>Adverts Starting Soon in
                                <select id="startSoonDays">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                    <option>30</option>
                                </select>
                                days</h3>

                            <div class="table-responsive">
                                <table id="ad_table_starting" class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" value="1" id="ad_table_starting-select-all"></th>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Advert id</th>
                                            <th>Status</th>
                                            <th>Rank</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Area id</th>
                                            <th>Launch Time</th>
                                            <th>End Time</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <br />
                            <h3>Adverts Ending Soon in
                                <select id="endSoonDays">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                    <option>30</option>
                                </select>
                                days</h3>

                            <div class="table-responsive">
                                <table id="ad_table_ending" class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" value="1" id="ad_table_ending-select-all"></th>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Advert id</th>
                                            <th>Status</th>
                                            <th>Rank</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Area id</th>
                                            <th>Launch Time</th>
                                            <th>End Time</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>


                            <br />
                            <h3>Adverts By View</h3>

                            <div class="table-responsive">
                                <table id="ad_table_advert_view" class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" value="1" id="ad_table_advert_view-select-all"></th>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Advert id</th>
                                            <th>Status</th>
                                            <th>Rank</th>
                                            <th>Category</th>
                                            <th>Views</th>
                                            <th>Area id</th>
                                            <th>Launch Time</th>
                                            <th>End Time</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <br />
                            <h3>Area By Adverts</h3>

                            <div class="table-responsive">
                                <table id="ad_table_advert_area" class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th>Area</th>
                                            <th>Advert Views</th>
                                            <th>Advert Clicks</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>



                            <!--row-fluid-->

                            <div class="footer">
                                <div class="footer-left">
                                    <span>&copy; . Adverts Admin. All Rights Reserved.</span>
                                </div>
                                <div class="footer-right" style="padding-right: 10px">
                                </div>
                            </div>
                            <!--footer-->

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

    <script type="text/javascript">
        function createTag(src) {
            src = src.trim();
            if (src === '') {
                return '<img src="images/no-image.png" height=50px width=50px>';
            } else if (src.endsWith('.mp4')) {
                return '<a onclick="loadVid(this, event)" href="' + src + '"><img src="images/vid.png" height=50px width=50px ></a>';
            }
            return '<a onclick="loadImg(this, event)" href="' + src + '"><img src="' + src + '" height=50px width=50px onerror="handleError(this)"></a>';
        }
        function loadVid(a, e) {
            e.preventDefault();
            var src = '<source src="' + jQuery(a).attr('href') + '" type="video/mp4">';
            jQuery("#vidSrc").html(src);
            jQuery("#vidSrc").load();
            jQuery('#vidModal').modal('show');
        }
        function stopVid() {
            document.getElementById("vidSrc").pause();
        }
        function loadImg(a, e) {
            e.preventDefault();
            var src = jQuery(a).attr('href');
            jQuery("#imgSrc").attr('src', src);
            jQuery('#imgModal').modal('show');
        }
        function handleError(a) {
            a.onerror = null;
            a.src = "images/no-image.png";
        }
        $('#vidModal').on('hidden.bs.modal', function (e) {
            stopVid();
        })
    </script>


</body>
</html>