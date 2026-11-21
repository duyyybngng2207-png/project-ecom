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