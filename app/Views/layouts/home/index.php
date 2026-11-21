<?php

/**
 * @var array $product
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $review
 * @var array $listProducts
 */
?>
<main class="main">
    <section class="section-box">
        <div class="banner-hero banner-8" >
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-4 mb-30">
                        <div class="sidebar-border mb-0">
                            <div class="sidebar-border mb-0" style="position: relative;">
                                <div class="sidebar-head">
                                    <h6 class="color-gray-900">Product Categories</h6>
                                </div>
                                <div class="sidebar-content">
                                    <ul class="list-nav-arrow">
                                        <?php foreach ($getCategory as $cat): ?>
                                        <li><a href="<?php echo _HOST_URL;?>/category-products?id=<?php echo $cat['id']; ?>" data-id="<?php echo $cat['id']; ?>" data-slug="<?php echo $cat['slug']; ?>"><?php echo $cat['title'];?><span class="number"><?php $count = 0; foreach ($getAllProducts as $p) { if ($p['category_id'] == $cat['id']) $count++;} echo $count; ?></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                    <div id="category-dropdown"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-8 mb-30">
                        <div class="box-swiper">
                            <div class="row" id="products-container">
                                <?php foreach ($listProducts as $key => $item): ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12 product-tab" data-tab="all">
                                        <div class="card-grid-style-2" data-category="<?php echo $item['category_id']; ?>">
                                            <label class="label font-xs color-gray-500 bg-success">New</label>
                                            <div class="image-box"><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a></div>
                                            <div class="info-right"><span class="font-xs color-gray-500">Steven Job</span><br><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                    <?php endfor; ?>
                                                <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-20">
                    <div class="block-sale-2 circle-1">
                        <div class="row height-100">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale"><span class="font-sm color-brand-3">Latest Books</span>
                                    <h4 class="mt-5 mb-10">Exclusive Offers</h4>
                                    <p class="color-brand-3 font-sm mb-5">Let’s change thinks<br>with inspire books</p><a class="btn btn-arrow" href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-12 height-100 align-items-end d-flex"><img src="assets/imgs/page/homepage8/sale1.png" alt="Ecom"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-20">
                    <div class="block-sale-2 bg-4 circle-2">
                        <div class="row height-100">
                            <div class="col-lg-6 col-md-7 col-sm-7 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale"><span class="font-sm color-brand-3">Best collection</span>
                                    <h4 class="mt-5 mb-10">Get up to 20% discount</h4>
                                    <p class="color-brand-3 font-sm mb-5">Only this week</p><a class="btn btn-arrow" href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5 col-sm-5 col-12 height-100 align-items-end d-flex"><img src="assets/imgs/page/homepage8/sale2.png" alt="Ecom"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-20">
                    <div class="block-sale-2 bg-10 circle-3">
                        <div class="row height-100">
                            <div class="col-lg-6 col-md-7 col-sm-7 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale"><span class="font-sm color-brand-3">Off the month</span>
                                    <h4 class="mt-5 mb-10">Professional Books</h4>
                                    <p class="color-brand-3 font-sm mb-5">Flat 50% discount</p><a class="btn btn-arrow" href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5 col-sm-5 col-12 height-100 align-items-end d-flex"><img src="assets/imgs/page/homepage8/sale3.png" alt="Ecom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box pt-30">
        <div class="container">
            <div class="head-main bd-gray-200">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mb-5">Latest Deals</h3>
                        <p class="font-base color-gray-500">Special products in this month.</p>
                    </div>
                    <div class="col-lg-6 text-end">
                        <div class="box-all-hurry">
                            <div class="d-inline-block box-text-hurryup"><span class="font-md-bold color-gray-900">Hurry up!</span><br><span class="font-xs color-gray-500">Offers end in:</span></div>
                            <div class="box-count box-count-square hide-period">
                                <div class="deals-countdown" data-countdown="2023/08/25 00:00:00"></div>
                            </div><a class="btn btn-view-all font-md-bold" href="shop-single-product.html">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="list-products-5 list-brand-2">
                        <?php foreach($getAllProducts as $key => $item): ?>
                            <?php if($key < 10): ?>
                                <div class="card-grid-style-3 card-style-full-image">
                                    <div class="card-grid-inner">
                                        <div class="tools"><a class="btn btn-trend btn-tooltip mb-10" href="#" aria-label="Trend"></a><a class="btn btn-wishlist btn-tooltip mb-10" href="<?php echo _HOST_URL; ?>/shop-wishlist" aria-label="Add To Wishlist"></a><a class="btn btn-compare btn-tooltip mb-10" href="shop-compare.html" aria-label="Compare"></a><a class="btn btn-quickview btn-tooltip" aria-label="Quick view" href="#ModalQuickview" data-bs-toggle="modal"></a></div>
                                        <div class="image-box"><span class="label bg-brand-2">-<?php echo discountPercent($item['price'], $item['discount_price']); ?>%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a>
                                        </div>
                                        <div class="info-right">
                                            <div class="row">
                                                <div class="col-6 text-end">
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                        <?php endfor; ?>
                                                </div>
                                            </div><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                            <div class="price-info"><strong class="font-lg-bold color-brand-2 price-main">$<?php echo $item['discount_price'] ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price'] ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="section-box mt-30 mb-50">
        <div class="container">
            <div class="box-ads-2 box-ads-3"> <img src="assets/imgs/page/homepage8/ads1.png" alt="Ecom">
                <div class="ads-info">
                    <h6 class="color-white mb-5">Best Book Colletion</h6>
                    <h3 class="color-white mb-15">Let’s Change Things Inspire Book</h3><a class="btn btn-brand-2 btn-arrow-right">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
    <section class="section-box pt-50 pb-50 bg-27">
        <div class="container">
            <div class="head-main bd-gray-200 border-none">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h3 class="mb-5">Picked By Ecom</h3>
                        <p class="font-base color-gray-500">Special products in this month.</p>
                    </div>
                </div>
            </div>
            <div class="mt-0">
                <div class="pick-by-ecom">
                    <div class="box-swiper">
                        <div class="swiper-container swiper-group-2-style-2 pb-15">
                            <div class="swiper-wrapper pt-5">
                                <?php foreach ($getAllProducts as $key => $item): ?>
                                    <?php if ($key > 12 && $key < 17): ?>
                                        <div class="swiper-slide">
                                            <div class="card-grid-style-3 hover-show top-deals">
                                                <div class="card-grid-inner"><span class="label"><span class="font-sm color-white">Top<br>Deals</span></span>
                                                    <div class="box-top-deals">
                                                        <div class="top-deals-left">
                                                            <div class="image-box">
                                                                <div class="box-swiper">
                                                                    <div class="swiper-container swiper-tab" data-index="1">
                                                                        <div class="swiper-wrapper pt-5">
                                                                            <div class="swiper-slide"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></div>
                                                                            <div class="swiper-slide"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></div>
                                                                            <div class="swiper-slide"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></div>
                                                                        </div>
                                                                        <div class="swiper-pagination swiper-pagination-2"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-count box-count-square">
                                                                <div class="deals-countdown" data-countdown="2023/09/25 00:00:00"></div>
                                                            </div>
                                                        </div>
                                                        <div class="top-deals-right">
                                                            <div class="info-right"></div><span class="font-xs color-gray-500">Apple</span><br><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>">
                                                                <h5><?php echo $item['name']; ?></h5>
                                                            </a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info">
                                                                <h3 class="color-brand-3 price-main d-inline-block">$<?php echo $item['discount_price']; ?></h3><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span>
                                                            </div>
                                                            <div class="box-progress">
                                                                <div class="progress-bar">
                                                                    <div class="progress-bar-inner"></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6"><span class="font-xs color-gray-500">Available: </span><span class="font-xs-bold color-gray-900"><?php echo $item['available']; ?></span></div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end"><span class="font-xs color-gray-500">Sold: </span><span class="font-xs-bold color-gray-900"><?php echo $item['sold']; ?></span></div>
                                                                </div>
                                                            </div>
                                                            <ul class="list-features">
                                                                <li><?php echo $item['content']; ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-pagination swiper-pagination-3"></div>
                        </div>
                        <div class="swiper-button-next swiper-button-next-ecom"></div>
                        <div class="swiper-button-prev swiper-button-prev-ecom"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="head-main">
                        <h3 class="mb-5">Top Selling Books</h3>
                        <p class="font-base color-gray-500">Special products in this month.</p>
                        <div class="box-button-slider">
                            <div class="swiper-button-next swiper-button-next-group-1"></div>
                            <div class="swiper-button-prev swiper-button-prev-group-1"></div>
                        </div>
                    </div>
                    <div class="box-swiper">
                        <div class="swiper-container swiper-group-1 style-label-right">
                            <div class="swiper-wrapper pt-5">
                                <div class="swiper-slide">
                                    <div class="row">
                                        <?php foreach ($getAllProducts as $key => $item): ?>
                                            <?php if ($key > 13): ?>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="card-grid-style-2">
                                                        <label class="label font-xs color-gray-500 bg-success">New</label>
                                                        <div class="image-box"><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a></div>
                                                        <div class="info-right"><span class="font-xs color-gray-500">Steven Job</span><br><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-20">
                    <div class="block-sale-3">
                        <div class="row height-100">
                            <div class="col-lg-5 col-md-6 col-sm-6 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale"><span class="font-sm color-brand-3">Latest Books</span>
                                    <h4 class="mt-5 mb-5">Exclusive Offers</h4>
                                    <p class="color-brand-3 font-sm mb-5">Nullam diam tellus, convallis vel rhoncus vel, condimentum</p><a class="btn btn-arrow" href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-sm-6 col-12 height-100 align-items-end d-flex"><img src="assets/imgs/page/homepage8/book-ads1.png" alt="Ecom"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-20">
                    <div class="block-sale-3 bg-29">
                        <div class="row height-100">
                            <div class="col-lg-5 col-md-6 col-sm-6 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale"><span class="font-sm color-brand-3">For Collection</span>
                                    <h4 class="mt-5 mb-10">History Books</h4>
                                    <p class="color-brand-3 font-sm mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean maximus laoreet</p><a class="btn btn-arrow" href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-sm-6 col-12 height-100 align-items-end d-flex"><img src="assets/imgs/page/homepage8/book-ads2.png" alt="Ecom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-style-2 card-grid-style-2-small">
                        <div class="image-box"><a href="shop-fullwidth.html"><img src="assets/imgs/page/homepage8/img1.png" alt="Ecom"></a>
                            <div class="mt-10 text-center"><a class="btn btn-gray" href="shop-fullwidth.html">View all</a></div>
                        </div>
                        <div class="info-right"><a class="color-brand-3 font-sm-bold" href="shop-fullwidth.html">
                                <h6>Business & Money</h6>
                            </a>
                            <ul class="list-links-disc">
                                <li><a class="font-sm" href="shop-fullwidth.html">Accounting</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Biography & History</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Business Culture</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Economics</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-style-2 card-grid-style-2-small">
                        <div class="image-box"><a href="shop-fullwidth.html"><img src="assets/imgs/page/homepage8/img2.png" alt="Ecom"></a>
                            <div class="mt-10 text-center"><a class="btn btn-gray" href="shop-fullwidth.html">View all</a></div>
                        </div>
                        <div class="info-right"><a class="color-brand-3 font-sm-bold" href="shop-fullwidth.html">
                                <h6>Biographies</h6>
                            </a>
                            <ul class="list-links-disc">
                                <li><a class="font-sm" href="shop-fullwidth.html">HD DVD Players</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Projection Screens</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Television Accessories</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">TV-DVD Combos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-style-2 card-grid-style-2-small">
                        <div class="image-box"><a href="shop-fullwidth.html"><img src="assets/imgs/page/homepage8/img3.png" alt="Ecom"></a>
                            <div class="mt-10 text-center"><a class="btn btn-gray" href="shop-fullwidth.html">View all</a></div>
                        </div>
                        <div class="info-right"><a class="color-brand-3 font-sm-bold" href="shop-fullwidth.html">
                                <h6>Children's Books</h6>
                            </a>
                            <ul class="list-links-disc">
                                <li><a class="font-sm" href="shop-fullwidth.html">Action & Adventure</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Activities, Crafts</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Arts, Music</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Early Learning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-style-2 card-grid-style-2-small">
                        <div class="image-box"><a href="shop-fullwidth.html"><img src="assets/imgs/page/homepage8/img4.png" alt="Ecom"></a>
                            <div class="mt-10 text-center"><a class="btn btn-gray" href="shop-fullwidth.html">View all</a></div>
                        </div>
                        <div class="info-right"><a class="color-brand-3 font-sm-bold" href="shop-fullwidth.html">
                                <h6>Education & Teaching</h6>
                            </a>
                            <ul class="list-links-disc">
                                <li><a class="font-sm" href="shop-fullwidth.html">Higher & Continuing</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Schools & Teaching</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Study Guides</a></li>
                                <li><a class="font-sm" href="shop-fullwidth.html">Test Preparation </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="box-slider-item">
                        <div class="head">
                            <h5>Best seller</h5>
                        </div>
                        <div class="content-slider">
                            <div class="box-swiper">
                                <div class="swiper-container swiper-best-seller">
                                    <div class="swiper-wrapper pt-5">
                                        <div class="swiper-slide">
                                            <?php foreach ($getAllProducts as $key => $item): ?>
                                                <?php if ($key > 1 && $key < 6): ?>
                                                    <div class="card-grid-style-2 card-grid-none-border hover-up">
                                                        <div class="image-box"><span class="label bg-brand-2">-<?php echo discountPercent($item['price'], $item['discount_price']); ?>%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a>
                                                        </div>
                                                        <div class="info-right"><span class="font-xs color-gray-500">Steven Job</span><br><a class="color-brand-3 font-xs-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next swiper-button-next-style-2 swiper-button-next-bestseller"></div>
                                <div class="swiper-button-prev swiper-button-prev-style-2 swiper-button-prev-bestseller"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="box-slider-item">
                        <div class="head">
                            <h5>Featured products</h5>
                        </div>
                        <div class="content-slider">
                            <div class="box-swiper">
                                <div class="swiper-container swiper-featured">
                                    <div class="swiper-wrapper pt-5">
                                        <div class="swiper-slide">
                                            <?php foreach ($getAllProducts as $key => $item): ?>
                                                <?php if ($key > 6 && $key < 11): ?>
                                                    <div class="card-grid-style-2 card-grid-none-border hover-up">
                                                        <div class="image-box"><span class="label bg-brand-2">-<?php echo discountPercent($item['price'], $item['discount_price']); ?>%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a>
                                                        </div>
                                                        <div class="info-right"><span class="font-xs color-gray-500">Steven Job</span><br><a class="color-brand-3 font-xs-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next swiper-button-next-style-2 swiper-button-next-featured"></div>
                                <div class="swiper-button-prev swiper-button-prev-style-2 swiper-button-prev-featured"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="box-slider-item">
                        <div class="head">
                            <h5>Most viewed</h5>
                        </div>
                        <div class="content-slider">
                            <div class="box-swiper">
                                <div class="swiper-container swiper-mostviewed">
                                    <div class="swiper-wrapper pt-5">
                                        <div class="swiper-slide">
                                            <?php foreach ($getAllProducts as $key => $item): ?>
                                                <?php if ($key > 11 && $key < 16): ?>
                                                    <div class="card-grid-style-2 card-grid-none-border hover-up">
                                                        <div class="image-box"><span class="label bg-brand-2">-<?php echo discountPercent($item['price'], $item['discount_price']); ?>%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a>
                                                        </div>
                                                        <div class="info-right"><span class="font-xs color-gray-500">Steven Job</span><br><a class="color-brand-3 font-xs-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next swiper-button-next-style-2 swiper-button-next-mostviewed"></div>
                                <div class="swiper-button-prev swiper-button-prev-style-2 swiper-button-prev-mostviewed"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="box-slider-item">
                        <div class="head">
                            <h5>Trending</h5>
                        </div>
                        <div class="content-slider">
                            <div class="box-swiper">
                                <div class="swiper-container swiper-trending">
                                    <div class="swiper-wrapper pt-5">
                                        <div class="swiper-slide">
                                            <?php foreach ($getAllProducts as $key => $item): ?>
                                                <?php if ($key > 15 && $key < 20): ?>
                                                    <div class="card-grid-style-2 card-grid-none-border hover-up">
                                                        <div class="image-box"><span class="label bg-brand-2">-<?php echo discountPercent($item['price'], $item['discount_price']); ?>%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a>
                                                        </div>
                                                        <div class="info-right"><span class="font-xs color-gray-500">Steven Job</span><br><a class="color-brand-3 font-xs-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next swiper-button-next-style-2 swiper-button-next-trending"></div>
                                <div class="swiper-button-prev swiper-button-prev-style-2 swiper-button-prev-trending"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php layoutClient('post/index'); ?>
    <section class="section-box mt-90 mb-50">
        <div class="container">
            <ul class="list-col-5">
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="\public\assets\imgs\template\delivery.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Free Delivery</h5>
                            <p class="font-sm color-gray-500">From all orders over $10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="\public\assets\imgs\template\support.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Support 24/7</h5>
                            <p class="font-sm color-gray-500">Shop with an expert</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="\public\assets\imgs\template\voucher.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Gift voucher</h5>
                            <p class="font-sm color-gray-500">Refer a friend</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="\public\assets\imgs\template\return.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Return &amp; Refund</h5>
                            <p class="font-sm color-gray-500">Free return over $200</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-list">
                        <div class="icon-left"><img src="\public\assets\imgs\template\secure.svg" alt="Ecom"></div>
                        <div class="info-right">
                            <h5 class="font-lg-bold color-gray-100">Secure payment</h5>
                            <p class="font-sm color-gray-500">100% Protected</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="section-box box-newsletter bg-27 bg-newsletter-home8">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="color-gray-1000 mb-5">Subscrible &amp; Get<span class="color-brand-2">10%</span> Discount</h3>
                    <p class="font-lg color-gray-1000 mb-10">Get E-mail updates about our latest shop and<span class="font-lg-bold">special offers.</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="box-form-newsletter mw-newsletter mt-15 d-inline-block">
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
