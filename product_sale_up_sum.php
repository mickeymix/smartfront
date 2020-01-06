<?php

include 'backoffice/conn.php';
$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");

?>

<div id="productSaleUp">
    <section class="row">
        <div class="col-sm-12">
            <div class="col-xs-12 ">
                <div class="container_row">
                    <div id="" class="collapse in">
                        <div id="carousel" class="slider slider_second">
                            <div class="slider_viewport">
                                <div class="slider_list">
                                    <?php
                            
                            /* 
                            $sql = "SELECT 
                            a.product_code_related , a.id_related
                            ,(SELECT image FROM product_image where a.product_code_related = product_code  LIMIT 1 ) AS img
                            ,(SELECT product_type_title_th FROM product_main where a.product_code_related = product_code  LIMIT 1 ) AS product_type_title_th
                            ,(SELECT product_category_title_th FROM product_main where a.product_code_related = product_code  LIMIT 1 ) AS product_category_title_th
                            ,(SELECT product_title_th FROM product_main where a.product_code_related = product_code  LIMIT 1 ) AS product_title_th
                            FROM product_related a
                            WHERE product_code !='" . $_GET["product_code"] . "' 
                            ORDER BY  a.insert_date  DESC LIMIT 4 ";
                            */
                            $sql =  " select";
                            $sql .= " pm.product_code,";
                            $sql .= " (select image from product_image where product_code = pm.product_code limit 1) as img,";
                            $sql .= " pm.product_type_title_th,";
                            $sql .= " pm.product_category_title_th,";
                            $sql .= " pm.product_title_th";
                            $sql .= " from product_main pm";
                            //$sql .= " where product_code in (";
                            //$sql .= "    select distinct product_code_related from product_related ";
                            //$sql .= "    where product_code = '".$_GET['product_code']."' and product_code_related != '" . $_GET['product_code'] . "' ";
                            //$sql .= " )";
                            $sql .= " order by product_code desc limit 4 ";

                            if ($query = mysqli_query($conn, $sql)) {
                                    // $query = mysqli_query($conn, $sql);    
                                    $i = 0;
                                    while ($result = mysqli_fetch_assoc($query)) {
                                        $i++;
                                        ?>
                                        <div class="slider_item">
                                            <a target="_blank"
                                                href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_code']; ?>
                            &product_category_title_th=<?php echo $result['product_category_title_th']; ?>">
                                                <img src="backoffice/<?php echo ($result['img'] == "") ? 'images/noimage.jpg' : $result['img']; ?>" style="width: 180px; heigth:180px;">
                                            </a>
                                            <div style="height:20px; ">
                                                <h5><a target="_blank"
                                                        href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
                                        &product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code']; ?></a>
                                                </h5>
                                            </div>
                                            <p class="popular-item-desc"
                                                style="width:200px; text-align:left; "><?php echo $result['product_title_th']; ?></p>
                                            
                                                <form action="product_add_order_service.php" method="post">
                                                    <input type="hidden" name="product_code" id="product_code" value="<?php echo $_GET["product_code"]; ?>">      
                                                    <input type="hidden" name="product_name" id="product_name" value="<?php echo $result['product_type_title_th']; ?>">      
                                                    <input type="hidden" name="product_image" id="product_image" value="<?php echo $result['img']; ?>">      
                                                    <input type="hidden" name="product_amount" id="product_amount" value="1">
                                                     <button type="submit" class="btn btn-primary" oneclick="add_produc">BUY NOW</button>
                                                </form>

                                        </div>
                                        
                                        <?php
                                    }
                                 } // End if check result data = 0
                                
                                    ?>
                                   
                                    <input type="hidden" id="count_rel" value="<?php echo $i; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
    mysqli_close($conn);
?>