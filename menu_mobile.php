 <?php 
	$conn = mysqli_connect($host, $user, $pass, $dbname);
	mysqli_set_charset($conn,"utf8");
 ?>

<div id="mobile-menu" style="">
        <div id="mobile-menu-out-toggle">
            <span class="icon ion-navicon"></span>
        </div>

        <ul id="mobileCats" style="display: none;">
            <div class="row mobileNav-allCats">   
			<?php
			
			 $sql = "SELECT * FROM  menu";
			 $query = mysqli_query($conn, $sql);
			 
			 
			 
			 
			 while ($result = mysqli_fetch_assoc($query)) {	
			 
				
			
			 ?>				
                    <ul>
                        <!-- categories -->
                        <li class="col-xs-12 mobileNav-Category" onclick="switchList('mobileCats', 'mobileSubCatsFor-<?php echo $result['id_menu']; ?>')" style="">
                            <img class="mobileNav-thumbnailImg pull-left cld-responsive"  src="backoffice/<?php echo $result['menu_img']; ?>" width="32px">
                            <span class="catName"><?php echo $result['menu_name']; ?></span>
                        </li>
                    </ul>
			 <?php } ?>

					<ul>
                        <!-- categories -->
                        <li class="col-xs-12 mobileNav-Category" onclick="javascript:location.href='product_all.php'">
                            <img class="mobileNav-thumbnailImg pull-left cld-responsive"  src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_100/v47/i/traffic-cones-menu-320x270.png">
                            <span class="catName">สินค้าทั้งหมด</span>
                        </li>
                    </ul>			
<!--				
                    <ul>             
                        <li class="col-xs-12 mobileNav-Category" onclick="switchList('mobileCats', 'mobileSubCatsFor-2')" style="">
                            <img class="mobileNav-thumbnailImg pull-left cld-responsive" data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/i/speed-bumps-humps-menu-320x270.png" src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_100/v47/i/speed-bumps-humps-menu-320x270.png">
                            <span class="catName">Speed Bumps &amp; Humps</span>
                        </li>
                    </ul>       
-->					
            </div>
        </ul>
		<?php
			
		 $sql = "SELECT * FROM  menu";
		 $query = mysqli_query($conn, $sql);
		 
		 while ($result = mysqli_fetch_assoc($query)) {	
		 $id_menu = $result['id_menu'];
		 ?>		
        <ul id="mobileSubCatsFor-<?php echo $result['id_menu']; ?>">
            
       
            <li class="mobileCatHeader" onclick="switchList('mobileSubCatsFor-<?php echo $result['id_sub_menu']; ?>','mobileCats')">
                <span class="mobileSubCatArrow icon ion-chevron-up" style="color:#fff"></span><div style="color:#fff;"><?php echo $result['menu_name']; ?></div>
            </li>
				<?php
			
				 $sql2 = "SELECT * FROM sub_menu WHERE id_menu = '$id_menu'";
				 $query2 = mysqli_query($conn, $sql2);
				 
				 while ($result2 = mysqli_fetch_assoc($query2)) {	
				 $url_menu = $result2['url_menu'];
				 ?>	
            
                <a class="mobileMenu-productLink">
                    <li id="mobileMenu-subcat-23" onclick="window.location='<? echo $url_menu; ?>';">
                     <img class="mobileNav-thumbnailImg cld-responsive"  src="backoffice/<?php echo $result2['sub_menu_img']; ?>"> 
                        <span><?php echo $result2['name_sub_menu']; ?></span>
                    </li>
                </a>
            
                 <?php } ?>            
        </ul>
		<?php } ?>
  <!--                 
        <ul id="mobileSubCatsFor-2">
            
            <li class="mobileCatHeader" onclick="switchList('mobileSubCatsFor-2','mobileCats')">
                <span class="mobileSubCatArrow icon ion-chevron-up" style="color:#fff"></span><div style="color:#fff;">Speed Bumps &amp; Humps</div>
            </li>
        
            
                <a class="mobileMenu-productLink">
                    <li id="mobileMenu-subcat-4" onclick="window.location='/speed-bumps-humps/rubber-speed-bump';">
                        <img class="mobileNav-thumbnailImg cld-responsive" data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_auto,f_auto,q_90,w_60/v1/i/rubber-speed-bump-menu-160x208.jpg" src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,f_auto,q_90,w_60/v1/i/rubber-speed-bump-menu-160x208.jpg">
                        <span>Reflective Rubber Speed Bumps</span>
                    </li>
                </a>
            
                <a class="mobileMenu-productLink">
                    <li id="mobileMenu-subcat-125" onclick="window.location='/speed-bumps-humps/economy-rubber';">
                        <img class="mobileNav-thumbnailImg cld-responsive" data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_auto,f_auto,q_90,w_60/v1/i/economy-rubber-menu-267x348.png" src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,f_auto,q_90,w_60/v1/i/economy-rubber-menu-267x348.png">
                        <span>Economy Rubber Speed Bumps</span>
                    </li>
                </a>
            
                <a class="mobileMenu-productLink">
                    <li id="mobileMenu-subcat-60" onclick="window.location='/speed-bumps-humps/rubber-speed-hump';">
                        <img class="mobileNav-thumbnailImg cld-responsive" data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_auto,f_auto,q_90,w_60/v1/i/rubber-speed-hump-menu-160x208.jpg" src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,f_auto,q_90,w_60/v1/i/rubber-speed-hump-menu-160x208.jpg">
                        <span>Recycled Rubber Speed Humps</span>
                    </li>
                </a>
            
                <a class="mobileMenu-productLink">
                    <li id="mobileMenu-subcat-3" onclick="window.location='/speed-bumps-humps/plastic-speed-bump';">
                        <img class="mobileNav-thumbnailImg cld-responsive" data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_auto,f_auto,q_90,w_60/v1/i/plastic-speed-bump-menu-160x208.jpg" src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,f_auto,q_90,w_60/v1/i/plastic-speed-bump-menu-160x208.jpg">
                        <span>Solid Plastic Speed Bumps</span>
                    </li>
                </a>
            
                <a class="mobileMenu-productLink">
                    <li id="mobileMenu-subcat-137" onclick="window.location='/speed-bumps-humps/cable-protectors';">
                        <img class="mobileNav-thumbnailImg cld-responsive" data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_auto,f_auto,q_90,w_60/v1/i/cable-protectors-menu-160x208.png" src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,f_auto,q_90,w_60/v1/i/cable-protectors-menu-160x208.png">
                        <span>Cable Protectors</span>
                    </li>
                </a>
            
        </ul>
   -->


<!--        <div class="col-xs-12 mobileNav-callouts">-->
<!--            --><?//   $sql = "SELECT * FROM service_config WHERE id = 1 ";
//            $query = mysqli_query($conn, $sql);
//
//            while ($result = mysqli_fetch_assoc($query)) {
//                ?>
<!--                <div class="row">-->
<!--                    <div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">-->
<!--                        <h2><span>--><?//echo  $result['service_top_title']?><!--</span></h2>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="row">-->
<!--                    <div class="col-sm-4 ">-->
<!--                        <div class="col-xs-12 col-md-12"><a href="--><?//echo $result['service_link_one']?><!--" target="_blank">-->
<!--                                <img class="cld-responsive img-responsive center-block lazy" data-src="backoffice/--><?//echo  $result['service_img_one']?><!--" height="250" width="250" alt="shipping truck icon">-->
<!--                            </a></div>-->
<!--                        <div class="col-xs-12 col-md-12 text-center">-->
<!--                            <h2>--><?//echo  $result['service_title_one']?><!--</h2>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4">-->
<!--                        <div class="col-xs-12 col-md-12"><a href="--><?//echo $result['service_link_two']?><!--" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/--><?//echo  $result['service_img_two']?><!--" height="250" width="250" alt="customer service icon"></a></div>-->
<!--                        <div class="col-xs-12 col-md-12 text-center">-->
<!--                            <h2>--><?//echo  $result['service_title_two']?><!--</h2>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4">-->
<!--                        <div class="col-xs-12 col-md-12"><a href="--><?//echo $result['service_link_three']?><!--" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/--><?//echo  $result['service_img_three']?><!--" height="250" width="250" alt="customer service icon"></a></div>-->
<!--                        <div class="col-xs-12 col-md-12 text-center">-->
<!--                            <h2>--><?//echo  $result['service_title_three']?><!--</h2>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            --><?//}?><!-- </div>-->
        <div class="mobileNav-footer">
            



<footer class="site-footer dont-print">
	<div class="navbar-dark row">
		<ul class="footer-links">
            <?php $conn = mysqli_connect($host, $user, $pass, $dbname);
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
            
			<li>©Copyright &copy;2008 www.trafficthai.com &#8482; All Rights Reserved</li>
            <li class="serverID">01</li>
		</ul>
	</div>
</footer>

<style>
    .latest-posts .feed-image{
        display:none;
    }
    #footer-hours{
        padding-left:5px;
        padding-right:5px;
    }
    #footer-hours ul{
        padding-left:5px;
        list-style-type: none;
    }
</style>



        </div>
    </div>
	
<?php
mysqli_close($conn);
?>