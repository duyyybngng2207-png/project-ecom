<?php
/**
 * @var array $listProducts
 * @var array $slug
 */
?>
<?php foreach ($listProducts as $key => $item): ?>
    <div class="col-lg-4 col-md-6 col-sm-12 product-tab" data-tab="<?php echo $slug; ?>">
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