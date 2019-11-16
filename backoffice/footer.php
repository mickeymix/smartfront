<footer class="site-footer push">This is a footer</footer>


<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>

<link rel="stylesheet" href="css/jquery-ui.css">


<script src="js/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
        $('.d1').click(function () {
            $("#datepicker").focus();
        });
    });

</script>

<script language="javascript">
    function printpr() {
        $(".sidebar").css("display", "none");
        $(".header-container").css("display", "none");

        $(".page-container").css("padding-left", "0px");
        window.print();
        $(".page-container").css("padding-left", "");
        $(".sidebar").css("display", "block");
        $(".header-container").css("display", "block");

    }
</script>


<script>
    // When the server is ready...
    $(function () {
        'use strict';

        // Define the url to send the image data to
        var url = 'files.php';

        // Call the fileupload widget and set some parameters
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                // Add each uploaded file name to the #files list
                $.each(data.result.files, function (index, file) {
                    var pathimg = "files/" + file.name;


                    $("<li  style='width:130px' onclick='close_img(&quot;" + pathimg + "&quot;,this)' />").html("<img src='files/" + file.name + "' width='100px' /> <img src='images/close_5.png'  width='20px'> <input type='hidden' name='pathimgs[]' value='" + pathimg + "' />").appendTo('#files');

                });
            },
            progressall: function (e, data) {
                // Update the progress bar while files are being uploaded
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                    progress + '%'
                );
            }
        });
    });

    function close_img(path, i) {
        //console.info(i);
        // $('#files li')[i].remove();
        $(i).remove();
        var r = confirm("Are you sure you want to delete this Image?")
        if (r == true) {
            $.ajax({
                url: 'delete.php',
                data: {'file': path},
                success: function (response) {
                    // do something
                },
                error: function () {
                    // do something
                }
            });
        }
    }
</script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="js/jquery.metisMenu.js"></script>
<!-- MORRIS CHART SCRIPTS -->

<!-- CUSTOM SCRIPTS -->
<script src="js/custom.js"></script>


<script>
    $(document).ready(function () {
        console.log('dskdisdkiwdkiwdiw');
        var counter = 0;

        $("#addrow").on("click", function () {
            // console.log('dskdisdkiwddlsososowksowksowksokwoskiwdiw');
            // var newRow = $("<tr>");
            // var cols = "";
            //
            // cols += '<td><input type="text" class="form-control" name="name' + counter + '"/></td>';
            // cols += '<td><input type="text" class="form-control" name="mail' + counter + '"/></td>';
            // cols += '<td><input type="text" class="form-control" name="phone' + counter + '"/></td>';
            // cols += '<td><input type="text" class="form-control" name="phone' + counter + '"/></td>';
            //
            // cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
            // newRow.append(cols);
            // $("table.order-list").append(newRow);
            // counter++;
            $('#exampleModal').modal("toggle");
        });





    $('.myCheckboxvaliation').change(function() {
        // console.log('kmmomomo');
        const answerId = $(this).closest('tr').find('td:eq(0)').text().trim();
        console.log('kmmomomo'+answerId +$(this).prop('checked'));
        $.ajax({
            type: 'POST',
            url: 'update_status_active_answer_ajax.php', //Your form processing file URL
            data: {
                "v_answer_id": answerId,
                "v_status_active": $(this).prop('checked').toString()
            }, //Forms name
            dataType: 'json',
            success: function (result) {
                alert(result.message);
                // $('#exampleModal').modal("toggle");
                // setTimeout(function(){// wait for 5 secs(2)
                //     location.reload(); // then reload the page.(3)
                // }, 500);
            }
        })
        // $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    });

        $("#sendsubmit").on("click", function () {
            console.log('dskdisdkiwddlsososowksowksowksokwoskiwdiw');
            var teststetid = '';
            teststetid = $('#options-id').val()
            console.log(teststetid);
            var teststet = '';
            teststet = $('#options-one').val()
            console.log(teststet);

            var teststet2 = '';
            teststet2 = $('#options-two').val()
            console.log(teststet2);
            var teststet3 = '';
            teststet3 = $('#options-three').val()
            console.log(teststet3);
            var teststetsku = '';
            teststetsku = $('#answer-SKU').val()
            console.log(teststetsku);

            if (teststet === "" || teststetsku === "") {
                alert("กรุณากรอกข้อมูลให้ครบ")
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'all_valiation_ajex.php', //Your form processing file URL
                    data: {
                        "v_option_one": teststet,
                        "v_option_two": teststet2,
                        "v_option_three": teststet3,
                        "v_sku": teststetsku,
                        "v_ori_id":teststetid
                    }, //Forms name
                    dataType: 'json',
                    success: function (result) {
                            alert(result.message);
                            $('#exampleModal').modal("toggle");
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 500);
                    }
                })
            }


        });


        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });

        $(".button_valiation_submit").click(function () {

            var product_code = $(this).closest('tr').find('td:eq(0)').text();
            var valiation_id = $(this).closest('tr').find("input").val();
            console.log(product_code);
            if (valiation_id === ""){
                alert("กรุณากรอกข้อมูลให้ครบ")
            }else {
                $.ajax({
                    type: 'POST',
                    url: 'update_mapping_product_ajex.php', //Your form processing file URL
                    data: {
                        "valiation_id": valiation_id,
                        "product_code": product_code
                    }, //Forms name
                    dataType: 'json',
                    success: function (result) {
                        alert(result.message);
                        // $('#exampleModal').modal("toggle");
                        // setTimeout(function(){// wait for 5 secs(2)
                        //     location.reload(); // then reload the page.(3)
                        // }, 500);
                    }
                })
            }




        });
    });

    // function onClickTDProduct() {
    //     console.log('dskdisdkiwddlsososowksowksowksokwoskiwdiw');
    //
    //    var dsdsokd  = $(this).parents('tr').find("td:eq(1)").text();
    //     console.log( dsdsokd);
    // }


    function calculateRow(row) {
        var price = +row.find('input[name^="price"]').val();

    }

    function calculateGrandTotal() {
        var grandTotal = 0;
        $("table.order-list").find('input[name^="price"]').each(function () {
            grandTotal += +$(this).val();
        });
        $("#grandtotal").text(grandTotal.toFixed(2));
    }
</script>

</body>
</html>