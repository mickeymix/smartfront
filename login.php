<?php ob_start(); ?>
<?php session_start();

ini_set('display_errors', 1);
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

?>
<?php
error_reporting(~E_NOTICE);
include 'backoffice/conn.php';
if ($_GET["action"] == "logout") {
    session_destroy();
    header("Location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/register_form.css">
    <title>ร้านไทยจราจร</title>

    <?php

    require_once("header.php");

    require_once("account/login_user.php");

    $stats = "";
    $strAction = isset($_POST['action']) ? $_POST['action'] : '';
    if ($strAction == "1") {

        $conn = mysqli_connect($host, $user, $pass, $dbname);
        mysqli_set_charset($conn, "utf8");

        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "select * from users where email = '". $username ."' and cus_password = '". $password ."'";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            $customer_id = $result['customer_id'];
            $firstname = $result['firstname'];
            $lastname = $result['lastname'];

        }

        if (!empty($customer_id)) {
            $_SESSION["customer_id"] = $customer_id;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            header("Location:index.php");
        } else {
            echo "<script language=\"JavaScript\">";
            echo "alert('ไม่พบ email นี้อยู่ในระบบ')";
            echo "</script>";
        }
        mysqli_close($conn);
    }

    ?>

    <style>
        .submitButton {
            background-color: #d2322d;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .mixmixmxi {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <!-- <link href="css\login_form.css" rel="stylesheet"> -->

    <script>
        var bFbStatus = false;
        var fbID = "";
        var fbName = "";
        var fbEmail = "";

        $(document).keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $("#FORM_11").submit();
            }
        });

        window.fbAsyncInit = function() {
            FB.init({
                appId: '2089064421180393',
                cookie: true,
                xfbml: true,
                version: 'v3.2'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function statusChangeCallback(response) {

            if (bFbStatus == false) {
                fbID = response.authResponse.userID;

                if (response.status == 'connected') {
                    getCurrentUserInfo(response)
                } else {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            getCurrentUserInfo(response)
                        } else {
                            console.log('Auth cancelled.')
                        }
                    }, {
                        scope: 'email'
                    });
                }
            }
            bFbStatus = true;
        }

        function getCurrentUserInfo() {
            FB.api('/me?fields=name,email', function(userInfo) {

                fbName = userInfo.name;
                fbEmail = userInfo.email;

                $("#hdnFbID").val(fbID);
                $("#hdnName ").val(fbName);
                $("#hdnEmail").val(fbEmail);
                $("#frmMain").submit();

            });
        }

        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }
    </script>

    <div class="content-wrapper row">
        <div class="w3-row cf7_custom_style_1">
            <div class="container">
                <h3>ยินดีต้อนรับ กรุณาเข้าสู่ระบบ</h3>
                <hr>
            </div>
        </div>

        <div class="w3-half w3-container">
            <form id="FORM_11" method="post" action="login.php" style="padding-left: 50px">
                <div style="padding-left: 60px; padding-right: 60px">
                    <label for="email">อีเมล*</label>
                    <input type="text" placeholder="" id="namecus" name="username" style="height: 40px" required>
                    <br>
                    <label for="passwordtext">รหัสผ่าน*</label>
                    <input type="password" placeholder="" id="lastnamecus" name="password" style="height: 40px" required>
                    <br>
                    <input type="hidden" name="action" value="1">
                    <button type="submit" class="submitButton">เข้าสู่ระบบ</button>
                </div>
                <br>
            </form>
            <center>
                <p style="padding-left: 50px">หรือ</p>
            </center>

            <center>
                <div class="fb-login-button" style="padding-left: 70px" data-width="" data-size="large" data-button-type="login_with" data-use-continue-as="true" onlogin="checkLoginState();"></div>
            </center>
            <form action="login-callback.php" method="post" name="frmMain" id="frmMain">
                <input type="hidden" id="hdnFbID" name="hdnFbID">
                <input type="hidden" id="hdnName" name="hdnName">
                <input type="hidden" id="hdnEmail" name="hdnEmail">
            </form>
            <br>
        </div>
        <div class="w3-half w3-container">
            <div style="border:1px; border-style:solid; border-color:#ececec; background-color:#fafafa; padding: 1em; height: 300px">
                <div style="height: 300px; position: relative;">

                    <div class="mixmixmxi">
                       <center><h2>สมาชิกใหม่?</h2></center> <br>
                       <center>
                       <p>
                            สมัครสมาชิกเพื่อรับโปรโมชั่น สิทธิพิเศษ จากร้านไทยจราจร และเพิ่มความสะดวกรวดเร็วในการสั่งซื้อสินค้าครั้งต่อไป
                        </p>
                       </center>
                       <br>
                       <center><a href="register_smart.php" rel="noopener"><button type="submit" class="submitButton">สมัครสมาชิก</button></a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="w3-row">
        <div class="w3-half w3-container">
            <div class="w3-row">
                <div id="w3-container">
                    <h1 id="H1_7">
                        ยินดีต้อนรับ กรุณาเข้าสู่ระบบ
                    </h1>
                    <hr id="HR_8" />


                    <form id="FORM_11" method="post" action="login.php" style="padding-left: 50px">
                        <label id="LABEL_12">
                            อีเมล<span id="SPAN_13">*</span>
                            <input id="INPUT_14" name="username" type="text" />
                        </label>
                        <label id="LABEL_15">
                            รหัสผ่าน<span id="SPAN_16">*</span>
                            <input id="INPUT_17" name="password" type="password" /><img src="/icons/ios-eye.svg" id="IMG_18" alt='' />
                        </label>
                        <div id="DIV_19">

                            <div id="DIV_25">
                                <img src="/icons/ios-info.svg" id="IMG_26" alt='' />

                            </div><a href="/th/forgot_password" rel="noopener" id="A_28">ลืมรหัสผ่าน</a>
                        </div>
                        <div id="DIV_29">
                            <button name="submitButton" type="submit" id="BUTTON_30">
                                เข้าสู่ระบบ
                            </button>
                        </div>
                        <input type="hidden" name="action" value="1">
                    </form>

                   
                       <center><p id="P_31" style="padding-left: 50px">หรือ</p></center> 
                    
                   

                    <center>
                        <div class="fb-login-button" style="padding-left: 70px" data-width="" data-size="large" data-button-type="login_with" data-use-continue-as="true" onlogin="checkLoginState();"></div>
                    </center>
                    <form action="login-callback.php" method="post" name="frmMain" id="frmMain">
                        <input type="hidden" id="hdnFbID" name="hdnFbID">
                        <input type="hidden" id="hdnName" name="hdnName">
                        <input type="hidden" id="hdnEmail" name="hdnEmail">
                    </form>

                    <br />
                    <br />
                </div>
            </div>

        </div>
        <div class="w3-half w3-container">
            <div class="w3-row">
                <div class="w3-container">
                    <div id="DIV_33">
                        <div id="DIV_34">
                            <h2 id="H2_35">
                                สมาชิกใหม่?
                            </h2>
                            <p id="P_36">
                                สมัครสมาชิกเพื่อรับโปรโมชั่น สิทธิพิเศษ จากร้านไทยจราจร และเพิ่มความสะดวกรวดเร็วในการสั่งซื้อสินค้าครั้งต่อไป
                            </p><a href="register_smart.php" rel="noopener" id="A_37">สมัครสมาชิก</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div> -->

</body>

<?php
include 'footer.php';
?>