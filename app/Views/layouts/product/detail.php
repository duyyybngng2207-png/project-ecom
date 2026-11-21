<?php
/**
 * @var array $product
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $review
 */
?>
<main class="main">
    <div class="section-box">
        <div class="breadcrumbs-div">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a class="font-xs color-gray-1000" href="/">Home</a></li>
                    <li><a class="font-xs color-gray-500" href="shop-grid.html">Electronics</a></li>
                    <li><a class="font-xs color-gray-500" href="shop-grid.html">Cell phone</a></li>
                    <li><a class="font-xs color-gray-500" href="shop-grid.html">Accessories</a></li>
                </ul>
            </div>
        </div>
    </div>
    <section class="section-box shop-template">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="color-brand-3 mb-5 mw-80"><?php echo $product['name']; ?></h3>
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-7 text-center text-sm-start mb-mobile"><span class="bytext color-gray-500 font-xs font-medium">by</span><a class="byAUthor color-gray-900 font-xs font-medium" href="shop-vendor-single.html"> Ecom Tech</a>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="fa fa-star <?php echo $i <= round($product['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                <?php endfor; ?>
                            <div class="sku-product d-inline-block"><span class="font-sm color-brand-3 font-medium">SKU:</span><span class="font-sm color-gray-500"><?php echo $product['sku']; ?></span></div>
                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-4 col-sm-5 text-center text-sm-end">
                            <div class="d-inline-block">
                                <a class="mr-20" id="save-wishlist" href="" data-is-wishlist="<?php echo $product['is_wishlist']; ?>" data-id="<?php echo $product['id']; ?>">
                                    <span class="btn btn-wishlist mr-5 opacity-100 transform-none <?php if(!empty($checkUserWishlist)) echo 'active-wishlist'; ?>"></span>
                                    <span class="font-md color-gray-900">Add to Wish list</span>
                                </a>
                                <a href="shop-compare.html">
                                    <span class="btn btn-compare mr-5 opacity-100 transform-none"></span>
                                    <span class="font-md color-gray-900">Add to Compare</span>
                                </a>
                                <div class="d-inline-block align-middle ml-50">
                                    <div class="share-link"><span class="font-md-bold color-brand-3 mr-15 d-none d-lg-inline-block">Share</span><a class="facebook hover-up" href="#"></a><a class="printest hover-up" href="#"></a><a class="twitter hover-up" href="#"></a><a class="instagram hover-up" href="#"></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom pt-10 mb-20"></div>
                </div>
                <div class="col-lg-5">
                    <div class="gallery-image">
                        <div class="galleries">
                            <div class="detail-gallery">
                                <label class="label">-17%</label>
                                <div class="product-image-slider">
                                    <figure class="border-radius-10"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></figure>
                                    <figure class="border-radius-10"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></figure>
                                    <figure class="border-radius-10"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></figure>
                                    <figure class="border-radius-10"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></figure>
                                    <figure class="border-radius-10"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></figure>
                                    <figure class="border-radius-10"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></figure>
                                    <figure class="border-radius-10"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></figure>
                                </div>
                            </div>
                            <div class="slider-nav-thumbnails">
                                <div>
                                    <div class="item-thumb"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></div>
                                </div>
                                <div>
                                    <div class="item-thumb"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></div>
                                </div>
                                <div>
                                    <div class="item-thumb"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></div>
                                </div>
                                <div>
                                    <div class="item-thumb"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></div>
                                </div>
                                <div>
                                    <div class="item-thumb"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></div>
                                </div>
                                <div>
                                    <div class="item-thumb"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></div>
                                </div>
                                <div>
                                    <div class="item-thumb"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $product['id']; ?>.jpg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-tags mt-15 mb-30">
                        <div class="d-inline-block mr-25"><span class="font-sm font-medium color-gray-900">Category:</span><a class="link" href="#">Smartphones</a></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 mb-30">
                            <div class="box-product-price">
                                <h3 class="color-brand-3 price-main d-inline-block mr-10">$<?php echo $product['discount_price']; ?></h3><span class="color-gray-500 price-line font-xl line-througt">$<?php echo $product['price']; ?></span>
                            </div>
                            <div class="box-progress-product mt-15 mb-20">
                                <div class="progress mb-5">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><span class="font-xs color-gray-500">Sold: 135/320</span>
                            </div>
                            <div class="product-description color-gray-900 mb-30">
                                <ul class="list-dot">
                                    <li><?php echo $product['content']; ?></li>
                                </ul>
                            </div>
                            <div class="box-product-color">
                                <p class="font-sm color-gray-900">Color:<span class="color-brand-2 nameColor">Pink Gold</span></p>
                                <ul class="list-colors">
                                    <li class="disabled"><img src="assets/imgs/page/product/img-thumb.png" alt="Ecom" title="Pink"></li>
                                    <li><img src="assets/imgs/page/product/img-thumb.png" alt="Ecom" title="Gold"></li>
                                    <li><img src="assets/imgs/page/product/img-thumb.png" alt="Ecom" title="Pink Gold"></li>
                                    <li><img src="assets/imgs/page/product/img-thumb.png" alt="Ecom" title="Silver"></li>
                                    <li class="active"><img src="assets/imgs/page/product/img-thumb.png" alt="Ecom" title="Pink Gold"></li>
                                    <li class="disabled"><img src="assets/imgs/page/product/img-thumb.png" alt="Ecom" title="Pink Gold"></li>
                                    <li class="disabled"><img src="assets/imgs/page/product/img-thumb.png" alt="Ecom" title="Pink Gold"></li>
                                </ul>
                            </div>
                            <div class="box-product-style-size mt-30">
                                <div class="row">
                                    <div class="col-lg-12 mb-20">
                                        <p class="font-sm color-gray-900">Style:<span class="color-brand-2 nameStyle">S22</span></p>
                                        <ul class="list-styles">
                                            <li class="disabled" title="S22 Ultra">S22 Ultra</li>
                                            <li class="active" title="S22">S22</li>
                                            <li title="S22 + Standing Cover">S22 + Standing Cover</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12 mb-10">
                                        <p class="font-sm color-gray-900">Size:<span class="color-brand-2 nameSize">512GB</span></p>
                                        <ul class="list-sizes">
                                            <li class="disabled" title="1GB">1GB</li>
                                            <li class="active" title="512 GB">512 GB</li>
                                            <li title="256 GB">256 GB</li>
                                            <li class="disabled" title="64GB">64GB</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="buy-product mt-25">
                                <div class="font-sm text-quantity mb-10">Quantity</div>
                                <div class="box-quantity" >
                                    <div class="input-quantity">
                                        <input class="font-xl color-brand-3" type="text" id="quantity" value="1"><span class="minus-cart"></span><span class="plus-cart"></span>
                                    </div>
                                    <div class="button-buy button-buy-full">
                                        <a class="btn btn-buy" id="buy-product" data-id="<?php echo $product['id']; ?>" href="<?php echo _HOST_URL;?>/shop-cart">Buy now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="pl-30 pl-mb-0">
                                <div class="box-featured-product">
                                    <div class="item-featured">
                                        <div class="featured-icon"><img src="assets/imgs/page/product/delivery.svg" alt="Ecom"></div>
                                        <div class="featured-info"><span class="font-sm-bold color-gray-1000">Free Delivery</span>
                                            <p class="font-sm color-gray-500 font-medium">From all orders over $10</p>
                                        </div>
                                    </div>
                                    <div class="item-featured">
                                        <div class="featured-icon"><img src="assets/imgs/page/product/support.svg" alt="Ecom"></div>
                                        <div class="featured-info"><span class="font-sm-bold color-gray-1000">Support 24/7</span>
                                            <p class="font-sm color-gray-500 font-medium">Shop with an expert</p>
                                        </div>
                                    </div>
                                    <div class="item-featured">
                                        <div class="featured-icon"><img src="assets/imgs/page/product/return.svg" alt="Ecom"></div>
                                        <div class="featured-info"><span class="font-sm-bold color-gray-1000">Return & Refund</span>
                                            <p class="font-sm color-gray-500 font-medium">Free return over $200</p>
                                        </div>
                                    </div>
                                    <div class="item-featured">
                                        <div class="featured-icon"><img src="assets/imgs/page/product/payment.svg" alt="Ecom"></div>
                                        <div class="featured-info"><span class="font-sm-bold color-gray-1000">Secure payment</span>
                                            <p class="font-sm color-gray-500 font-medium">100% Protected</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-sidebar-product">
                                    <div class="banner-right h-500 text-center mb-30 banner-right-product"><span class="text-no font-11">No.9</span>
                                        <h5 class="font-md-bold mt-10">Sensitive Touch<br class="d-none d-lg-block">without fingerprint</h5>
                                        <p class="text-desc font-xs mt-10">Smooth handle and accurate click</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-bottom pt-30 mb-40"></div>
            <h4 class="color-brand-3 mb-20">Frequently Bought Together</h4>
            <div class="box-bought-together">
                <div class="box-product-bought box-product-bought-2">
                    <div class="product-bought"><img src="assets/imgs/page/product/sp1.png" alt="Ecom"></div>
                    <div class="product-bought"><img src="assets/imgs/page/product/sp2.png" alt="Ecom"></div>
                    <div class="product-bought"><img src="assets/imgs/page/product/sp3.png" alt="Ecom"></div>
                </div>
                <div class="price-bought">
                    <h3 class="color-brand-3 mr-10">$2856.3</h3><span class="font-lg color-gray-900">(3 items)</span>
                    <div class="box-btn-add-cart"><a class="btn btn-cart" href="shop-cart.html">Add To Cart</a></div>
                </div>
            </div>
            <label class="cb-container-2">
                <input type="checkbox" checked="checked"><span class="font-md color-brand-3"><strong>This item:</strong>iPhone 12 Pro Max 128GB Pacific Blue - $1,099.00</span><span class="checkmark"></span>
            </label>
            <label class="cb-container-2">
                <input type="checkbox" checked="checked"><span class="font-md color-brand-3">Apple AirPods Pro, Active Noise Cancellation, Custom Fit - $197.00</span><span class="checkmark"></span>
            </label>
            <label class="cb-container-2">
                <input type="checkbox" checked="checked"><span class="font-md color-brand-3">Apple iMac 24" All-In-One Computer, Apple M1, 8GB RAM, 512GB SSD, macOS Big Sur, Green, MGPJ3LL/A - $1,599.00</span><span class="checkmark"></span>
            </label>
        </div>
    </section>
    <section class="section-box shop-template">
        <div class="container">
            <div class="pt-30 mb-10">
                <ul class="nav nav-tabs nav-tabs-product" role="tablist">
                    <li><a class="active" href="#tab-description" data-bs-toggle="tab" role="tab" aria-controls="tab-description" aria-selected="true">Description</a></li>
                    <li><a href="#tab-reviews" data-bs-toggle="tab" role="tab" aria-controls="tab-reviews" aria-selected="true">Reviews</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-description" role="tabpanel" aria-labelledby="tab-description">
                        <div class="display-text-short">
                            <p><?php echo $product['content']; ?></p>
                        </div>
                        <div class="mt-20 text-center"><a class="btn btn-border font-sm-bold pl-80 pr-80 btn-expand-more">More Details</a></div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews">
                        <div class="comments-area">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="mb-30 title-question">Customer questions &amp; answers</h4>
                                    <div class="comment-list">
                                        <?php foreach($getAllReviews as $key => $item): ?>
                                        <div class="single-comment justify-content-between d-flex mb-30 hover-up">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center"><img src="assets/imgs/page/product/author-2.png" alt="Ecom"><a class="font-heading text-brand" href="#"><?php echo $item['name']; ?></a></div>
                                                <div class="desc">
                                                    <div class="d-flex justify-content-between mb-10">
                                                        <div class="d-flex align-items-center"><span class="font-xs color-gray-700"><?php echo $item['created_at'];?></span></div>
                                                        <div class="product-rate d-inline-block">
                                                            <div class="product-rating" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                    <p class="mb-10 font-sm color-gray-900">
                                                        <?php echo $item['content']; ?><a class="reply" href="#"> Reply</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom pt-30 mb-50"></div>
                    <h4 class="color-brand-3">Related Products</h4>
                        <div class="list-products-5 mt-20 mb-40">
                            <?php foreach($getAllProducts as $key=>$item):?>
                            <?php if($key <5): ?>
                            <div class="card-grid-style-3">
                                <div class="card-grid-inner">
                                    <div class="tools"><a class="btn btn-trend btn-tooltip mb-10" href="#" aria-label="Trend" data-bs-placement="left"></a><a class="btn btn-wishlist btn-tooltip mb-10" href="<?php echo _HOST_URL;?>/shop-wishlist" aria-label="Add To Wishlist"></a><a class="btn btn-compare btn-tooltip mb-10" href="shop-compare.html" aria-label="Compare"></a><a class="btn btn-quickview btn-tooltip" aria-label="Quick view" href="#ModalQuickview" data-bs-toggle="modal"></a></div>
                                    <div class="image-box"><span class="label bg-brand-2">-17%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg"></a></div>
                                    <div class="info-right"><a class="font-xs color-gray-500" href="shop-vendor-single.html">Apple</a><br><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                            <?php endfor; ?>
                                        <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                        <div class="mt-20 box-btn-cart"><a class="btn btn-cart btn-add-to-cart" href="<?php echo _HOST_URL;?>/shop-cart" data-id="<?php echo $item['id']; ?>">Add To Cart</a></div>
                                        <ul class="list-features">
                                            <li><?php echo $item['content']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>
                    <div class="border-bottom pt-20 mb-40"></div>
                    <h4 class="color-brand-3">You may also like</h4>
                        <div class="list-products-5 mt-20 mb-40">
                            <?php foreach($getAllProducts as $key=>$item):?>
                            <?php if($key >6 && $key <12): ?>
                            <div class="card-grid-style-3">
                                <div class="card-grid-inner">
                                    <div class="tools"><a class="btn btn-trend btn-tooltip mb-10" href="#" aria-label="Trend" data-bs-placement="left"></a><a class="btn btn-wishlist btn-tooltip mb-10" href="<?php echo _HOST_URL;?>/shop-wishlist" aria-label="Add To Wishlist"></a><a class="btn btn-compare btn-tooltip mb-10" href="shop-compare.html" aria-label="Compare"></a><a class="btn btn-quickview btn-tooltip" aria-label="Quick view" href="#ModalQuickview" data-bs-toggle="modal"></a></div>
                                    <div class="image-box"><span class="label bg-brand-2">-17%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg"></a></div>
                                    <div class="info-right"><a class="font-xs color-gray-500" href="shop-vendor-single.html">Apple</a><br><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                            <?php endfor; ?>
                                        <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                        <div class="mt-20 box-btn-cart"><a class="btn btn-cart btn-add-to-cart" href="<?php echo _HOST_URL;?>/shop-cart" data-id="<?php echo $item['id']; ?>">Add To Cart</a></div>
                                        <ul class="list-features">
                                            <li><?php echo $item['content']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>
                    <div class="border-bottom pt-20 mb-40"></div>
                    <h4 class="color-brand-3">Recently viewed items</h4>
                        <div class="row mt-40">
                            <?php foreach($getAllProducts as $key=>$item):?>
                            <?php if($key >11 && $key <16): ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-grid-style-2 card-grid-none-border hover-up">
                                    <div class="image-box"><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg"></a>
                                    </div>
                                    <div class="info-right"><span class="font-xs color-gray-500">HP</span><br><a class="color-brand-3 font-xs-bold" href="#"><?php echo $item['name']; ?></a>
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                            <?php endfor; ?>
                                        <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>
                    <div class="border-bottom pt-20 mb-40"></div>
                    <h4 class="color-brand-3">Similar products to compare</h4>
                    <div class="list-products-5 mt-20 mb-40">
                            <?php foreach($getAllProducts as $key=>$item):?>
                                <?php if($key >15 && $key <19): ?>
                                <div class="card-grid-style-3">
                                    <div class="card-grid-inner">
                                        <div class="tools"><a class="btn btn-trend btn-tooltip mb-10" href="#" aria-label="Trend" data-bs-placement="left"></a><a class="btn btn-wishlist btn-tooltip mb-10" href="<?php echo _HOST_URL;?>/shop-wishlist" aria-label="Add To Wishlist"></a><a class="btn btn-compare btn-tooltip mb-10" href="shop-compare.html" aria-label="Compare"></a><a class="btn btn-quickview btn-tooltip" aria-label="Quick view" href="#ModalQuickview" data-bs-toggle="modal"></a></div>
                                        <div class="image-box"><span class="label bg-brand-2">-17%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg"></a></div>
                                        <div class="info-right"><a class="font-xs color-gray-500" href="shop-vendor-single.html">Apple</a><br><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                <?php endfor; ?>
                                            <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                            <div class="mt-20 box-btn-cart"><a class="btn btn-cart btn-add-to-cart" href="<?php echo _HOST_URL;?>/shop-cart" data-id="<?php echo $item['id']; ?>">Add To Cart</a></div>
                                            <ul class="list-features">
                                                <li><?php echo $item['content']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-20">
        <div class="text-center"><a href="#"><img src="assets/imgs/page/product/banner-ads.png" alt="Ecom"></a></div>
    </div>
    <section class="section-box mt-90 mb-50">
        <div class="container">
            <ul class="list-col-5">
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="assets/imgs/template/delivery.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Free Delivery</h5>
                            <p class="font-sm color-gray-500">From all orders over $10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="assets/imgs/template/support.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Support 24/7</h5>
                            <p class="font-sm color-gray-500">Shop with an expert</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="assets/imgs/template/voucher.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Gift voucher</h5>
                            <p class="font-sm color-gray-500">Refer a friend</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="assets/imgs/template/return.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Return &amp; Refund</h5>
                            <p class="font-sm color-gray-500">Free return over $200</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="assets/imgs/template/secure.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Secure payment</h5>
                            <p class="font-sm color-gray-500">100% Protected</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="section-box box-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <h3 class="color-white">Subscrible &amp; Get <span class="color-warning">10%</span> Discount</h3>
                    <p class="font-lg color-white">Get E-mail updates about our latest shop and <span class="font-lg-bold">special offers.</span></p>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12">
                    <div class="box-form-newsletter mt-15">
                        <form class="form-newsletter">
                            <input class="input-newsletter font-xs" value="" placeholder="Your email Address">
                            <button class="btn btn-brand-2">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="liveToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body fw-semibold" id="toast-message"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>