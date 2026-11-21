<?php
/**
 * @var array $listProducts
 */
?>
<?php foreach ($listProducts as $item): ?>
    <div class="item-cart mb-20">
        <div class="cart-image">
            <img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg">
        </div>
        <div class="cart-info">
            <a class="font-sm-bold color-brand-3" href="<?php echo get_url_product($item['id']); ?>"><?php echo $item['name']; ?></a>
            <p><span class="color-brand-2 font-sm-bold">$<?php echo $item['discount_price'] ?></span></p>
        </div>
    </div>
<?php endforeach; ?>