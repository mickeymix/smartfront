<? include 'head.php';
$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>
<head>

    <!-- include libs stylesheets -->
    <link href="css/bootstrap4.1.3.css" rel="stylesheet"/>
    <script src="js/popper1.14.5.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>


    <!-- include summernote -->
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script type="text/javascript" src="dist/summernote-bs4.js"></script>
    <script src="dist/summernote-image-attributes.js"></script>
</head>
<body>
<?

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_POST["action"] == "1") {
    $desp_testimo = $_POST["desp_testimo"];
    $desp_testimo = str_replace("youtube-iframe", "www.youtube.com", $desp_testimo);

    $keyword = $_POST["ans1"];

    if ($keyword <> '') {
        $sql = "UPDATE common_smart_master SET common_content = '$desp_testimo' WHERE common_menu = '$keyword'";


        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $alert = "New record created successfully";
            print(" <center><font color='red'>เพิ่มข้อมูลสำเร็จ</font></center> ");
        } else {
            $alert = "Error: " . $sql . "<br>" . $conn->error;
            print($alert);
        }
    } else {
        $alert = "กรูณาใส่ข้อมูล";
        print($alert);
    }
}
?>

<div id="wrapper">
    <?php include("top.php"); ?>
    <!-- /. NAV TOP  -->
    <?php include("menu.php"); ?>
    <!-- /. NAV SIDE  -->

    <form id="myform" action="edit_common_page.php" method="POST" class="form-horizontal" data-parsley-validate=""
          novalidate="" enctype="multipart/form-data">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <h2>แก้ไข Common Page</h2>
                        </div>
                        <div class="col-md-4" align="right">

                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr/>
                <!-- /. ROW  -->
                <?php if ($alert <> "") { ?>
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo "$alert"; ?>
                    </div>
                <?php } ?>


                <select class="mdb-select md-form" id="selected_value" name="selected_value">
                    <option value="" disabled selected>Choose your option</option>
                    <?

                    $sql = "SELECT * FROM common_smart_master";


                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<? echo $row['common_menu'] ?>"><? echo $row['common_menu'] ?></option>

                    <? } ?>
                </select>
                <input class="form-control" placeholder="" type="text" name="ans1" id="ans1" hidden="true"/>


                <br><br><label>Description</label>

                <div class="summernote1"></div>

                <textarea rows="4" cols="50" style="display:none;" name="desp_testimo"></textarea>
                <br>


                <br>

                <input type="hidden" name="action" value="1"/>
                <button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save</button>
                <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">
                    Reset
                </button>
                <a href="javascript:void(0)" onclick="backHome('ma_help_service.php');"
                   class="btn btn-default">Back</a>


            </div>
            <!-- /. PAGE INNER  -->
        </div>

        <!-- /. PAGE WRAPPER  -->
</div>

</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote1').summernote({
            popover: {
                image: [
                    ['custom', ['imageAttributes']],
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
            },
            lang: 'en-US', // Change to your chosen language
            imageAttributes: {
                icon: '<i class="note-icon-pencil"/>',
                removeEmpty: true, // true = remove attributes | false = leave empty if present
                disableUpload: true // true = don't display Upload Options | Display Upload Options
            }
        });


        $('#myform').on('keyup keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

    });
</script>

<script type="text/javascript">


    // function onIdChange(element) {
    //     console.log('kdwdokdowkdow')
    //     var confirmed = confirm('คุณต้องการที่จะเปลี่ยนข้อมูลหรือไม่?');
    //
    //     if (confirmed) {
    //         alert('ข้อมูลของท่านได้ถูกเปลี่ยนแล้ว');
    //
    //         var x = document.getElementById("selected_value").value;
    //         var skillsSelect = document.getElementById("selected_value");
    //         var data = skillsSelect.options[skillsSelect.selectedIndex].text;
    //         document.getElementById("ans1").value = data;
    //
    //         console.log(x);
    //
    //         $.ajax({
    //             type: "POST",
    //             url: "inquiry_common_menudata_ajax.php",//this  should be replace by your server side method
    //             data: "{'namemenu': '" + x + "'}", //this is parameter name , make sure parameter name is sure as of your sever side method
    //             contentType: "application/json;",
    //             success: function (result) {
    //                 alert("dsdssdsds");
    //             }
    //         });
    //
    //         $('.summernote1').summernote('code', '<p></p>');
    //         $('.summernote1').summernote('editor.pasteHTML', x);
    //
    //     } else {
    //         alert('ข้อมูลของท่านยังเป็นข้อมูลเดิม');
    //     }
    //
    //
    // }


    function onValueChange() {
        const selectedProject = $("#selected_value option:selected").val();
        // alert(selectedProject);
        console.log('midmidmwi' + selectedProject);
        $.post(
            "inquiry_common_menudata_ajax.php", {'namemenu': selectedProject}, function (result) {
                // alert(result);
                document.getElementById("ans1").value = selectedProject;
                $('.summernote1').summernote('code', '<p><br></p>');
                // alert(result)
                $('.summernote1').summernote('code', result.message);
            }
        )
        // $.ajax({
        //     type: "POST",
        //     dataType: "json",
        //     url: "inquiry_common_menudata_ajax.php",//this  should be replace by your server side method
        //         data: JSON.stringify({ 'namemenu': selectedProject }), //this is parameter name , make sure parameter name is sure as of your sever side method
        //     contentType: "application/json;",
        //     success: function (result) {
        //         alert(result);
        //     },error: function(xhr) {
        //         alert(xhr);
        //         //Do Something to handle error
        //     }
        // });
    }

    $('#selected_value').change(function () {
        onValueChange();
    });
</script>
<script>
    function sumit_edit_product() {
        var summernote1 = $('.summernote1').summernote('code').trim();

        document.getElementsByName("desp_testimo")[0].value = summernote1.replace(/\www.youtube.com/g, "youtube-iframe");

        $("#myform").submit();

    }
</script>

<?

include 'footer.php';
?></body>