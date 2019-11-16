<?
include 'header.php';
?>


<script src="js/jquery.fancybox.js"></script>
<script src="js/nextprv.js"></script>

 <?php
 

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");
 

 $sql = "SELECT * FROM product_main where product_code='".$_GET["product_code"]."'";
 $query = mysqli_query($conn, $sql);
 while ($result = mysqli_fetch_assoc($query)) {
	 $product_title_th = $result['product_title_th'];
	 $product_description_th = $result['product_description_th'];
	 $content_prod_th = $result['content_prod_th'];
	
	 
 }	 
 ?>	

        <div class="content-wrapper row">

            <nav class="sidebar">

                <div class="sideNavElement">
                    <img id="acceptGovPOsLogo" src="images/weacceptgop-logo.png" alt="We Accept Government Purchase Orders" />
                </div>
            </nav>

            <main class="main container" role="main">

                <div class="row tss-breadcrumbs dont-print">
                    <div class="col-xs-12"><a href="index.php">Home</a> &nbsp;&nbsp;>&nbsp;&nbsp;<a href="javascript:void(0)"><? echo $_GET["product_category_title_th"]; ?></a> &nbsp;&nbsp;>&nbsp;&nbsp;<a href="javascript:void(0)"><? echo $_GET["product_type_title_th"]; ?></a> </div>
                </div>
				<br/>
				
				<style>
					.head-line-pd{
						text-align: center; 
						padding: 25px 1px 25px 1px;  
						background-color: #dae2e6;
					}	
					.head-line-pd h4 , h6{
						color: #727272;	
					}	
				</style>
				<div class="row">
				  <div class="col-sm-12">
					<div class="col-xs-12 head-line-pd" >
						<h4>จะดีกว่ามั้ย ? กรวยจราจร ซื้อทีเดียวใช้ได้ยาวถึง 5 ปี!</h4>
					</div>
				  </div>	
				</div>
				
                <article itemscope itemtype="http://schema.org/Product" class="item-details">
                    <div class="row" id="productDetailTitleRow">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" name="SizeOptionChanged" id="SizeOptionChanged" value="false" />
                                    <input type="hidden" name="runSizeSelectionTest" id="runSizeSelectionTest" value="false" />
                                    <h6 id="ProductDisplayName-get" itemprop="name itemReviewed"><? echo $product_title_th; ?></h6>
									<h5><font color="red">SKU :<? echo $_GET["product_code"]; ?></font></h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="js/jquery.mobile.navigate.min.js"></script>
                    <script>
                        //Get Product Name for shipping modal when modal opens

                        $(document).ready(function() {
                            $('#shipping-modal').on('shown.bs.modal', function(e) {
                                var displayName = $("#ProductDisplayName-get").text();
                                $('#ProductDisplayName-set').text(displayName);
                            });

                        });
                    </script>
                    <div id="addToCartResult"></div>

                    <!-- check for video tab, get tab html/name (for videos in image gallery) -->

                    <script>
                        $(document).ready(function() {
                            $("#tab-speed-bump-video").closest(".row").hide();
                        });
                    </script>

                    <div class="detailsPartial" id="replace_cdf8cffb19004750975e00212a7ca1b3">

                        <style>
                            #nextImage,
                            #prevImage {
                                right: 0;
                                height: 50%;
                                top: 15% !important;
                            }
                            
                            .image-helper {
                                z-index: -2;
                            }
                            
                            #thumbnail-play-image {
                                top: 50% !important;
                                transform: translateY(-50%);
                                z-index: 2;
                                pointer-events: none;
                            }
                            
                            #productImage-4 {
                                position: relative;
                                top: 50%;
                                transform: translateY(-50%);
                                -webkit-transform: translateY(-50%);
                                -ms-transform: translateY(-50%);
                            }
                            
                            @media screen and (max-width:768px) {
                                .gallery-main-image .glyphicon-play-circle {
                                    font-size: 80px !important;
                                }
                            }
                            
                            @media screen and (max-width:450px) {
                                .gallery-main-image img {
                                    max-width: 60% !important;
                                }
                                .gallery-main-image .glyphicon-play-circle {
                                    font-size: 56px !important;
                                }
                                #gallery-video-embedded {
                                    min-width: 100% !important;
                                }
                            }
                        </style>

                     

                        <!-- Modal for "fullscreen" video -->
                        <div class="modal" id="videoGallery-modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <button id="gallery-video-close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="product-detail-page-main">
                            <section class="col-sm-6 prod-detail-gallery">
                                <div class="gallery-main row">
                                    <div class="gallery-main-image col-lg-10 col-lg-push-2" style="overflow: hidden;">
                                     
                                        <div class="gallery-main-inner full">

                                            <div class="image-overlay">
                                                <div class="image-overlay-center-clickOnly">
                                                    <span class="glyphicon glyphicon-zoom-in"></span>
                                                </div>
                                            </div>

                                            <span class="image-helper left-pos right-pos"></span>
                                            <div id="prevImage" class="onImageNav dont-print" onclick="prvimg();" ><span class="glyphicon glyphicon-chevron-left"></span></div>
											
											<?php

											 $sql = "SELECT image FROM product_image WHERE product_code='".$_GET["product_code"]."' limit 1";
											 $query = mysqli_query($conn, $sql);
											
											
											
											
																						
											$chkimg = "";
											 while ($result = mysqli_fetch_assoc($query)) {
												 $chkimg = $result['image'];
											 ?>	
                                            <img itemprop="image" id="gallery-current-main-image" src="back_end/<? echo $result['image']; ?>"  class="image-toggle magnified cld-responsive" />
											<?
											 }
											 ?>
											 <?
												if($chkimg == ""){
											 ?>
<img itemprop="image" id="gallery-current-main-image" src="back_end/images/noimage.jpg"  class="image-toggle magnified cld-responsive" />
											<?
												}
											?>	
											
                                            <span id="gallery-video-controls" class="glyphicon glyphicon-play-circle hidden dont-print"></span>
                                            <div style="position:relative;" class="dont-print">
                                              
                                                <span id="fs-alt-button" class="glyphicon glyphicon-fullscreen hidden" data-toggle="modal" data-target="#videoGallery-modal"></span>
                                            </div>

                                            <div id="nextImage" class="onImageNav dont-print" onclick="nextimg();"  ><span class="glyphicon glyphicon-chevron-right"></span></div>

                                            <div class="imageText-Container row hidden-xs hidden-sm text-center">
                                                <span class="imageText freeHardware-text"></span>
                                            </div>

                                           
                                        </div>
                                    </div>
									

                                    <div class="imageText-Container col-lg-10 col-lg-push-2 visible-xs visible-sm text-center">
                                        <span class="imageText freeHardware-text"></span>
                                    </div>

                                    <div id="imageThumbnailWrapper" class="col-md-12 col-lg-2 col-lg-pull-10">
                                        <div id="imageThumbnail-ScrollUp" class="imageThumbnail-Scroll visible-lg col-lg-12">
                                            <span class="glyphicon glyphicon-triangle-top"></span>
                                        </div>
										<? 
												 $sql = "SELECT COUNT(image) AS count_img FROM product_image WHERE product_code='".$_GET["product_code"]."'";
												 $query = mysqli_query($conn, $sql);
												 $count_img = 0;
												 while ($result = mysqli_fetch_assoc($query)) {
														$count_img	= $result['count_img'];
												 }		

										?>
										
                                        <div id="imageThumbnailMask" class="" style="height: <? echo $count_img*100; ?>px;">
                                            <div id="imageThumbnailCarousel" class="gallery-thumbnail previews">

                                                <?php

												 $sql = "SELECT image FROM product_image WHERE product_code='".$_GET["product_code"]."'";
												 $query = mysqli_query($conn, $sql);
												  $i = 0;
												 while ($result = mysqli_fetch_assoc($query)) {
													 $i++;
												 ?>	
												<a href="javascript:void(0)" data-count="<? echo $i; ?>" class="<? if($i==1){ echo selected ;}  ?> imgprd" data-full="back_end/<? echo $result['image']; ?>">
                                                <div class="col-xs-3 col-md-3 col-lg-12">
                                                    <div class="gallery-thumnail-wrapper">
                                                        <img id="productImage-1" data-src="back_end/<? echo $result['image']; ?>" src="back_end/<? echo $result['image']; ?>" class="image-toggler active cld-responsive">
                                                        <div id="imageText-1" class="imageText-hidden"></div>
                                                    </div>
                                                </div>
												<?
												}
												?>
										</a>		

                                      	

                                                

                                               
                                            </div>
                                        </div>
                                        <div id="imageThumbnail-ScrollDown" class="imageThumbnail-Scroll visible-lg col-lg-12">
                                            <span class="glyphicon glyphicon-triangle-bottom"></span>
                                        </div>
                                    </div>

                                </div>
                            </section>

                            <section id="productOptionSelectionPanel" class="col-sm-6 product-order magnifier-target printVersion no-pad-onPrint">
                                <ul>

                                


                                    <li class="row shipping-info shipsImmediately">
                                        <div class="col-xs-12 text-center ">
                                            <p>&nbsp;</p>
                                      
                                        </div>
                                    </li>

                                    <li class="row">
                                        <div id="quickFacts-test" class="col-xs-10 col-md-12 quick-facts">
                                            <div class="quick-facts printAtFullWidth">
                                           <?//echo ($product_description_th == "")?"NO Description":$product_description_th; ?>
										   <p>&nbsp;</p>
                                            </div>
                                           
                                        </div>
                                    </li>
									
									<li class="row">
                                        <div id="quickFacts-test" class="col-xs-10 col-md-12 quick-facts">
											<hr />
                                            <div class="quick-facts printAtFullWidth">
                                          <p>SUB-HEAD-LINE</p>
                                            </div>
                                            <hr />
                                        </div>
                                    </li>
									
									<li class="row">
                                        <div id="quickFacts-test" class="col-xs-10 col-md-12 quick-facts">
											<hr />
                                            <div class="quick-facts printAtFullWidth">
                                           <? echo ($product_description_th == "")?"NO Description":$product_description_th; ?>
                                            </div>
                                            <hr />
                                        </div>
                                    </li>
                                   
									 	
                                      

                                    <li class="product-quantity-actions row dont-print">
                                        <form action="/cart/AddToCart" data-ajax="true" data-ajax-loading="#adding-to-cart-indicator" data-ajax-method="POST" data-ajax-mode="replace" data-ajax-update="#addToCartResult" id="AddToCart" method="post">
                                            <input data-val="true" data-val-number="The field ProductOptionId must be a number." id="ProductOptionId" name="ProductOptionId" type="hidden" value="3778" />

                                            <ul>

                                                <li class="product-quantity col-xs-4 dont-print">
                                                    <label for="quantity" class="prod-info">Quantity</label>
                                                    <br />
                                                    <input class="form-control" data-val="true" data-val-number="The field Quantity must be a number." data-val-required="The Quantity field is required." id="Quantity" min="1" name="Quantity" type="number" value="1" />
                                                    <!-- Speed hump calc modal link -->

                                                </li>

                                                <li class="product-actions col-xs-8 dont-print">

                                                 
                                                    <button type="submit" class="btn btn-primary btn-lg add-to-cart dont-print"><span style="display: none" id="adding-to-cart-indicator" class="icon ion-loading-a">&nbsp;</span>Add to Cart</button>
                                                    <a id="ShowCalcShippingModal" data-show-shipping-dialog="not-configured" rel="nofollow" href="/shipping/CalculateShippingModal?quantity=1&productOptionID=3778" data-reveal-id="#shipping-modal"></a>

                                                </li>
												
												<li class="product-volume-pricing dont-print">
													<p class="prod-info">Volume Pricing:</p>
													
													<div class="prod-vol-panel panel panel-default">
														<table class="table table-bordered">
															<thead>
																<tr>
																	
																			<th>
																				<div class="firefox-tablecellWrapper">
																					
																					Quantity<br> 1-14
																				</div>
																			</th>
																		
																			<th>
																				<div class="firefox-tablecellWrapper">
																					
																						<span class="offerBurst hide-offerBurst offerBurst-1">Save<br>10%</span>
																					
																					Quantity<br> 15-49
																				</div>
																			</th>
																		
																			<th>
																				<div class="firefox-tablecellWrapper">
																					
																						<span class="offerBurst hide-offerBurst offerBurst-2">Save<br>18%</span>
																					
																					Quantity<br> 50+
																				</div>
																			</th>
																		
																</tr>
															</thead>
															<tbody>
																<tr>
																	
																			<td>
																				<div class="firefox-tablecellWrapper">
																					
																						<span>184<br></span>
																						Bath.
																					
																				</div>
																			</td>
																		
																			<td>
																				<div class="firefox-tablecellWrapper">
																					
																						<span>167<br></span>
																						Bath.
																					
																				</div>
																			</td>
																		
																			<td>
																				<div class="firefox-tablecellWrapper">
																					
																						<span>156<br></span>
																						Bath.
																					
																				</div>
																			</td>
																		
																</tr>
															</tbody>
														</table>
													</div>
												</li>

                                            </ul>
                                        </form>
                                    </li>

                                   

                                </ul>
                            </section>
                        </div>

                    </div>
                    
                    
                

                    <div class="tabWrapper reviewReload">

                        <section class="row tabWrapper-inner pageBreakAfter">
                            <div class="col-sm-12">
                                <h2 style="cursor:pointer;">
                            <a class="tab-link tab-link-description " data-toggle="collapse" data-target="#tab-description">
                                Description 

                                <span id="glyph-description" class="glyphicon glyphicon-rotate glyphicon-chevron-down glyphicon-rotate-180"></span>
                            </a>
                        </h2>
                                <hr />
                                <div id="tab-description" class="collapse in" itemprop="description">
                                    <? echo ($content_prod_th=="")?"NO Content":$content_prod_th; ?>

                                </div>
                            </div>
                        </section>

                        

                        <div id="RelatedProductsTabWrapper">

                            <section class="row tabWrapper-inner">
                                <div class="col-sm-12 product-list related-product-list">
                                    <h2 style="cursor:pointer;">
                    <a class="tab-link tab-link-relatedProducts" data-toggle="collapse" data-target="#tab-relatedProducts">
                        Related Products <span id="glyph-relatedProducts" class="glyphicon glyphicon-chevron-up"></span>
                    </a>
                </h2>
                                    <hr />
                                    <div id="tab-relatedProducts" class="collapse in">
                                        <section class="row">

                                            <li class="product-list-item col-xs-12 col-sm-4" itemprop="isRelatedTo" itemscope itemtype="http://schema.org/Product">
                                                <a href="javascript:void(0)" class="product-list-link text-center ">
                                                    <img itemprop="image" class="product-list-thumbnail cld-responsive"  src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/i/SGBUMP-144-0-430x560.jpg" alt="&quot;Caution Speed Bumps Ahead&quot; Sign" />
                                                    <br />
                                                    <span itemprop="name" class="product-list-name text-center">&quot;Caution Speed Bumps Ahead&quot; Sign</span>
                                                </a>
                                                <a class="btn btn-info btn-sm " href="javascript:void(0)">View Prices</a>
                                            </li>

                                            <li class="product-list-item col-xs-12 col-sm-4" itemprop="isRelatedTo" itemscope itemtype="http://schema.org/Product">
                                                <a href="javascript:void(0)" class="product-list-link text-center ">
                                                    <img itemprop="image" class="product-list-thumbnail cld-responsive"  src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/i/SBR4HDL-3118-2-333x434.jpg" alt="4' Heavy-Duty Rubber Speed Bump" />
                                                    <br />
                                                    <span itemprop="name" class="product-list-name text-center">4&#39; Heavy-Duty Rubber Speed Bump</span>
                                                </a>
                                                <a class="btn btn-info btn-sm " href="javascript:void(0)">View Prices</a>
                                            </li>

                                        </section>
                                    </div>
                                </div>
                            </section>


                        </div>

                        <section class="row tabWrapper-inner dont-print">
                            <div class="col-sm-12">
                                <h2 style="cursor:pointer;">
                            <a class="tab-link tab-link-speed-bump-video " data-toggle="collapse" data-target="#tab-speed-bump-video">
                                Speed Bump Video 

                                <span id="glyph-speed-bump-video" class="glyphicon glyphicon-rotate glyphicon-chevron-down glyphicon-rotate-180"></span>
                            </a>
                        </h2>
                                <hr />
                                <div id="tab-speed-bump-video" class="collapse in">
                                    <br></br>
                                  
                                    <br></br>

                                </div>
                            </div>
                        </section>

                      

                    </div>

                </article>
              

            </main>
        </div>

<?
mysqli_close($conn);
include 'footer.php';
?>