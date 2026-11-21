
<?php

/**
 * @var array $product
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $review
 * @var array $priceRanges
 */
?>
<main class="main">
    <div class="section-box">
        <div class="breadcrumbs-div">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a class="font-xs color-gray-1000" href="/">Home</a></li>
                    <li><a class="font-xs color-gray-500" href="">Category</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section-box shop-template mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-first order-lg-last">
                    <div class="banner-ads-top mb-30"><a href="shop-single-product-3.html"><img src="\public\assets\imgs\template\banner.png" alt="Ecom"></a></div>
                    <div class="box-filters mt-0 pb-5 border-bottom">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 mb-10 text-lg-start text-center"><a class="btn btn-filter font-sm color-brand-3 font-medium" href="#ModalFiltersForm" data-bs-toggle="modal">All Fillters</a></div>
                            <div class="col-xl-10 col-lg-9 mb-10 text-lg-end text-center"><span class="font-sm color-gray-900 font-medium border-1-right span">Showing 1&ndash;16 of 17 results</span>
                                <div class="d-inline-block"><span class="font-sm color-gray-500 font-medium">Sort by:</span>
                                    <div class="dropdown dropdown-sort border-1-right">
                                        <button class="btn dropdown-toggle font-sm color-gray-900 font-medium" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false">Latest products</button>
                                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort" style="margin: 0px;">
                                            <li><a class="dropdown-item active" data-sort="latest" href="#">Latest products</a></li>
                                            <li><a class="dropdown-item" data-sort="oldest" href="#">Oldest products</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-inline-block"><span class="font-sm color-gray-500 font-medium">Show</span>
                                    <div class="dropdown dropdown-sort border-1-right">
                                        <button class="btn dropdown-toggle font-sm color-gray-900 font-medium" id="dropdownSort2" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>30 items</span></button>
                                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                                            <li><a class="dropdown-item active" data-limit="10" href="#">10 items</a></li>
                                            <li><a class="dropdown-item" data-limit="20" href="#">20 items</a></li>
                                            <li><a class="dropdown-item" data-limit="30" href="#">30 items</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-inline-block"><a class="view-type-grid mr-5 active" href="shop-grid.html"></a><a class="view-type-list" href="shop-list.html"></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-20" id="product-grid">
                        <?php if(!empty($listProducts)) foreach ($listProducts as $item): ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card-grid-style-3">
                                    <div class="card-grid-inner">
                                        <div class="tools"><a class="btn btn-trend btn-tooltip mb-10" href="#" aria-label="Trend" data-bs-placement="left"></a><a class="btn btn-wishlist btn-tooltip mb-10" href="<?php echo _HOST_URL; ?>/shop-wishlist" aria-label="Add To Wishlist"></a><a class="btn btn-compare btn-tooltip mb-10" href="shop-compare.html" aria-label="Compare"></a><a class="btn btn-quickview btn-tooltip" aria-label="Quick view" href="#ModalQuickview" data-bs-toggle="modal"></a></div>
                                        <div class="image-box"><span class="label bg-brand-2">-17%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a></div>
                                        <div class="info-right"><a class="font-xs color-gray-500" href="<?php echo get_url_product($item['id']); ?>">Apple</a><br><a class="color-brand-3 font-sm-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                <?php endfor; ?>
                                            <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 price-line">$<?php echo $item['price']; ?></span></div>
                                            <div class="mt-20 box-btn-cart"><a class="btn btn-cart" href="<?php echo _HOST_URL;?>/shop-cart" data-id="<?php echo $item['id']; ?>">Add To Cart</a></div>
                                            <ul class="list-features">
                                                <li><?php echo $item['content']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link page-prev" href="#"></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link active" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link page-next" href="#"></a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 order-last order-lg-first">
                    <div class="sidebar-border mb-0">
                        <div class="sidebar-head">
                            <h6 class="color-gray-900">Product Categories</h6>
                        </div>
                        <div class="sidebar-content">
                            <ul class="list-nav-arrow">
                                <?php foreach ($getCategory as $cat): ?>
                                <li><a href="<?php echo _HOST_URL;?>/category-products?id=<?php echo $cat['id']; ?>"><?php echo $cat['title'];?><span class="number"><?php $count = 0; foreach ($getAllProducts as $p) { if ($p['category_id'] == $cat['id']) $count++;} echo $count; ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <!-- <div>
                                <div class="collapse" id="moreMenu">
                                    <ul class="list-nav-arrow">
                                        <li><a href="shop-grid.html">Home theater<span class="number">98</span></a></li>
                                        <li><a href="shop-grid.html">Cameras & drones<span class="number">124</span></a></li>
                                        <li><a href="shop-grid.html">PC gaming<span class="number">56</span></a></li>
                                        <li><a href="shop-grid.html">Smart home<span class="number">87</span></a></li>
                                        <li><a href="shop-grid.html">Networking<span class="number">36</span></a></li>
                                    </ul>
                                </div><a class="link-see-more mt-5" data-bs-toggle="collapse" href="#moreMenu" role="button" aria-expanded="false" aria-controls="moreMenu">See More</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="sidebar-border mb-40">
                        <div class="sidebar-head">
                            <h6 class="color-gray-900">Products Filter</h6>
                        </div>
                        <div class="sidebar-content">
                            <h6 class="color-gray-900 mt-10 mb-10">Price</h6>
                            <div class="box-slider-range mt-20 mb-15">
                                <div class="row mb-20">
                                    <div class="col-sm-12">
                                        <div id="slider-range"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="lb-slider font-sm color-gray-500">Price Range:</label><span class="min-value-money font-sm color-gray-1000"></span>
                                        <label class="lb-slider font-sm font-medium color-gray-1000"></label>-
                                        <span class="max-value-money font-sm font-medium color-gray-1000"></span>
                                    </div>
                                    <div class="col-lg-12">
                                        <input class="form-control min-value" type="hidden" name="min-value" value="">
                                        <input class="form-control max-value" type="hidden" name="max-value" value="">
                                    </div>
                                </div>
                            </div>
                            <ul class="list-checkbox" id="price-checkbox">
                                <?php foreach ($priceRanges as $range): ?>
                                    <li>
                                        <label class="cb-container">
                                            <input type="checkbox" 
                                                data-min="<?php echo $range['min']; ?>" 
                                                data-max="<?php echo $range['max']; ?>">
                                            <span class="text-small"><?php echo $range['label']; ?></span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <span class="number-item"><?php echo $range['count']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <h6 class="color-gray-900 mt-20 mb-10">Brands</h6>
                            <ul class="list-checkbox">
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox" checked="checked"><span class="text-small">Apple</span><span class="checkmark"></span>
                                    </label><span class="number-item">12</span>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Sony</span><span class="checkmark"></span>
                                    </label><span class="number-item">34</span>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Toshiba</span><span class="checkmark"></span>
                                    </label><span class="number-item">56</span>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Assus</span><span class="checkmark"></span>
                                    </label><span class="number-item">78</span>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Samsung</span><span class="checkmark"></span>
                                    </label><span class="number-item">23</span>
                                </li>
                            </ul>
                            <h6 class="color-gray-900 mt-20 mb-10">Color</h6>
                            <ul class="list-color">
                                <li><a class="color-red active" href="#"></a><span>Red</span></li>
                                <li><a class="color-green" href="#"></a><span>Green</span></li>
                                <li><a class="color-blue" href="#"></a><span>Blue</span></li>
                                <li><a class="color-purple" href="#"></a><span>Purple</span></li>
                                <li><a class="color-black" href="#"></a><span>Black</span></li>
                                <li><a class="color-gray" href="#"></a><span>Gray</span></li>
                                <li><a class="color-pink" href="#"></a><span>Pink</span></li>
                                <li><a class="color-brown" href="#"></a><span>Brown</span></li>
                                <li><a class="color-yellow" href="#"></a><span>Yellow</span></li>
                            </ul><a class="btn btn-filter font-sm color-brand-3 font-medium mt-10" href="#ModalFiltersForm" data-bs-toggle="modal">More Fillters</a>
                        </div>
                    </div>
                    <div class="box-slider-item mb-30">
                        <div class="head pb-15 border-brand-2">
                            <h5 class="color-gray-900">Best seller</h5>
                        </div>
                        <div class="content-slider">
                            <div class="box-swiper slide-shop">
                                <div class="swiper-container swiper-best-seller">
                                    <div class="swiper-wrapper pt-5">
                                        <div class="swiper-slide">
                                            <?php foreach($getAllProducts as $key => $item) :?>
                                                <?php if($key <5) :?>
                                                    <div class="card-grid-style-2 card-grid-none-border border-bottom mb-10">
                                                        <div class="image-box"><span class="label bg-brand-2">-17%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a>
                                                        </div>
                                                        <div class="info-right"><a class="color-brand-3 font-xs-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info"><strong class="font-md-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 font-sm price-line">$<?php echo $item['price']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="swiper-slide">
                                            <?php foreach($getAllProducts as $key => $item) :?>
                                                <?php if($key >5 && $key <10) :?>
                                                    <div class="card-grid-style-2 card-grid-none-border border-bottom mb-10">
                                                        <div class="image-box"><span class="label bg-brand-2">-17%</span><a href="<?php echo get_url_product($item['id']); ?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a>
                                                        </div>
                                                        <div class="info-right"><a class="color-brand-3 font-xs-bold" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                                <?php endfor; ?>
                                                            <div class="price-info"><strong class="font-md-bold color-brand-3 price-main">$<?php echo $item['discount_price']; ?></strong><span class="color-gray-500 font-sm price-line">$<?php echo $item['price']; ?></span>
                                                            </div>
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
                    <div class="box-slider-item">
                        <div class="head pb-15 border-brand-2">
                            <h5 class="color-gray-900">Product Tags</h5>
                        </div>
                        <div class="content-slider mb-50"><a class="btn btn-border mr-5" href="shop-grid.html">Games</a><a class="btn btn-border mr-5" href="shop-grid.html">Electronics</a><a class="btn btn-border mr-5" href="shop-grid.html">Video</a><a class="btn btn-border mr-5" href="shop-grid.html">Cellphone</a><a class="btn btn-border mr-5" href="shop-grid.html">Indoor</a><a class="btn btn-border mr-5" href="shop-grid.html">VGA Card</a><a class="btn btn-border mr-5" href="shop-grid.html">USB</a><a class="btn btn-border mr-5" href="shop-grid.html">Lightning</a><a class="btn btn-border mr-5" href="shop-grid.html">Camera</a><a class="btn btn-border" href="shop-grid.html">Window</a><a class="btn btn-border mr-5" href="shop-grid.html">Air Vent</a><a class="btn btn-border mr-5" href="shop-grid.html">Bedroom</a><a class="btn btn-border mr-5" href="shop-grid.html">Laptop</a><a class="btn btn-border mr-5" href="shop-grid.html">Dashboard</a><a class="btn btn-border mr-5" href="shop-grid.html">Keyboard</a></div>
                    </div>
                    <div class="banner-right h-500 text-center mb-30"><span class="text-no font-11">No.9</span>
                        <h5 class="font-23 mt-20">Sensitive Touch<br class="d-none d-lg-block">without fingerprint</h5>
                        <p class="text-desc font-16 mt-15">Smooth handle and accurate click</p><a href="shop-single-product-2.html">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <div class="modal fade" id="ModalFiltersForm" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content apply-job-form">
                <div class="modal-header">
                    <h5 class="modal-title color-gray-1000 filters-icon">Addvance Fillters</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-30">
                    <div class="row">
                        <div class="col-w-1">
                            <h6 class="color-gray-900 mb-0">Brands</h6>
                            <ul class="list-checkbox">
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox" checked="checked"><span class="text-small">Apple</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Samsung</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Baseus</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Remax</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Handtown</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Elecom</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Razer</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Auto Focus</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Nillkin</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Logitech</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">ChromeBook</span><span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="col-w-1">
                            <h6 class="color-gray-900 mb-0">Special offers</h6>
                            <ul class="list-checkbox">
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">On sale</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox" checked="checked"><span class="text-small">FREE shipping</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Big deals</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Shop Mall</span><span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <h6 class="color-gray-900 mb-0 mt-40">Ready to ship in</h6>
                            <ul class="list-checkbox">
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">1 business day</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox" checked="checked"><span class="text-small">1&ndash;3 business days</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">in 1 week</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Shipping now</span><span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="col-w-1">
                            <h6 class="color-gray-900 mb-0">Ordering options</h6>
                            <ul class="list-checkbox">
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Accepts gift cards</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Customizable</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox" checked="checked"><span class="text-small">Can be gift-wrapped</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Installment 0%</span><span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <h6 class="color-gray-900 mb-0 mt-40">Rating</h6>
                            <ul class="list-checkbox">
                                <li class="mb-5"><a href="#"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(5 stars)</span></a></li>
                                <li class="mb-5"><a href="#"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(4 stars)</span></a></li>
                                <li class="mb-5"><a href="#"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(3 stars)</span></a></li>
                                <li class="mb-5"><a href="#"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(2 stars)</span></a></li>
                                <li class="mb-5"><a href="#"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><img src="assets/imgs/template/icons/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(1 star)</span></a></li>
                            </ul>
                        </div>
                        <div class="col-w-2">
                            <h6 class="color-gray-900 mb-0">Material</h6>
                            <ul class="list-checkbox">
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Nylon (8)</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Tempered Glass (5)</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox" checked="checked"><span class="text-small">Liquid Silicone Rubber (5)</span><span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"><span class="text-small">Aluminium Alloy (3)</span><span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <h6 class="color-gray-900 mb-20 mt-40">Product tags</h6>
                            <div><a class="btn btn-border mr-5" href="#">Games</a><a class="btn btn-border mr-5" href="#">Electronics</a><a class="btn btn-border mr-5" href="#">Video</a><a class="btn btn-border mr-5" href="#">Cellphone</a><a class="btn btn-border mr-5" href="#">Indoor</a><a class="btn btn-border mr-5" href="#">VGA Card</a><a class="btn btn-border mr-5" href="#">USB</a><a class="btn btn-border mr-5" href="#">Lightning</a><a class="btn btn-border mr-5" href="#">Camera</a></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start pl-30"><a class="btn btn-buy w-auto" href="#">Apply Fillter</a><a class="btn font-sm-bold color-gray-500" href="#">Reset Fillter</a></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalQuickview" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content apply-job-form">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-30">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="gallery-image">
                                <div class="galleries-2">
                                    <div class="detail-gallery">
                                        <div class="product-image-slider-2">
                                            <figure class="border-radius-10"><img src="assets/imgs/page/product/img-gallery-1.jpg" alt="product image"></figure>
                                            <figure class="border-radius-10"><img src="assets/imgs/page/product/img-gallery-2.jpg" alt="product image"></figure>
                                            <figure class="border-radius-10"><img src="assets/imgs/page/product/img-gallery-3.jpg" alt="product image"></figure>
                                            <figure class="border-radius-10"><img src="assets/imgs/page/product/img-gallery-4.jpg" alt="product image"></figure>
                                            <figure class="border-radius-10"><img src="assets/imgs/page/product/img-gallery-5.jpg" alt="product image"></figure>
                                            <figure class="border-radius-10"><img src="assets/imgs/page/product/img-gallery-6.jpg" alt="product image"></figure>
                                            <figure class="border-radius-10"><img src="assets/imgs/page/product/img-gallery-7.jpg" alt="product image"></figure>
                                        </div>
                                    </div>
                                    <div class="slider-nav-thumbnails-2">
                                        <div>
                                            <div class="item-thumb"><img src="assets/imgs/page/product/img-gallery-1.jpg" alt="product image"></div>
                                        </div>
                                        <div>
                                            <div class="item-thumb"><img src="assets/imgs/page/product/img-gallery-2.jpg" alt="product image"></div>
                                        </div>
                                        <div>
                                            <div class="item-thumb"><img src="assets/imgs/page/product/img-gallery-3.jpg" alt="product image"></div>
                                        </div>
                                        <div>
                                            <div class="item-thumb"><img src="assets/imgs/page/product/img-gallery-4.jpg" alt="product image"></div>
                                        </div>
                                        <div>
                                            <div class="item-thumb"><img src="assets/imgs/page/product/img-gallery-5.jpg" alt="product image"></div>
                                        </div>
                                        <div>
                                            <div class="item-thumb"><img src="assets/imgs/page/product/img-gallery-6.jpg" alt="product image"></div>
                                        </div>
                                        <div>
                                            <div class="item-thumb"><img src="assets/imgs/page/product/img-gallery-7.jpg" alt="product image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tags">
                                <div class="d-inline-block mr-25"><span class="font-sm font-medium color-gray-900">Category:</span><a class="link" href="#">Smartphones</a></div>
                                <div class="d-inline-block"><span class="font-sm font-medium color-gray-900">Tags:</span><a class="link" href="#">Blue</a>,<a class="link" href="#">Smartphone</a></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-info">
                                <h5 class="mb-15">SAMSUNG Galaxy S22 Ultra, 8K Camera & Video, Brightest Display Screen, S Pen Pro</h5>
                                <div class="info-by"><span class="bytext color-gray-500 font-xs font-medium">by</span><a class="byAUthor color-gray-900 font-xs font-medium" href="shop-vendor-list.html"> Ecom Tech</a>
                                    <div class="rating d-inline-block"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><img src="assets/imgs/template/icons/star.svg" alt="Ecom"><span class="font-xs color-gray-500 font-medium"> (65 reviews)</span></div>
                                </div>
                                <div class="border-bottom pt-10 mb-20"></div>
                                <div class="box-product-price">
                                    <h3 class="color-brand-3 price-main d-inline-block mr-10">$2856.3</h3><span class="color-gray-500 price-line font-xl line-througt">$3225.6</span>
                                </div>
                                <div class="product-description mt-10 color-gray-900">
                                    <ul class="list-dot">
                                        <li>8k super steady video</li>
                                        <li>Nightography plus portait mode</li>
                                        <li>50mp photo resolution plus bright display</li>
                                        <li>Adaptive color contrast</li>
                                        <li>premium design & craftmanship</li>
                                        <li>Long lasting battery plus fast charging</li>
                                    </ul>
                                </div>
                                <div class="box-product-color mt-10">
                                    <p class="font-sm color-gray-900">Color:<span class="color-brand-2 nameColor">Pink Gold</span></p>
                                    <ul class="list-colors">
                                        <li class="disabled"><img src="assets/imgs/page/product/img-gallery-1.jpg" alt="Ecom" title="Pink"></li>
                                        <li><img src="assets/imgs/page/product/img-gallery-2.jpg" alt="Ecom" title="Gold"></li>
                                        <li><img src="assets/imgs/page/product/img-gallery-3.jpg" alt="Ecom" title="Pink Gold"></li>
                                        <li><img src="assets/imgs/page/product/img-gallery-4.jpg" alt="Ecom" title="Silver"></li>
                                        <li class="active"><img src="assets/imgs/page/product/img-gallery-5.jpg" alt="Ecom" title="Pink Gold"></li>
                                        <li class="disabled"><img src="assets/imgs/page/product/img-gallery-6.jpg" alt="Ecom" title="Black"></li>
                                        <li class="disabled"><img src="assets/imgs/page/product/img-gallery-7.jpg" alt="Ecom" title="Red"></li>
                                    </ul>
                                </div>
                                <div class="box-product-style-size mt-10">
                                    <div class="row">
                                        <div class="col-lg-12 mb-10">
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
                                                <li title="128 GB">128 GB</li>
                                                <li class="disabled" title="64GB">64GB</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="buy-product mt-5">
                                    <p class="font-sm mb-10">Quantity</p>
                                    <div class="box-quantity">
                                        <div class="input-quantity">
                                            <input class="font-xl color-brand-3" type="text" value="1"><span class="minus-cart"></span><span class="plus-cart"></span>
                                        </div>
                                        <div class="button-buy"><a class="btn btn-cart" href="shop-cart.html">Add to cart</a><a class="btn btn-buy" href="shop-checkout.html">Buy now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>