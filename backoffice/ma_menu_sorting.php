<?
include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>
<!--    <style>-->
<!--        .table-sortable {-->
<!--            position: relative;-->
<!--        }-->
<!---->
<!--        .table-sortable .sortable-placeholder {-->
<!--            height: 37px;-->
<!--        }-->
<!---->
<!--        .table-sortable .sortable-placeholder:after {-->
<!--            position: absolute;-->
<!--            z-index: 10;-->
<!--            content: " ";-->
<!--            height: 37px;-->
<!--            background: #f9f9f9;-->
<!--            left: 0;-->
<!--            right: 0;-->
<!--        }-->
<!--    </style>-->
    <script>
        function validateForm() {
            var x = document.forms["myForm"]["menu_keyword"].value;
            if (x === "") {

                return false;
            }
        }
    </script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <div id="wrapper">
        <?php include("top.php"); ?>
        <!-- /. NAV TOP  -->
        <?php include("menu.php"); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">


                    <div class="col-md-12">
                        <h2>จัดเรียงเมนู</h2>
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


                <button class="save btn btn-success">Save menu</button>
                <br />
                <br />
                <br />
<!--                <div class="alert alert-success" id="response" role="alert">save menu successsful</div>-->
                <?php
                if ($result = mysqli_query($conn, 'SELECT * FROM menu ORDER BY menu_order')) {
                    ?>
                    <ul class="list-group sortable">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="list-group-item" id=item-' . $row['id_menu'] .'">' . $row['menu_name'] . '</li>';
                        }
                        ?>
                    </ul>
                    <?php
                    mysqli_free_result($result);
                }
                mysqli_close($conn);
                ?>
            </div>


            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>


    <script type="text/javascript">
        var ul_sortable = $('.sortable');
        ul_sortable.sortable({
            revert: 100,
            placeholder: 'placeholder'
        });
        ul_sortable.disableSelection();
        var btn_save = $('button.save'),
            div_response = $('#response');
        btn_save.on('click', function(e) {
            e.preventDefault();
            var sortable_data = ul_sortable.sortable('serialize');
            // div_response.text('Сохраняем');
            $.ajax({
                data: sortable_data,
                type: 'POST',
                url: 'save_menu_order.php',
                success:function(result) {
                    // div_response.text(result);
                    alert(result.message);
                }
            });
        });
    </script>
<?
$conn->close();
include 'footer.php';
?>