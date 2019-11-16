 <?

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    mysqli_set_charset($conn, "utf8");
    ?>

 <ul class="nav navbar-nav" id="header-nav-left">


     <li class="dropdown" id="header-nav-categories">

         <a id="TopNavToggleDropDownLink" href="#" onclick="gaNav('MainMenu')" class="dropdown-toggle dropdown-toggle-darkblue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>All Products <span id="nav-status-indicator" class="glyphicon glyphicon-chevron-down"></span></a>
         <ul class="dropdown-menu">
        
             <?php

                $sql = "SELECT * FROM  menu WHERE menu_status = 'S' ORDER BY menu_order";
                $query = mysqli_query($conn, $sql);

                while ($result = mysqli_fetch_assoc($query)) {
                    $id_menu = $result['id_menu'];
                    ?>
                 <li class="dropdown-submenu">
                     
                     <a target="_blank" href="menu_main.php?id_menu=<?php echo $id_menu; ?>&menu_keyword=<?php echo $result['menu_keyword']; ?>" onclick="gaNav('cat-Traffic Cones')"><?php echo $result['menu_name']; ?></a>

                     <div class="dropdown-mouseAssist">
                         
                         <ul class="dropdown-menu inner-dd-menu">
                        
                             <?php

                                $sql2 = "SELECT * FROM sub_menu WHERE id_menu = '$id_menu'";
                                $query2 = mysqli_query($conn, $sql2);

                                while ($result2 = mysqli_fetch_assoc($query2)) {
                                    ?>
                                 <div class="col-xs-3 dropdown-menu-product">
                                     <a target="_blank" href="<?php echo $result2['url_menu']; ?>">
                                         <img id="sidebar-catImg-1" class="sidebar-catImg cld-responsive lazy" data-src="backoffice/<?php echo $result2['sub_menu_img']; ?>" src="backoffice/images/noimage.jpg">
                                         <div class="dropdown-menu-productName text-center"><?php echo $result2['name_sub_menu']; ?></div>
                                     </a>
                                 </div>
                             <? } ?>
                             <div class="topright"><a href="menu_main.php?id_menu=<?php echo $id_menu; ?>&menu_keyword=<?php echo $result['menu_keyword']; ?>" style="color: rgb(186, 37, 37)">สินค้าทั้งหมด >></a></div>

                         </ul>
                         
                         <div id="pointed"></div>
                         <div class="mouseAssist-miniBlock"></div>
                        

                     </div>
                 </li>
             <? } ?>
             <li class="dropdown-submenu">
                 <a target="_blank" href="menu_other_product.php">สินค้าเพิ่มเติม</a>

             </li>

         </ul>
     </li>
 </ul>

 <?

    mysqli_close($conn);
    ?>


 <style>
     .tt-suggestions,
     .search-product-number,
     .search-product-category {
         background-color: #eef4ff;
         padding: 10px;
     }

     a.searchRow {
         color: #3270aa;
     }

     .search-product-category,
     .search-product-number {
         margin-bottom: 0px;
         border-bottom: 1px solid #d8e6f3
     }

     .tt-dataset-product-datasource,
     .tt-dataset-subcategory-datasource {
         margin-bottom: 0px;
         margin-top: 0px;
     }

     .tt-query {
         -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
         -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
         box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     }

     .tt-hint {
         color: #999
     }

     .tt-dropdown-menu {
         width: 452px;
         margin-top: 3px;
         padding: 4px 0;
         background-color: #eef4ff;
         border: 1px solid #ccc;
         border: 1px solid rgba(0, 0, 0, 0.2);
         -webkit-border-radius: 4px;
         -moz-border-radius: 4px;
         border-radius: 4px;
         -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
         -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
         box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
     }

     .tt-suggestion {
         padding: 3px 20px;
         line-height: 24px;
     }

     .tt-suggestion.tt-cursor,
     .tt-suggestion:hover,
     .tt-suggestion a.searchRow:hover {
         color: #fff !important;
         background-color: #0097cf;
     }

     .tt-suggestion p {
         margin: 0;
     }

     span.twitter-typeahead {
         width: 100%;
     }

     .input-group span.twitter-typeahead {
         display: block !important;
     }

     .input-group span.twitter-typeahead .tt-dropdown-menu {
         top: 32px !important;
     }

     .input-group.input-group-lg span.twitter-typeahead .tt-dropdown-menu {
         top: 44px !important;
     }

     .input-group.input-group-sm span.twitter-typeahead .tt-dropdown-menu {
         top: 28px !important;
     }
 </style>
 <style>
     .dropdown-menu .mouseAssist-miniBlock {
         height: 42px;
         width: 42px;
         //border:2px solid red;
         position: absolute;
         z-index: 45;
         left: -41px;
         top: 60px;
     }

     .dropdown-menu .mouseAssist-miniBlock:hover {
         visibility: hidden;
         transition: 1s;
     }
 </style>

 <style>
     #pointed {
         position: absolute;
         top: 25px;
         left: 0;
         margin: 0 auto;
         width: 50px;
         padding: 4px;
         color: #fff;
         background-color: #dfdfdf;
         min-height: 40px;
     }

     #pointed:before {
         position: absolute;
         top: 50%;
         left: -10px;
         content: '';
         width: 0;
         height: 0;
         margin: -11px 0 0;
         border-right: solid 10px #dfdfdf;
         border-bottom: solid 10px transparent;
         border-top: solid 10px transparent;
     }



     #header-nav-main .container-fluid #header-nav-left #header-nav-categories .dropdown-menu li.dropdown-submenu .dropdown-menu.inner-dd-menu {
         width: 530px !important;
         border: 3px solid #dfdfdf !important;
         background-color: #fff !important;
         /*styles for better movement paths */
         margin: 50px 50px 50px 0;
         position: absolute;
         top: -30px;
         left: 0;
     }


     .dropdown-menu .dropdown-submenu .dropdown-mouseAssist {
         width: 550px;
         height: 550px;
         position: absolute;
         left: 218px;
         top: -30px;
         z-index: 20;
     }

     .dropdown-menu .dropdown-submenu .dropdown-mouseAssist:hover .inner-dd-menu {
         z-index: 27;
         visibility: visible;
         display: block;
     }

     /* only show desired menu item on hover (prevents accidental menu changes on "invisible" elements) */
     .dropdown-menu .dropdown-submenu .dropdown-mouseAssist {
         visibility: hidden;
     }

     .dropdown-menu .dropdown-submenu:hover .dropdown-mouseAssist {
         visibility: visible;
     }

     .inner-dd-menu .dropdown-menu-product {
         height: 200px;
     }

     .inner-dd-menu .dropdown-menu-productName {
         color: #428bca;
         margin-top: 5px;
     }

     .inner-dd-menu .dropdown-menu-productName:hover {
         color: #fa6128;
     }

     .inner-dd-menu .sidebar-catImg {
         height: auto;
         width: 100%;
     }

     .inner-dd-menu .sidebar-catImg:hover {
         //-webkit-transform: scale(0.8);
         //transform: scale(0.8);
         padding: 5px;
     }

     #header-nav-main .container-fluid #header-nav-left #header-nav-categories .dropdown-menu li.dropdown-submenu:hover a::after {
         content: none !important;
     }

     #header-nav-main .container-fluid #header-nav-left #header-nav-categories .dropdown-menu.inner-dd-menu .dropdown-submenu:hover a::after {
         content: none !important;
     }

     .dropdown-menu-product a:hover {
         background-color: transparent !important;
     }

     .topright {
         position: absolute;
         bottom: 8px;
         right: 16px;
         font-size: 13px;
         color: #fa6128
     }
 </style>