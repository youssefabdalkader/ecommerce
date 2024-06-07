<?php 
    include_once __DIR__ . "/dir.php" ;
    $title = 'shop' ;
    include_once $dir. "/models/product.php" ;   
    $productobject = new Product;
    if($_GET['id']){
        $productobject->setId($_GET['id']) ;
        $productobject->setStatus(1);
        $productobjectresult = $productobject->getproductbyid();
        $products =$productobjectresult->fetch_object();
        // print_r($products); die; 
        $title = $products->name_en ;
        // print_r($products); die ;


    }else{
        echo "error" ; die ;
    }

    include_once $dir. "/layouts/header.php" ;
    include_once $dir. "/layouts/nav.php" ;
    include_once $dir. "/layouts/breadcrumb.php" ;


?>
		<!-- Product Deatils Area Start -->
        <div class="product-details pt-100 pb-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-img">
                            <img class="zoompro" src="assets/img/product/<?= $products->image ?>" data-zoom-image="assets/img/product-details/product-detalis-bl1.jpg" alt="zoom"/>
                            
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-content">
                            <h4><?= $products->name_en ; ?></h4>
                            <div class="rating-review">
                                <div class="pro-dec-rating">
                                <?php for ($i=1; $i <=5 ; $i++) {
                                                 if($i <= $products->review_avr){
                                                   echo   "<i class='ion-star theme-color'></i>" ;
 
                                                 } else{
                                                    echo  "<i class='ion-android-star-outline '></i>" ;
  
                                                 }
                                                 
                                             } ?>
                                    
                                </div>
                                <div class="pro-dec-review">
                                    <ul>
                                        <li><?= $products->review_conut ; ?> Reviews </li>
                                        <li> Add Your Reviews</li>
                                    </ul>
                                </div>
                            </div>
                            <span><?= $products->price ; ?></span>
                            <div class="in-stock">
                                <?php 
                                    if($products->quantity > 5){
                                        $message = 'In stock' ;
                                    }elseif($products->quantity <= 5 && $products->quantity > 0 ){
                                        $message = "in stock but not long" ;
                                    }else{
                                        $message = "out of stock" ;
                                    }
                                ?>
                                <p>status: <span><?= $message ; ?></span></p>
                            </div>
                            <p> <?= $products->desc_en ; ?> </p>
                            <div class="pro-dec-feature">
                                <ul>
                                    <?php 
                                        $specobject = $productobject->getspec();
                                        if($specobject){
                                           $specvalue = $specobject->fetch_all(MYSQLI_ASSOC) ;
                                            foreach ($specvalue as $key => $spec) {
                                                echo   "<li><span> ". $spec['spec']  ."<span></li>" ;
                                            }
                                        }

                                    ?>
                              
                                </ul>
                            </div>
                            <div class="quality-add-to-cart">
                                <div class="quality">
                                    <label>Qty:</label>
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                </div>
                                <div class="shop-list-cart-wishlist">
                                    <a title="Add To Cart" href="#">
                                        <i class="icon-handbag"></i>
                                    </a>
                                    <a title="Wishlist" href="#">
                                        <i class="icon-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="pro-dec-categories">
                                <ul>
                                    <li class="categories-title">Categories:</li>
                                    <li><a href="#"><?= $products->category_name_en ?> ,</a></li>
                                    <li><a href="shop.php?sub=<?= $products->subcategory_id ?>"><?= $products->subcategory_name_en ?> ,</a></li>
                                    <li><a href="#"><?= $products->brand_name_en ?></a></li>
                                   
                                </ul>
                            </div>
                            <div class="pro-dec-categories">
                                <ul>
                                    <li class="categories-title">Tags: </li>
                                    <li><a href="#"> Oolong, </a></li>
                                    <li><a href="#"> Pu'erh,</a></li>
                                    <li><a href="#"> Dark,</a></li>
                                    <li><a href="#"> Special </a></li>
                                </ul>
                            </div>
                            <div class="pro-dec-social">
                                <ul>
                                    <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                                    <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                                    <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a></li>
                                    <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- Product Deatils Area End -->
        <div class="description-review-area pb-70">
            <div class="container">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav text-center">
                        <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                        <a data-toggle="tab" href="#des-details2">Tags</a>
                        <a data-toggle="tab" href="#des-details3">Review</a>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="des-details1" class="tab-pane ">
                            <div class="product-description-wrapper">
                                <p><?= $products->desc_en ; ?> </p>
                                
                            </div>
                        </div>
                        <div id="des-details2" class="tab-pane">
                            <div class="product-anotherinfo-wrapper">
                                <ul>
                                    <li><span>Tags:</span></li>
                                    <li><a href="#"> Green,</a></li>
                                    <li><a href="#"> Herbal,</a></li>
                                    <li><a href="#"> Loose,</a></li>
                                    <li><a href="#"> Mate,</a></li>
                                    <li><a href="#"> Organic ,</a></li>
                                    <li><a href="#"> special</a></li>
                                </ul>
                            </div>
                        </div>
                         <?php $result =$productobject->getreviw();

                         if($result){
                            $REVIEWS = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($REVIEWS as $key => $REVIEW) {
                                # code...
                                // print_r($REVIEWS);
                           

                         ?>,
                             <div id="des-details3" class="tab-pane active">
                             <div class="rattings-wrapper">
                                 <div class="sin-rattings">
                                     <div class="star-author-all">
                                         <div class="ratting-star f-left">
                                             <?php for ($i=1; $i <=5 ; $i++) {
                                                 if($i <= $products->review_avr){
                                                   echo "<i class='ion-star theme-color'></i>" ;
 
                                                 } else{
                                                     echo  "<i class='ion-android-star-outline '></i>" ;
  
                                                 }
                                                 
                                             } ?>
                                             
                                             <span><?= $products->review_avr ?></span>
                                         </div>
                                         <div class="ratting-author f-right">
                                             <h3>  <?= $REVIEW['frist_name'] ; ?></h3>
                                             <span><?= $REVIEW['created_at'] ; ?></span>
                                             
                                         </div>
                                     </div>
                                      <p>
                                        <?= $REVIEW['comment'] ; ?></p>
                                 </div>
                            <?php }
                            } else { echo "no comment" ;}  ?>
                              
                             <div class="ratting-form-wrapper">
                                 <h3>Add your Comments :</h3>
                                 <div class="ratting-form">
                                     <form action="#">
                                         <div class="star-box">
                                             <h2>Rating:</h2>
                                             <div class="ratting-star">
                                                 <i class="ion-star theme-color"></i>
                                                 <i class="ion-star theme-color"></i>
                                                 <i class="ion-star theme-color"></i>
                                                 <i class="ion-star theme-color"></i>
                                                 <i class="ion-star"></i>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-md-6">
                                                 <div class="rating-form-style mb-20">
                                                     <input placeholder="Name" type="text">
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                                 <div class="rating-form-style mb-20">
                                                     <input placeholder="Email" type="text">
                                                 </div>
                                             </div>
                                             <div class="col-md-12">
                                                 <div class="rating-form-style form-submit">
                                                     <textarea name="message" placeholder="Message"></textarea>
                                                     <input type="submit" value="add review">
                                                 </div>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>

                       
                </div>
            </div>
        </div>
        <div class="product-area pb-100">
            <div class="container">
                <div class="product-top-bar section-border mb-35">
                    <div class="section-title-wrap">
                        <h3 class="section-title section-bg-white">Related Products</h3>
                    </div>
                </div>
                <div class="featured-product-active hot-flower owl-carousel product-nav">
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.html">
                                <img alt="" src="assets/img/product/product-1.jpg">
                            </a>
                            <span>-30%</span>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.html">Le Bongai Tea</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.html">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.html">
                                <img alt="" src="assets/img/product/product-2.jpg">
                            </a>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.html">Society Ice Tea</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.html">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.html">
                                <img alt="" src="assets/img/product/product-3.jpg">
                            </a>
                            <span>-30%</span>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.html">Green Tea Tulsi</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.html">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.html">
                                <img alt="" src="assets/img/product/product-4.jpg">
                            </a>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.html">Best Friends Tea</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.html">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.html">
                                <img alt="" src="assets/img/product/product-5.jpg">
                            </a>
                            <span>-30%</span>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.html">Instant Tea Premix</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.html">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    include_once $dir. "/layouts/footer.php" ;
    include_once $dir. "/layouts/footerscripts.php" ;
?>