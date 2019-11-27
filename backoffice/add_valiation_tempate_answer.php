<?
include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
$validationid = $_GET["id"];
?>
<?

if ($_GET["action"] == "998") {
    $id = $_GET["v_answer_id"];

    $sql = "DELETE FROM valiation_answer_master WHERE v_answer_id ='" . $id . "'";

    if ($conn->query($sql) === TRUE) {
        $alert = "DELETE successfully";
    } else {
        $alert = "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
    <div id="wrapper">
        <?php include("top.php"); ?>
        <!-- /. NAV TOP  -->
        <?php include("menu.php"); ?>
        <!-- /. NAV SIDE  -->


        <div id="page-wrapper">
            <div id="page-inner">

                <br><br>

                <table id="myTable" class="order-list table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Status</td>
                        <td>เงื่อนไขที่ 1</td>
                        <td>เงื่อนไขที่ 2</td>
                        <td>เงื่อนไขที่ 3</td>
                        <td>รหัสสินค้า</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $sql = "SELECT * FROM valiation_answer_master WHERE v_ori_id = '$validationid' ";


                    $query = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td>
                                <center><p> <? echo $result["v_answer_id"] ?></p></center>
                            </td>
                            <td>
                                <center><input class="myCheckboxvaliation" type="checkbox" <? if ($result["v_status_active"] == 'true'){?>checked <?}?> data-toggle="toggle"></center>

                            </td>
                            <td>
                                <center><p> <? echo $result["v_option_one"] ?></p></center>
                            </td>
                            <td>
                                <center><p> <? echo $result["v_option_two"] ?></p></center>
                            </td>
                            <td>
                               <center><p> <? echo $result["v_option_three"] ?></p></center>
                            </td>
                            <td>
                                <center><p> <? echo $result["v_sku"] ?></p></center>
                            </td>
                            <td>
                                <center>
                                    <button class="btn btn-danger"
                                            onClick="javascript:location.href='add_valiation_tempate_answer.php?id=<?php echo $validationid ?>&action=998&v_answer_id=<?php echo $result['v_answer_id']; ?>'">
                                        <i class="fa fa-pencil"></i>ลบ
                                    </button>
                                </center>


                            </td>
                        </tr>
                    <? } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <input type="button" class="btn btn-lg btn-block" name="addrow" id="addrow"
                                   value="เพิ่มเงื่อนไข"/>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    </tfoot>
                </table>


                <a href="ma_valiation_product.php" class="btn btn-default">Back</a>


            </div>
            <!-- /. PAGE INNER  -->
        </div>

        <!-- /. PAGE WRAPPER  -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มเงื่อนไข Valiation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">รหัสเงื่อนไข</label>
                                <input type="text" class="form-control" id="options-id" value="<? echo $validationid ?>"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">เงื่อนไขที่1</label>
                                <input type="text" class="form-control" id="options-one" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">เงื่อนไขที่2</label>
                                <input type="text" class="form-control" id="options-two" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">เงื่อนไขที่3</label>
                                <input type="text" class="form-control" id="options-three" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">SKU</label>
                                <input type="text" class="form-control" id="answer-SKU" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="sendsubmit" id="sendsubmit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?
$conn->close();
include 'footer.php';
?>