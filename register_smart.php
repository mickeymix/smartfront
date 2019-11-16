<? ob_start(); ?>
<? session_start();
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/register_form.css">


    <title>ร้านไทยจราจร</title>

    <?

    require_once("header.php");

    require_once("account/login_user.php");
x
    ?>
    <style>
        .registerbtn {
            background-color: #d2322d;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        ul.checkmark {
            list-style-type: none;
        }

        ul.checkmark li:before {
            content: "\2713\0020";
            font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;
        }

        li {
            list-style-type: none;
        }
    </style>

</head>

<body>

    <div class="content-wrapper row">
        <div class="w3-row cf7_custom_style_1">
            <div class="container">
                <h3>สร้างบัญชี SmartBestbuy</h3>
                <h6>สมัครสมาชิกเพื่อรับโปรโมชั่น และเพิ่มความสะดวกรวดเร็วในการสั่งซื้อสินค้าครั้งถัดไป</h6>
                <ul class="list-inline">
                    <li class="active"><a data-toggle="tab" href="#home" style="padding-bottom: 6px">บุคคลทั่วไป</a></li>
                    <li><a data-toggle="tab" href="#menu1" style="padding-bottom: 6px">นิติบุคคล</a></li>
                    <hr>

                </ul>
            </div>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="w3-half w3-container">
                        <form action="" name="frmMain" id="frmMain" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email"><b>ชื่อ*</b></label>
                                    <input type="text" placeholder="" id="namecus" name="namecus" style="height: 40px" required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="email"><b>นามสกุล*</b></label>
                                    <input type="text" placeholder="" id="lastnamecus" name="lastnamecus" style="height: 40px" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email"><b>อีเมล*</b></label>
                                    <input type="email" placeholder="" id="email" name="email" style="height: 40px" required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="email"><b>โทรศัพท์มือถือ*</b></label>
                                    <input type="text" placeholder="" id="phonenumber" name="phonenumber" style="height: 40px" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email"><b>รหัสผ่าน*</b></label>
                                    <input type="password" placeholder="" id="password_cus" name="password_cus" style="height: 40px" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <button type="submit" class="registerbtn" onclick="onSubmitClickRegister()">สมัครสมาชิก</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="w3-half w3-container">
                        <p align="right">เป็นสมาชิกอยู่แล้วหรือ? <a href="login.php" rel="noopener" id="A_3">เข้าสู่ระบบ</a> ที่นี่</p>
                        <div style="border:1px; border-style:solid; border-color:#ececec; background-color:#fafafa; padding: 1em;">
                            <center>
                                <h2>หรือ เชื่อมต่อกับบัญชีออนไลน์</h2>
                            </center><br>
                            <center>
                                <div class="fb-login-button" data-width="" data-size="large" data-button-type="login_with" data-use-continue-as="true" onlogin="checkLoginState();"></div>
                            </center>
                            <form action="login-callback.php" method="post" name="frmMain" id="frmMain">
                                <input type="hidden" id="hdnFbID" name="hdnFbID">
                                <input type="hidden" id="hdnName" name="hdnName">
                                <input type="hidden" id="hdnEmail" name="hdnEmail">
                            </form>
                        </div>

                        <div style="border:1px; border-style:solid; border-color:#cbdff3; background-color:#f6fafe; padding: 1em; margin-top: 30px; margin-bottom: 30px">
                            <h2 style="padding-left: 20px">สมัครสมาชิกกับsmartbestbuy</h2><br>
                            <h6 style="padding-left: 20px">เพื่อเพิ่มความสะดวกรวดเร็วในการซื้อสินค้าครั้งถัดไป</h6>
                            <ul class="checkmark">
                                <li>
                                    สั่งซื้อสินค้ารวดเร็ว
                                </li>
                                <li>
                                    เปิดการใช้งานระบบการอนุมัติการสั่งซื้อ สำหรับลูกค้านิติบุคคล
                                </li>
                                <li>
                                    บันทึกบัตรเครดิตไว้ใช้ครั้งถัดไป
                                </li>
                                <li>
                                    ติดตามออเดอร์
                                </li>
                                <li>
                                    สั่งซื้อสินค้าที่เคยสั่ง
                                </li>
                                <li>
                                    ดูรายการสั่งซื้อย้อนหลัง
                                </li>
                                <li>
                                    เก็บสินค้าชื่นชอบไว้สั่งซื้อภายหลัง
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="menu1" class="tab-pane fade">
                    <div class="w3-half w3-container">
                        <form action="" name="frmMainCom" id="frmMainCom" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email"><b>ชื่อ*</b></label>
                                    <input type="text" placeholder="" id="namecompanycus" name="namecompanycus" style="height: 40px" required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="email"><b>นามสกุล*</b></label>
                                    <input type="text" placeholder="" id="lastnamecompanycus" name="lastnamecompanycus" style="height: 40px" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email"><b>ชื่อบริษัท*</b></label>
                                    <input type="text" placeholder="" id="comnapy" name="comnapy" style="height: 40px" required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="email"><b>โทรศัพท์มือถือ*</b></label>
                                    <input type="text" placeholder="" id="phonenumbercompany" name="phonenumbercompany" style="height: 40px" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="email"><b>อีเมล์*</b></label>
                                    <input type="email" placeholder="" id="emailcompany" name="emailcompany" style="height: 40px" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email"><b>รหัสผ่าน*</b></label>
                                    <input type="password" placeholder="" id="password_companycus" name="password_companycus" style="height: 40px" required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="email"><b>เลขประจำตัวผู้เสียภาษีอากร*</b></label>
                                    <input type="text" placeholder="" id="taxref" name="taxref" style="height: 40px" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <button type="submit" class="registerbtn" onclick="onRegisterCompany()">สมัครสมาชิก</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="w3-half w3-container">
                        <p align="right">เป็นสมาชิกอยู่แล้วหรือ? <a href="login.php" rel="noopener" id="A_3">เข้าสู่ระบบ</a> ที่นี่</p>

                        <div style="border:1px; border-style:solid; border-color:#cbdff3; background-color:#f6fafe; padding: 1em; margin-bottom: 30px">
                            <h2 style="padding-left: 20px">สมัครสมาชิกกับsmartbestbuy</h2><br>
                            <h6 style="padding-left: 20px">เพื่อเพิ่มความสะดวกรวดเร็วในการซื้อสินค้าครั้งถัดไป</h6>
                            <ul class="checkmark">
                                <li>
                                    สั่งซื้อสินค้ารวดเร็ว
                                </li>
                                <li>
                                    เปิดการใช้งานระบบการอนุมัติการสั่งซื้อ สำหรับลูกค้านิติบุคคล
                                </li>
                                <li>
                                    บันทึกบัตรเครดิตไว้ใช้ครั้งถัดไป
                                </li>
                                <li>
                                    ติดตามออเดอร์
                                </li>
                                <li>
                                    สั่งซื้อสินค้าที่เคยสั่ง
                                </li>
                                <li>
                                    ดูรายการสั่งซื้อย้อนหลัง
                                </li>
                                <li>
                                    เก็บสินค้าชื่นชอบไว้สั่งซื้อภายหลัง
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <script>
            var bFbStatus = false;
            var fbID = "";
            var fbName = "";
            var fbEmail = "";

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

        <script>
            function onSubmitClickRegister() {
                // var x = document.forms["namecus"]["lastnamecus"]["password_cus"]["email"]["phonenumber"].value;
                // if (x == "") {
                //     alert("Name must be filled out");
                //     return false;
                // }$("#namecus")

                var x = document.getElementById("namecus").value;
                var lastnamecus = document.getElementById("lastnamecus").value;
                var password_cus = document.getElementById("password_cus").value;
                var email = document.getElementById("email").value;
                var phonenumber = document.getElementById("phonenumber").value;
                console.log("ixmikdkdow" + phonenumber);
                console.log("ixmikdkdow" + email);
                console.log("ixmikdkdow" + password_cus);
                console.log("ixmikdkdow" + lastnamecus);
                console.log("ixmikdkdow" + x);
                if (phonenumber === '' && email === '' && password_cus === '' && lastnamecus === '' &&
                    x === '') {
                    alert("กรุณากรอกข้อมูลให้ครบถ้วน");
                } else if (password_cus.length < 8) {
                    alert("กรุณากรอก password มากกว่า 8 ตัวอักษร");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "register_ajax.php",
                        data: $("#frmMain").serialize(),
                        success: function(result) {
                            if (result.status === 1) // Success
                            {
                                window.location.href = "register_success.php";
                            } else {
                                alert(result.message);
                            }

                        }
                    })
                }


            }

            function onRegisterCompany() {
                // var x = document.forms["namecus"]["lastnamecus"]["password_cus"]["email"]["phonenumber"]["taxref"]["comnapy"].value;
                // if (x == "") {
                //     alert("กรุณากรอกข้อมูลให้ครบถ้วน");
                //     return false;
                // }

                var x = document.getElementById("namecompanycus").value;
                var lastnamecus = document.getElementById("lastnamecompanycus").value;
                var password_cus = document.getElementById("password_companycus").value;
                var email = document.getElementById("emailcompany").value;
                var phonenumber = document.getElementById("phonenumbercompany").value;
                var taxref = document.getElementById("taxref").value;
                var comnapy = document.getElementById("comnapy").value;
                // console.log("ixmikdkdow"+phonenumber);
                if (phonenumber === undefined && email === undefined && password_cus === undefined && lastnamecus === undefined &&
                    x === undefined && taxref === undefined && comnapy === undefined) {
                    alert("กรุณากรอกข้อมูลให้ครบถ้วน");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "register_company_ajax.php",
                        data: $("#frmMain").serialize(),
                        success: function(result) {
                            if (result.status == 1) // Success
                            {
                                alert(result.message);
                                // $("#modalRegisterSuccess").modal("toggle"); 
                            } else // Err
                            {
                                alert(result.message);
                            }

                        }

                    })
                }
            }
        </script>

</body>
<?

include 'footer.php';
?>