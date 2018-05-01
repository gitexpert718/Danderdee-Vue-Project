<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="referrer" content="no-referrer" />
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"
    />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-1.11.2.min.js"></script>
    <script>
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
        $(document).ready(function () {
            $("#register-form").css('display', 'none');
            var token = localStorage.getItem("token");
            //if (token) {
            //    window.location.href = 'mainpage.html';
            //}
            var message = getUrlParameter('message');
            if (message != '' && message != null) {
                //$('.error').html(message.replace('%20',' '));
                $('.error').html(message.split('%20').join(' '));
            }

            $('#register-btn').click(function () {
                $("#register-form").css('display', 'block');
                $("#login-form").css('display', 'none');
                $('#label').html('Registration');
            });

            $('#back').click(function () {
                $("#register-form").css('display', 'none');
                $("#login-form").css('display', 'block');
                $('#label').html('Login');
            });

            $('#register-submit').click(function () {
                $('.error').html('Registering now');
                var data = $("#register-form").serialize();

                $.ajax({
                    url: "https://bkapi.danderdee.com/api/public/createaccount?" + data,
                    type: "POST",
                    success: function (result) {
                        $('.error').html('Successfully logged in. Redirecting ....');
                        //document.cookie="token="+result.access_token;
                        localStorage.setItem("token", result.access_token);
                        localStorage.setItem("userName", result.role.ID);
                        window.location.href = 'mainpage.php';
                    },
                    error: function (xhr, status, error) {
                        $('.error').html(error);
                    },
                });
            });

            $('#submit').click(function () {
                $('.error').html('Logging in');
                var data = $("#login-form").serialize();

                $.ajax({
                    url: "https://bkapi.danderdee.com/api/public/token/password?" + data,
                    type: "POST",
                    success: function (result) {
                        $('.error').html('Successfully logged in. Redirecting ....');
                        //document.cookie="token="+result.access_token;
                        localStorage.setItem("token", result.access_token);
                        localStorage.setItem("userName", result.role.ID);
                        window.location.href = 'mainpage.php';
                    },
                    error: function (xhr, status, error) {
                        $('.error').html(error);
                    },
                });
            });
        });
    </script>
</head>

<body class="grey-bg">
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12&appId=2132799073618737&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2132799073618737',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.12'
    });

    FB.AppEvents.logPageView();

	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});

  };

	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	function statusChangeCallback(response) {
        if (response.authResponse == null) return;

        FB.api('/me?fields=first_name,last_name,picture', 'get', {accessToken: response.authResponse.accessToken}, function(resp) {
            localStorage.setItem("token", response.authResponse.accessToken);
            localStorage.setItem("userName", resp.id);
            console.log(resp);
            
            window.location = 'mainpage.php';
        });
	}

</script>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-form-margin">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <strong class="" id="label">Login</strong>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="login-form">
                            <div class="error" style="color:red">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" id="inputUsername" placeholder="username" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required />
                                </div>
                            </div>
                            <div class="form-group last">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="button" class="btn btn-success btn-sm" value="SIgn In" id="submit" />
                                    <button type="reset" class="btn btn-default btn-sm">Reset</button>
                                </div>
                            </div>

                            <div class="create-account">
                                <p>
                                    <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
                                </p>
                            </div>
                        </form>


                        <form class='form-horizontal' role='form' name="myForm" id='register-form'>
                            <div class="error" style="color:red">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">foreName</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="forename" class="form-control " placeholder="foreName"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">sureName</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="surename" class="form-control " placeholder="sureName"  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Email</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="email" name="email" class="form-control " placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Notes</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="password" name="notes" class="form-control " placeholder="Notes"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Password</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="password" name="password" class="form-control " placeholder="Password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Photo</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="file" name="photo" class="form-control "  />
                                </div>
                            </div>

                            <div class="form-group last">
                                <div class="col-sm-offset-3 col-sm-9 col-xs-12">
                                    <button type="reset" class="btn btn-default btn-sm" id="back">Back</button>
                                    <input type="button" class="btn btn-success btn-sm" value="SIgn Up" id="register-submit" />
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
			<div class="col-md-4">
				<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false" data-scope="public_profile,email" data-onlogin="checkLoginState()"></div>
			</div>
        </div>
    </div>
</body>

</html>
