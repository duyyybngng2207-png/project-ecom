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
<main class="main" id="shop-cart">
    <div class="section-box">
        <div class="breadcrumbs-div">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a class="font-xs color-gray-1000" href="index.html">Home</a></li>
                    <li><a class="font-xs color-gray-500" href="shop-grid.html">Shop</a></li>
                    <li><a class="font-xs color-gray-500" href="shop-cart.html">Cart</a></li>
                </ul>
            </div>
        </div>
    </div>
    <section class="section-box shop-template">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="box-carts">
                        <div class="head-wishlist">
                            <div class="item-wishlist">
                                <div class="wishlist-cb">
                                    <input class="cb-layout cb-all" type="checkbox">
                                </div>
                                <div class="wishlist-product"><span class="font-md-bold color-brand-3">Product</span></div>
                                <div class="wishlist-price"><span class="font-md-bold color-brand-3">Unit Price</span></div>
                                <div class="wishlist-status"><span class="font-md-bold color-brand-3">Quantity</span></div>
                                <div class="wishlist-action"><span class="font-md-bold color-brand-3">Subtotal</span></div>
                                <div class="wishlist-remove"><span class="font-md-bold color-brand-3">Remove</span></div>
                            </div>
                        </div>
                        <div class="content-wishlist mb-20">
                            <?php if (!empty($listProducts)): ?>
                            <?php foreach ($listProducts as $item): ?>
                            <div class="item-wishlist item-cart-product">
                                <div class="wishlist-cb">
                                    <input class="cb-layout cb-select" type="checkbox" name="input-cart" value="<?php echo $item['id']; ?>">
                                </div>
                                <div class="wishlist-product">
                                    <div class="product-wishlist">
                                        <div class="product-image"><a href="<?php echo get_url_product($item['id']);?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a></div>
                                        <div class="product-info"><a href="<?php echo get_url_product($item['id']);?>">
                                                <h6 class="color-brand-3"><?php echo $item['name']; ?></h6>
                                            </a>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="wishlist-price">
                                    <h4 class="color-brand-3"><?php echo $item['discount_price']; ?></h4>
                                </div>
                                <div class="wishlist-status">
                                    <div class="box-quantity">
                                        <div class="input-quantity">
                                            <input class="font-xl color-brand-3" type="text" value="<?php echo $item['quantity']; ?>" data-product="<?php echo $item['id']; ?>">
                                            <span class="plus-cart"></span>
                                            <span class="minus-cart"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wishlist-action">
                                    <h4 class="color-brand-3"><?php echo $item['discount_price'] * $item['quantity']; ?></h4>
                                </div>
                                <div class="wishlist-remove"><a class="btn btn-delete btn-remove-cart" href="#" data-product="<?php echo $item['id']; ?>">Delete</a></div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-6 col-md-6 col-sm-6-col-6"><a class="btn btn-buy w-auto arrow-back mb-10" href="/">Continue shopping</a></div>
                            <div class="col-lg-6 col-md-6 col-sm-6-col-6 text-md-end"><a class="btn btn-buy w-auto remove-multi-cart mb-10" href="#">Delete Multi Products</a></div>
                        </div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-6">
                                <div class="box-cart-left">
                                    <h5 class="font-md-bold mb-10">Calculate Shipping</h5><span class="font-sm-bold mb-5 d-inline-block color-gray-500">Flat rate:</span><span class="font-sm-bold d-inline-block color-brand-3">5%</span>
                                    <div class="form-group">
                                        <select class="form-control select-style1 color-gray-700">
                                            <option value="1">USA</option>
                                            <option value="2">EURO</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-10">
                                            <input class="form-control" placeholder="Stage / Country">
                                        </div>
                                        <div class="col-lg-6 mb-10">
                                            <input class="form-control" placeholder="PostCode / ZIP">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="box-cart-right p-20">
                                    <h5 class="font-md-bold mb-10">Apply Coupon</h5>
                                    <span class="font-sm-bold mb-5 d-inline-block color-gray-500">Using A Promo Code?</span>
                                    <div class="form-group d-flex">
                                        <input class="form-control mr-15" id="coupon-code" placeholder="Enter Your Coupon"
                                        value="">
                                        <button class="btn btn-buy w-auto" id="btn-apply-coupon">Apply</button>
                                        <button class="btn btn-buy w-auto none" id="btn-remove-coupon">Remove</button>
                                    </div>
                                    <div id="coupon-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="summary-cart">
                        <div class="border-bottom mb-10">
                            <div class="row">
                                <div class="col-6"><span class="font-md-bold color-gray-500">Subtotal</span></div>
                                <div class="col-6 text-end">
                                    <h4 class="cart-total">
                                        $<?php echo !empty($productsCart['newTotal']) ? $productsCart['newTotal'] : $productsCart['total']; ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom mb-10">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-md-bold color-gray-500">
                                        Coupon <?php echo !empty($productsCart['coupon']) ? '(' . $productsCart['coupon'] . ')' : ''; ?>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <?php if (!empty($productsCart['coupon'])): ?>
                                        <h4 class="text-success">-$<?php echo number_format($productsCart['discount']); ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom mb-10">
                            <div class="row">
                                <div class="col-6"><span class="font-md-bold color-gray-500">Shipping</span></div>
                                <div class="col-6 text-end">
                                    <h4> Free</h4>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom mb-10">
                            <div class="row">
                                <div class="col-6"><span class="font-md-bold color-gray-500">Estimate for</span></div>
                                <div class="col-6 text-end">
                                    <h6>United Kingdom</h6>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <div class="row">
                                <div class="col-6"><span class="font-md-bold color-gray-500">Total</span></div>
                                <div class="col-6 text-end">
                                    <h4 class="cart-total">
                                        $<?php 
                                            echo !empty($productsCart['newTotal']) 
                                                ? $productsCart['newTotal'] 
                                                : $productsCart['total'];
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="box-button"><a class="btn btn-buy" href="<?php echo _HOST_URL;?>/shop-checkout">Proceed To CheckOut</a></div>
                    </div>
                </div>
            </div>
            <h4 class="color-brand-3">You may also like</h4>
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
                            <div class="mt-20 box-btn-cart"><a class="btn btn-cart btn-add-to-cart" data-id="<?php echo $item['id']; ?>" data-quantity="1" href="<?php echo _HOST_URL; ?>/shop-cart">Add To Cart</a></div>
                            <ul class="list-features">
                                <li><?php echo $item['content']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <?php endforeach;?>
            </div>
            <h4 class="color-brand-3">Recently viewed items</h4>
             <div class="row mt-40">
                <?php foreach($getAllProducts as $key=>$item):?>
                <?php if($key >5 && $key <10): ?>
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
        </div>
    </section>
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
</html>