<link href="css\buttonnenu.css" rel="stylesheet">
<link rel="stylesheet" href="css/kc.fab.css"/>

<style>
    .modalDialogPaper {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 999;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modalDialogPaper-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }
        to {
            top: 0;
            opacity: 1
        }
    }

    /* The Close Button */
    .close {
        color: black;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modalDialogPaper-header {
        padding: 2px 16px;
    }

    .modalDialogPaper-body {
        padding: 2px 16px;
    }

    .modalDialogPaper-footer {
        padding: 2px 16px;

        color: white;
    }
</style>

<style>

    @media screen and (min-width:830px) {
        .dialogmodalButton {
            position:absolute;
            width:100%;
            color:white;
            /*bottom:0;*/
            left:0;
            padding-left:15px;
            padding-right:15px;
            font-size:5px;
            padding-top: 100px;
            z-index:5;"
        }
    }

    @media screen and (min-width:350px)and (max-width:699px) {
        .dialogmodalButton {
            position:absolute;
            width:100%;
            color:white;
            /*bottom:0;*/
            left:0;
            padding-left:15px;
            padding-right:15px;
            font-size:5px;
            padding-top: 50px;
            z-index:5;"
        }
    }
    @media screen and (min-width:0px)and (max-width:349px) {
        .dialogmodalButton {
            position:absolute;
            width:100%;
            color:white;
            /*bottom:0;*/
            left:0;
            padding-left:15px;
            padding-right:15px;
            font-size:5px;
            padding-top: 50px;
            z-index:5;"
        }
    }
    @media screen and (min-width:700px)and (max-width:829px) {
        .dialogmodalButton {
            position:absolute;
            width:100%;
            color:white;
            /*bottom:0;*/
            left:0;
            padding-left:15px;
            padding-right:15px;
            font-size:5px;
            padding-top: 70px;
            z-index:5;"
        }
    }

    .latest-posts .feed-image {
        display: none;
    }

    #footer-hours {
        padding-left: 5px;
        padding-right: 5px;
    }

    #footer-hours ul {
        padding-left: 5px;
        list-style-type: none;
    }

    #mobileContactBar.opened {
        bottom: 192px !important;
    }

     /* Hide Olark button*/
     @media screen and (max-width: 767px) {
        #olark-wrapper .olark-launch-button {
            display: none !important;
        }
    }

    #phone-footer {
        padding: 0 !important;
        color: #efefef;
        background: rgba(27, 48, 107, 0.9) !important;
    }

    #phone-footer .collapsing {
        transition-timing-function: ease-in-out;
        transition-delay: 0s;
        transition-duration: 0.12s;
    }

    #mobileContactBar {
        padding: 10px 5px;
        overflow-x: hidden;
        width: 100%;
        bottom: 0;
        left: 0;
        position: absolute;
        background: linear-gradient(to bottom, #376bf8 0%, #336699 100%);
        background: #376bf8;
        transition-property: bottom;
        transition-timing-function: ease-in-out;
        transition-delay: 0s;
        transition-duration: 0.17s;
    }

    #mobileContactBar.opened {
        bottom: 105px;
    }

    #mobileContactChevron {
        margin-right: 15px;
    }

    #mobileContactList {
        height: 0;
        list-style-type: none;
        padding-left: 0;
    }

    #mobileContactList.opened {
        height: 200px !important;
        margin-bottom: 0;
    }

    #mobileContactList li {
        list-style-type: none;
        height: 25%;
        padding: 14px 0;
        border-bottom: 1px solid #376bf8;
        font-size: 14px;
    }

    #mobileContactBar.opened {
        bottom: 250px;
    }

</style>
<?php

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM email_menu_config_master WHERE email_menu_id ='1'";
$query = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($query)) { ?>

    <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="top:20%">

        <div class="modal-dialog" role="document">

                <div class="modal-body" style="height: 0px">
                    <div class="row">
                        <button type="button" class="close model_close_right" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img class="lazy" data-src="backoffice/<? echo $result['email_image_title'] ?>"/>
                        <div class="col-xs-6"
                             style=" height: 300px; background: url('backoffice/<?php echo $result['email_image_left'] ?>');background-repeat-y: no-repeat; background-repeat-x:no-repeat; background-size: contain">

                        </div>
                        <div class="col-xs-6"
                             style="position:relative;  height: 300px; background: url('backoffice/<?php echo $result['email_image_right'] ?>'); background-repeat-y: no-repeat;background-repeat-x:no-repeat; background-size: contain">


                            <div class="dialogmodalButton">
                                <div class="md-form mb-5">
                                    <input type="text" id="subNameForm3" class="form-control validate"
                                           placeholder="<?php echo $result['email_name_place_holder'] ?>">

                                </div>
                                <br>

                                <div class="md-form mb-4">
                                    <input type="email" id="subEmailForm4" class="form-control validate"
                                           placeholder="<? echo $result['email_email_place'] ?>">

                                    <button class="btn" style="background-color: transparent;" onclick="subEmail()">
                                        <img class="lazy"
                                             data-src="backoffice/<? echo $result['email_button_image'] ?>"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<?php  

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
$sql2 = "SELECT * FROM email_menu_config_master WHERE email_menu_id ='4'";
$query2 = mysqli_query($conn, $sql2);
while ($result2 = mysqli_fetch_assoc($query2)) { ?>

    <div class="modal fade" id="modalSubscriptionSuccess" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="top:20%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close model_close_right" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img class="lazy" data-src="backoffice/<? echo $result2['email_image_title'] ?>"/>

                    <button type="button" class="close model_close_right" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img class="lazy" data-src="backoffice/<? echo $result2['email_image_title'] ?>"/>

                </div>
                <div class="modal-body mx-3">
                    <div class="row">

                        <div class="col-md">
                            <a target="_blank" href="<?php echo $result2['email_success_link'] ?>"><img
                                        class="lazy"
                                        data-src="backoffice/<?php echo $result2['email_success_dialog_image'] ?>"/></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>


<?php $conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
$sql3 = "SELECT * FROM email_menu_config_master WHERE email_menu_id ='3'";
$query3 = mysqli_query($conn, $sql3);
while ($result3 = mysqli_fetch_assoc($query3)) { ?>

    <div class="modal fade" id="modalwhitepaper" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="top:20%">
        <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding-bottom: 0px">


                <div class="modal-body" style="height: 0px">
                    <button type="button" class="close model_close_right" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img class="lazy" data-src="backoffice/<? echo $result3['email_image_title'] ?>"/>
                    <div class="row">
                        <div class="col-xs-6"
                             style=" height: 300px; background: url('backoffice/<?php echo $result3['email_image_left'] ?>');background-repeat-y: no-repeat; background-repeat-x:no-repeat; background-size: contain">
                        </div>
                        <div class="col-xs-6"
                             style="position:relative;  height: 300px; background: url('backoffice/<?php echo $result3['email_image_right'] ?>'); background-repeat-y: no-repeat; background-repeat-x:no-repeat; background-size: contain">
                            <div class="dialogmodalButton">
                                <div class="md-form mb-5">
                                    <input type="text" id="subNameFormWhitePaper" class="form-control validate"
                                           placeholder="<?php echo $result3['email_name_place_holder'] ?>">
                                </div>
                                <br>
                                <div class="md-form mb-4">
                                    <input type="email" id="subEmailFormWhitePaper" class="form-control validate"
                                           placeholder="<? echo $result3['email_email_place'] ?>">
                                </div>
                                <button class="btn" style="background-color: transparent;" >
                                    <img class="lazy" id="subemailWhitepaper"
                                         data-src="backoffice/<? echo $result3['email_button_image'] ?>"/>
                                </button>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<?php

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
$sql4 = "SELECT * FROM email_menu_config_master WHERE email_menu_id ='2'";
$query4 = mysqli_query($conn, $sql4);
while ($result4 = mysqli_fetch_assoc($query4)) { ?>

    <div class="modal fade" id="modalWhitePaperSuccess" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="top:20%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">

                    <button type="button" class="close model_close_right" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img class="lazy" data-src="backoffice/<? echo $result4['email_image_title'] ?>"/>

                </div>
                <div class="modal-body mx-3">
                    <div class="row">

                        <div class="col-md">
                            <a target="_blank" href="<?php echo $result4['email_success_link'] ?>"><img
                                        class="lazy"
                                        data-src="backoffice/<?php echo $result4['email_success_dialog_image'] ?>"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
$sql5 = "SELECT * FROM email_menu_config_master WHERE email_menu_id ='5'";
$query5 = mysqli_query($conn, $sql5);
while ($result5 = mysqli_fetch_assoc($query5)) { ?>

    <div class="modal fade" id="modalSubscriptionSuccessOrder" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="top:20%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body mx-3">
                    <button type="button" class="close model_close_right" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img class="lazy" data-src="backoffice/<?php echo $result5['email_image_title'] ?>"/>

                    <div class="row">

                        <div class="col-md">
                            <a target="_blank" href="<?php echo $result5['email_success_link'] ?>"><img
                                        class="lazy"
                                        data-src="backoffice/<?php echo $result5['email_success_dialog_image'] ?>"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM msg_contact ";
$query = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($query)) { ?>

    <div class="follow-us row">
        <br/>
        <section class="latest-posts col-sm-3 hidden-xs dont-print">
            <ul class="posts">
                <li class="post-summary">
                    <table>
                        <tr>
                            <td><img src="images/logotf.png" width="150px"></td>
                            <td>
                                <font class="font-logo" size="15"> ร้านไทยจราจร </font><br><br><br><br><br>
                                บริษัท สมาร์ท เบสท์บายส์ จำกัด 39/174-6 ซอยประชาอุทิศ 121 ถนนประชาอุทิศ
                                เขตทุ่งครุ แขวงทุ่งครุ กรุงเทพฯ 10140 เลขผู้เสียภาษี 0105548090347
                            </td>
                        </tr>
                    </table>
                </li>
                <li class="post-summary">
                    TEL:02-114-7006<br/>
                    Mobile: 087-022-4003,084-544-1710<br/>
                    FAX:02-462-8274<br/>
                    E-mai:sale@smartbestbuys.com<br/>
                    Line:@trafficthai
                </li>
            </ul>
        </section>
        <section class="latest-posts col-sm-3 hidden-xs dont-print">
            <ul class="posts">
                <li class="post-summary">
                    <font size="4"> แค็ตตาล็อค ร้านไทยจราจร </font>
                    <hr>
                </li>
                <li>
                    <a data-toggle="modal" data-target="#modalSubscriptionForm"><img src="images/downloadcat.png"></a>
                </li>
                <br/>
                <li class="post-summary">
                    <font size="4"> รับสิทธิ์พิเศษก่อนใคร </font>
                    <hr>
                </li>
                <li class="post-summary">
                    ไม่พลาด โปรโมชั่น ไม่พลาดส่วนลด <br/>

                    <div class="sendemail" style="width: 300px; background-color: orange">
                        <div class="t">
                            <!-- This is the wrapper div around the text input -->
                            <input type="text" placeholder="ใส่ อีเมล (E-mail) เพื่อรับสิทธิ์พิเศษ..... "
                                   style="color:black;" id="ft-email"/>
                        </div>
                        <input type="button" value="ส่งเลย" style="background-color:red;" onclick="add_email99();"/>
                    </div>
                </li>
            </ul>
        </section>
        <section class="latest-posts col-sm-3 hidden-xs dont-print">
            <ul class="posts">
                <li class="post-summary">
                    <span style="font-size: medium; "> ศูนย์ช่วยเหลือ </span>
                    <hr>
                </li>
                <?php
                
                $conn = mysqli_connect($host, $user, $pass, $dbname);
                mysqli_set_charset($conn, "utf8");
                $sql = "SELECT * FROM common_smart_master";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_assoc($query)) { ?>
                    <a href="service_menu.php?common_smart_id=<?php echo $result['common_smart_id'] ?>">
                        <li class="post-summary">
                            <?php echo $result['common_menu'] ?>
                        </li>
                    </a>
                <?php } ?>
            </ul>
        </section>

        <!-- /latest-tweets -->
        <!-- contact-us -->
        <section class="contact-us col-xs-12 col-sm-3 hidden-on-checkout-footer-elements dont-print">
            <ul class="posts">

                <li class="post-summary">
                    <font size="4"> ติดต่อเรา </font>
                    <hr>
                </li>

            </ul>
            <div class="row">
                <div class="col-xs-3">
                    <img src="images/time_footer.png"/>
                </div>
                <div class="col-xs-9">
                    จันทร์-ศุกร์ : 8.00-17.30 น.
                    <br/>&nbsp;&nbsp;&nbsp; เสาร์ : 8.00-17.00 น.
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="social-links list-inline dont-print">

                        <li><a href="https://www.facebook.com/trafficthai" target="_blank" rel="nofollow"
                               title="Facebook">
                                <img class="cld-responsive"
                                     data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/images/facebook-icon.png"
                                     src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_400/v47/images/facebook-icon.png"
                                     alt="Facebook"></a></li>

                        <li><a href="javascript:void(0)" target="_blank" rel="nofollow" title="Twitter">
                                <img class="cld-responsive"
                                     data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/images/twitter-icon.png"
                                     src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_400/v47/images/twitter-icon.png"
                                     alt="Twitter"></a></li>

                        <li><a href="javascript:void(0)" target="_blank" rel="nofollow" title="YouTube">
                                <img class="cld-responsive"
                                     data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/images/youtube-icon.png"
                                     src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_400/v47/images/youtube-icon.png"
                                     alt="YouTube"></a></li>

                        <li><a href="javascript:void(0)" rel="publisher" title="Google Plus">
                                <img class="cld-responsive"
                                     data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/images/gplus-icon.png"
                                     src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_400/v47/images/gplus-icon.png"
                                     alt="Google Plus"></a></li>

                        <li><a href="javascript:void(0)" title="Email">
                                <img class="cld-responsive"
                                     data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/images/email-icon.png"
                                     src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_400/v47/images/email-icon.png"
                                     alt="Email"></a></li>
                    </ul>
                    <ul class="list-inline footerPhoneNumbers">
                        <li class="hidden-xs"><i class="ion-android-call"></i> Tel: 02-114-7006</li>

                        <li><i class="ion-printer"></i> E-mail:sale@smartbestbuys.com</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="images/dbd.png"/>
                    </div>
                </div>
            </div>

            <ul class="locations row">
                <li class="post-summary">
                </li>
            </ul>

        </section>
    </div>
    <!-- end follow-us row -->

    <div class="approval-logos row hidden-on-checkout-footer-elements dont-print">

    </div>
    <footer class="site-footer dont-print">
        <div class="navbar-dark row">
            <ul class="footer-links">

                <?php
                
                $conn = mysqli_connect($host, $user, $pass, $dbname);
                mysqli_set_charset($conn, "utf8");
                $sql = "SELECT * FROM common_smart_master";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_assoc($query)) { ?>
                    <a href="service_menu.php?common_smart_id=<?php echo $result['common_smart_id'] ?>">
                        <li class="post-summary">
                            <?php echo $result['common_menu'] ?>
                        </li>
                    </a>
                <?php } ?>

                <li>Copyright &copy;2008 www.trafficthai.com &#8482; All Rights Reserved</li>
                <li class="serverID">01</li>
            </ul>
        </div>
    </footer>
    <div id="phone-footer">
        <ul id="mobileContactList" class="collapse dont-print">
            <li><b>Customer Service Hours</b><br> Mon-Thur: 8am-5:30pm ET <br> Friday: 8am-5pm ET</li>
            <li><a class="dont-print mobileContactLink" href="tel:800-983-0021">Call us: <b>800-983-0021</b></a></li>
            <li><a class="dont-print mobileContactLink" href="mailto:contact@trafficsafetystore.com">Email: Traffic
                    Safety Store</a></li>
        </ul>
        <p class="print-only">
            <span class="glyphicon glyphicon-earphone glyphicon-position-static"></span>
            800-429-9030 &nbsp;
            <span class="glyphicon glyphicon-link glyphicon-position-static"></span>
            www.trafficsafetystore.com
        </p>
    </div>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="js/jquery-ui.js"></script>
    <div id="dialog_email" title="ร้านไทยจราจร" style="display:none;">
        <p>ได้รับ อีเมล เรียบร้อยแล้วค่ะ</p>
    </div>
    <input type="hidden" id="action" value="<?php echo $_GET[" action"]; ?>"/>
    <script type="text/javascript">

        $(document).ready(function () {
            // $(".social2").mouseover(function() {
            // 	$(".social").css("display", "block");
            // 	$(".social2").css("display", "none");
            // });
            // $("#closesc").click(function() {
            // 	$(".social2").css("display", "block");
            // 	$(".social").css("display", "none");
            // });
            
            $('#mobileContactBar, #mobileHeaderPhoneButton').click(function () {
                $('#mobileContactBar').toggleClass('opened');
                $('#mobileContactMessage').toggle();
                $('#mobileContactChevron').toggle();
            })
            
            $('#mobileContact-olarkLaunch').click(function () {
                $('#mobileContactList').collapse('hide');
                $('#mobileContactBar').toggleClass('opened');
                $('#mobileContactMessage').toggle();
                $('#mobileContactChevron').toggle();
            });

            var action = $("#action").val();

            if (action == "email") {
                $("#dialog_email").dialog({
                    show: "slide",
                    modal: true,
                    autoOpen: false
                });
                $("#dialog_email").dialog("open");
                return false;
            }

            $("#subemailWhitepaper").click(function () {
                subSendwhitePaper()
            })
        });

<<<<<<< HEAD
=======


>>>>>>> master
        function validateEmail(email) {
            var re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
            return !email.match(re);
        }

        function add_email99() {

            var email = $("#ft-email").val().trim();

            var id_art = $("#id_art").val();
            if (email == "") {
                alert("Plese input your email.");

                return false;
            }
            if (!validateEmail(email)) {
                alert("Fomat email found.");

                return false;
            }

            var url_page = "";
            var url_page = "index.php";
            location.href = url_page + "?email=" + email + "&action=email&id_art=" + id_art + "&keyword_email=SnBnBlog";
        }


        function subEmail() {
            var email = $("#subEmailForm4").val().trim();

            var nameInput = $("#subNameForm3").val();
            if (email == "") {
                alert("Plese input your email.");

                return false;
            }
            if (!validateEmail(email)) {
                alert("Fomat email found.");

                return false;
            }
            // var url_page = "";
            // var url_page = "index.php";
            // location.href = url_page + "?action=loadCatelog&emailSub=" + email + "&nameInput=" + nameInput;
            $.post("sendEmailCatelog_ajax.php", {
                    'email_customer': email,
                    'customer_name': nameInput
                }, function (result) {
                    // status success
                    if (result.status === '0'){
                        alert(result.message);
                    } 
                }
            )

            jQuery.noConflict();
            $("#modalSubscriptionForm").modal("toggle");
            $("#modalSubscriptionSuccess").modal("toggle");
        }

        function subSendwhitePaper() {
            var email = $("#subEmailFormWhitePaper").val().trim();
            var titleid = $(".Whitepaper").attr("title")
            var pageSource = $(".Whitepaper").attr("alt")
            var nameInput = $("#subNameFormWhitePaper").val().trim();
            // alert(email)
            console.log("mximxi"+ email)
            if (email === "") {
                alert("Plese input your email.");
                return false;
            }

            if (!validateEmail(email)) {
                alert("Fomat email found.");
                return false;
            }

            $.post("sendEmail_ajax.php", {
                    'email': email,
                    'paper_id': titleid,
                    'nameInput':nameInput,
                'pageSource':pageSource
                }, function (result) {
                    // alert(result);
                    if (result.status === '0') // Success
                    {
                        alert(result.message);

                    } else // Err
                    {

                    }
                }
            )
            jQuery.noConflict();
            $("#modalwhitepaper").modal("toggle");
            $("#modalWhitePaperSuccess").modal("toggle");

        }

        // const email = $("#email-customer").val();
        // const paper_id = $("#paper_id").val();
        // e.preventDefault();
        // if (email === "") {
        //     alert("Please input your email.");
        //
        //     return false;
        // }
        // if (!validateEmail(email)) {
        //     alert("Format email found.");
        //
        //     return false;
        // }
        // $.post("sendEmail_ajax.php", {
        //         'email': email,
        //         'paper_id': paper_id
        //     }, function (result) {
        //         jQuery.noConflict();
        //         $("#modalSubscriptionSuccess").modal("toggle");
        //         // alert(result);
        //         // if (result.status === '0')
        //         // {
        //         //     alert(result.message);
        //         //
        //         // } else // Err
        //         // {
        //         //
        //         //
        //         // }
        //     }
        //
        // )


        function add_email_artical(url_page, pageSource) {

            var email = $("#email-customer").val();
            var id_art = $("#id_art").val();
            // var id_testimo = $("#id_testimo").val();
            if (email.trim() === "") {
                alert("Plese input your email.");

                return false;
            }
            if (!validateEmail(email.trim())) {
                alert("Fomat email found.");

                return false;
            }
            //alert(url_page +"?email="+email+"&action=email");

            $.post("sendEmail_ajax.php", {
                    'email': email.trim(),
                    'paper_id': url_page,'nameInput':null,
                    'pageSource':pageSource
                }, function (result) {

                }
            )
            jQuery.noConflict();
            $("#modalWhitePaperSuccess").modal("toggle");
            // location.href = url_page + "?email=" + email + "&action=email&id_art=" + id_art + "&keyword_email=" + keyword_email + "&id_testimo=" + id_testimo;
        }

        function add_email(url_page, keyword_email) {

            var email = $("#email-customer").val().trim();
            var id_art = $("#id_art").val();
            var id_testimo = $("#id_testimo").val();
            if (email === "") {
                alert("กรุณาใส่กรอกข้อมูล email");

                return false;
            }
            if (!validateEmail(email)) {
                alert("กรุรากรอก email ให้ถูกต้อง");

                return false;
            }
            //alert(url_page +"?email="+email+"&action=email");

            $.post("sendEmail_ajax.php", {
                    'email': email,
                    'paper_id': id_testimo
                }, function (result) {

                    // alert(result);
                    // if (result.status === '0')
                    // {
                    //     alert(result.message);
                    //
                    // } else // Err
                    // {
                    //
                    //
                    // }
                }
            )
            jQuery.noConflict();
            $("#modalWhitePaperSuccess").modal("toggle");
            // location.href = url_page + "?email=" + email + "&action=email&id_art=" + id_art + "&keyword_email=" + keyword_email + "&id_testimo=" + id_testimo;
        }
    </script>
    <?php

    if ($_GET["action"] == "email") {

        $email = $_GET["email"];
        $keyword = $_GET["keyword_email"];

        $conn = mysqli_connect($host, $user, $pass, $dbname);
        mysqli_set_charset($conn, "utf8");

        if ($keyword == "SnBnBlog") {
            $sql = "INSERT INTO email_customer (email, insert_date , keyword ) VALUES ('$email',SYSDATE() , '$keyword') ";
            if ($conn->query($sql) === TRUE) {
            } else {
                $alert = "Error: " . $sql . "<br>" . $conn->error;
                print($alert);
            }
        } else {

            $str = explode(",", $keyword);
            foreach ($str as $value) {
                $sql = "INSERT INTO email_customer (email, insert_date , keyword ) VALUES ('$email',SYSDATE() , '$value') ";

                if ($conn->query($sql) === TRUE) {
                } else {
                    $alert = "Error: " . $sql . "<br>" . $conn->error;
                    print($alert);
                }
            }
        }
        $conn->close();
    }


    if ($_GET["action"] == "loadCatelog") {

        $conn = mysqli_connect($host, $user, $pass, $dbname);
        mysqli_set_charset($conn, "utf8");
        $sql = "SELECT * FROM email_teamplate_master ";
        $queryEmail = mysqli_query($conn, $sql);
        while ($resultEmail = mysqli_fetch_assoc($queryEmail)) {
            require_once('./PHPMailer-master/src/PHPMailer.php');
            require_once('./PHPMailer-master/src/SMTP.php');
            require_once('./PHPMailer-master/src/Exception.php');
            // require 'vendor/autoload.php';
            // require 'PHPMailerAutoload.php';
            $email = $_GET["emailSub"];
            $customerName = $_GET["nameInput"];

            // Load Composer's autoloader
            // require 'vendor/autoload.php';

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            try {
                //Server settings
                // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host = 'mail.smartbestbuys.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                $mail->Username = 'info@smartbestbuys.com';                     // SMTP username
                $mail->Password = 'smart67890';                               // SMTP password
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAutoTLS = false;
                $mail->CharSet = 'UTF-8';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                //Recipients
                $mail->setFrom('info@smartbestbuys.com');
                $mail->addAddress($email);     // Add a recipient
                // Attachments
                $mail->addAttachment('/trafficthaiV9copy_Optimizer.pdf');     // Add attachments

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $resultEmail['email_title'];
                $mail->Body = $resultEmail['email_message'];
                $mail->AltBody = $resultEmail['email_altMessage'];

                $mail->send();
                // echo 'Message has been sent';
                // header("location:index.php");
                ?>
                <script>
                    $("#modalSubscriptionSuccess").modal("toggle");
                </script>
                <?php
            } catch (Exception $e) {
                //throw $th;
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }


    ?>

<?php
 }
$conn->close(); ?>

<?php if ($_GET['action'] == "subEmail") { ?>
    <script>
        //$(document).ready(function(){
        $("#modalSubscriptionForm").modal("toggle");
        //});
    </script>
<?php } ?>

</div>

<script type="text/javascript">

    $("#emailclickSub").click(function () {

        const email = $("#email-customer").val();
        const paper_id = $("#paper_id").val();
        e.preventDefault();
        if (email === "") {
            alert("Please input your email.");

            return false;
        }
        if (!validateEmail(email)) {
            alert("Format email found.");

            return false;
        }
        $.post("sendEmail_ajax.php", {
                'email': email,
                'paper_id': paper_id
            }, function (result) {

            }
        )
        jQuery.noConflict();
        $("#modalWhitePaperSuccess").modal("toggle");

    })

    $(".Whitepaper").click(function () {
        jQuery.noConflict();
        // alert($(".Whitepaper").attr("title"))
        $("#modalwhitepaper").modal("toggle");
    });

</script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script src="js/yall.min.js"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", yall);
</script>

<script>

    $(document).ready(function () {
        $('#clickLine').click(function () {
            window.open('http://line.me/ti/p/@trafficthai');
        });

        $('#clickOrder').click(function () {
            <?php setcookie('cart', 'mixmix', time() + 60 * 100000, '/');?>
        });

        const xmidimd = $("img[src='https://smartbestbuys.com/images/quotation.png']");
        xmidimd.click(function () {
            console.log('ddedede');
            <?php if(!isset($_COOKIE['cart'])) {
            ?> console.log('midmidiwdwi')<?php
            } else{
            ?> console.log('mixmximxi')<?php
            }?>
        })
        // $.("img[src*='https://smartbestbuys.com/images/quotation.png']").click(function () {
        //     window.open('http://line.me/ti/p/@trafficthai');
        //
        // })
        $('.minus-btn').click(function () {
            console.log('dsdsdowdw');
            const $input = document.getElementById('didinput').value;
            let value = parseInt($input);
            console.log(value);
            if (value > 1) {
                value = value + 1;
            } else {
                value = 100;
            }
            console.log(value);
            document.getElementById('didinput').value = value;
        });

        $('.plus-btn').click(function () {
            console.log('dd,wd,wodowd');
            // const $this = $(this);

            const $input = document.getElementById('didinput').value;
            let value = parseInt($input);
            console.log(value);
            if (value < 100) {
                value = value + 1;
            } else {
                value = 100;
            }
            console.log(value);
            document.getElementById('didinput').value = value;
            //     // e.preventDefault();
            //     // const $this = $(this);
            //     // const $input = $this.closest('div').find('input');
            //     // let value = parseInt($input.val());
            //     //
            //     if (value &amp;lt; 100) {
            //         value = value + 1;
            //     } else {
            //         value =100;
            //     }
            //
            //     $input.val(value);
        });

        // $('.minus-btn').on('click', function(e) {
        //     console.log('dsdsdowdw');
        //     e.preventDefault();
        //     const $this = $(this);
        //     const $input = $this.closest('div').find('input');
        //     let value = parseInt($input.val());
        //
        //     if (value &amp;gt; 1) {
        //         value = value - 1;
        //     } else {
        //         value = 0;
        //     }
        //
        //     $input.val(value);
        //
        // });
        //
        // $('.plus-btn').on('click', function(e) {
        //     console.log('dd,wd,wodowd');
        //     e.preventDefault();
        //     const $this = $(this);
        //     const $input = $this.closest('div').find('input');
        //     let value = parseInt($input.val());
        //
        //     if (value &amp;lt; 100) {
        //         value = value + 1;
        //     } else {
        //         value =100;
        //     }
        //
        //     $input.val(value);
        // });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#all_product').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#promotion_products_main').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#ads_topMain').slick({
            lazyLoad: 'ondemand',
            autoplay: true,
            autoplaySpeed: 3000,

        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#popular_products_main').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#vdo_prodorduct').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#testimo_smart').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });

</script>
<div class="kc_fab_wrapper" style="margin-bottom: 20px">
    <?php
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT * FROM msg_contact ";
    $query = mysqli_query($conn, $sql);

    while ($result = mysqli_fetch_assoc($query)) {
        ?>


        <input id="testtest" value="support_order.php" name="testtest" hidden="true">
        <input id="titleMail" value="<?php echo $result['msg_email'] ?>" name="titleMail" hidden="true">

        <input id="phoneIntent" value="tel:<?php echo $result['val_phone'] ?>" name="phoneIntent" hidden="true">
        <input id="phoneTitle" value="<?php echo $result['msg_phone'] ?>" name="phoneTitle" hidden="true">

        <input id="lineIntent" value="<?php echo $result['val_line'] ?>" name="lineIntent" hidden="true">
        <input id="lineTitle" value="<?php echo $result['msg_line'] ?>" name="lineTitle" hidden="true">

        <input id="fbIntent" value="<?php echo $result['val_facebook'] ?>" name="fbIntent" hidden="true">
        <input id="fbTitle" value="<?php echo $result['msg_fb'] ?>" name="fbTitle" hidden="true">

        <input id="title_flow" value="<?php echo $result['btn_msg'] ?>" name="fbTitle" hidden="true">

    <?php } ?>
</div>
<script src="js/kc.fab.js"></script>
<script>
    $(document).ready(function () {
        var links = [{
            "icon": "images/logotf.png",
            "text_menu": document.getElementById("title_flow").value

        },
            {
                "url": document.getElementById("fbIntent").value,
                "icon": "images/Facebook_Messenger_circle.png",
                "title": document.getElementById("fbTitle").value,
                "target": "_blank"

            },
            {
                "url": document.getElementById("lineIntent").value,
                "icon": "images/line_circle.png",
                "title": document.getElementById("lineTitle").value,
                "target": "_blank"

            }, {
                "url": document.getElementById("phoneIntent").value,
                "icon": "images/phone_circle.png",
                "title": document.getElementById("phoneTitle").value,
                "target": "_blank"

            }, {
                "url": document.getElementById("testtest").value,
                "icon": "images/mail_circle.png",
                "title": document.getElementById("titleMail").value,
                "target": "_blank"

            }
            // ,{
            // 	"url": "close",
            // 	"icon": "images/cancel_circle.png",
            // 	"title": "ปิดหน้าต่างช่วยเหลือ"

            // }
        ];

        $('.kc_fab_wrapper').kc_fab(links);
    });

</script>