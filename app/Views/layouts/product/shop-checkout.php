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
<div class="section-box">
    <div class="breadcrumbs-div">
        <div class="container">
            <ul class="breadcrumb">
                <li><a class="font-xs color-gray-1000" href="index.html">Home</a></li>
                <li><a class="font-xs color-gray-500" href="shop-grid.html">Shop</a></li>
                <li><a class="font-xs color-gray-500" href="shop-cart.html">Checkout</a></li>
            </ul>
        </div>
    </div>
</div>

<section class="section-box shop-template">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <form id="form-checkout">
                    <div class="box-border">
                        <div class="box-payment"><a class="btn btn-gpay"><img src="\public\assets\imgs\page\gpay.svg" alt="Ecom"></a><a class="btn btn-paypal"><img src="\public\assets\imgs\page\paypal.svg" alt="Ecom"></a><a class="btn btn-amazon"><img src="\public\assets\imgs\page\amazon.svg" alt="Ecom"></a></div>
                        <div class="border-bottom-4 text-center mb-20">
                            <div class="text-or font-md color-gray-500">Or</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 mb-20">
                                <h5 class="font-md-bold color-brand-3 text-sm-start text-center">Contact information</h5>
                            </div>
                            <div class="col-lg-6 col-sm-6 mb-20 text-sm-end text-center"><span class="font-sm color-brand-3">Already have an account?</span><a class="font-sm color-brand-1" href="<?php echo _HOST_URL; ?>/page-login"> Login</a></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="Email*" name="email" value="<?php echo !empty($dataUser['email']) ? $dataUser['email'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="font-sm color-brand-3" for="checkboxOffers">
                                        <input class="checkboxOffer" id="checkboxOffers" type="checkbox">Keep me up to date on news and exclusive offers
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Shipping address</h5>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="First name*" name="firstname" value="<?php echo !empty($dataUser['firstname']) ? $dataUser['firstname'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="Last name*" name="lastname" value="<?php echo !empty($dataUser['lastname']) ? $dataUser['lastname'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="Address 1*" name="address1" value="<?php echo !empty($dataUser['address1']) ? $dataUser['address1'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="Address 2*" name="address2" value="<?php echo !empty($dataUser['address2']) ? $dataUser['address2'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="form-control font-sm select-style1 color-gray-700">
                                        <option value="">Select an option...</option>
                                        <option value="1">Option 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="City*" name="city" value="<?php echo !empty($dataUser['city']) ? $dataUser['city'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="PostCode / ZIP*" name="postcode" value="<?php echo !empty($dataUser['postcode']) ? $dataUser['postcode'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="Company name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control font-sm" type="text" placeholder="Phone*" name="phone" value="<?php echo !empty($dataUser['phone']) ? $dataUser['phone'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <textarea class="form-control font-sm" placeholder="Additional Information" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row mt-20">
                    <div class="col-lg-6 col-5 mb-20"><a class="btn font-sm-bold color-brand-1 arrow-back-1" href="<?php echo _HOST_URL;?>/shop-cart">Return to Cart</a></div>
                    <div class="col-lg-6 col-7 mb-20 text-end">
                        <button type="submit" class="btn btn-buy w-auto arrow-next" >Place an Order</button></div>
                </div>
            </div>
        </form>
            <div class="col-lg-6">
                <div class="box-border">
                    <h5 class="font-md-bold mb-20">Your Order</h5>
                    <div class="listCheckout">
                        <?php foreach ($listProducts as $item): ?>
                            <div class="item-wishlist">
                                <div class="wishlist-product">
                                    <div class="product-wishlist">
                                        <div class="product-image"><a href="<?php echo get_url_product($item['id']);?>"><img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom"></a></div>
                                        <div class="product-info"><a href="<?php echo get_url_product($item['id']);?>">
                                                <h6 class="color-brand-3"><?php echo $item['name']?></h6>
                                            </a>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="fa fa-star <?php echo $i <= round($item['rating']) ? '#ffc107' : '#ccc' ?>"></span>
                                                <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="wishlist-status">
                                    <h5 class="color-gray-500">x<?php echo $item['quantity']; ?></h5>
                                </div>
                                <div class="wishlist-price">
                                    <h4 class="color-brand-3 font-lg-bold">$<?php echo $item['discount_price']; ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group d-flex mt-15">
                        <input class="form-control mr-15" placeholder="Enter Your Coupon"
                            value="<?php echo !empty($productsCart['coupons']) ? $productsCart['coupons'] : ''; ?>">
                            <button class="btn btn-buy w-auto" id="btn-apply-coupon">Apply</button>
                            <button class="btn btn-buy w-auto" id="btn-remove-coupon">Remove</button>
                    </div>
                    <div class="form-group mb-0">
                        <div class="row mb-10">
                            <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Subtotal</span></div>
                            <div class="col-lg-6 col-6 text-end"><span class="font-lg-bold color-brand-3">$<?php 
                                echo !empty($productsCart['newTotal']) 
                                    ? $productsCart['newTotal'] 
                                    : $productsCart['total'];
                            ?></span></div>
                        </div>
                        <div class="border-bottom mb-10 pb-5">
                            <div class="row">
                                <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Shipping</span></div>
                                <div class="col-lg-6 col-6 text-end"><span class="font-lg-bold color-brand-3">-</span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Total</span></div>
                            <div class="col-lg-6 col-6 text-end"><span class="font-lg-bold color-brand-3">$<?php 
                                echo !empty($productsCart['newTotal']) 
                                    ? $productsCart['newTotal'] 
                                    : $productsCart['total'];
                            ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
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

</html>
<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="liveToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body fw-semibold" id="toast-message"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>