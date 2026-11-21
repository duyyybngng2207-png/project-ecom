<?php
/**
 * @var array $listProducts
 */
?>
<?php foreach ($listProducts as $item): ?>
<div class="item-wishlist item-cart-product">
    <div class="wishlist-cb">
        <input class="cb-layout cb-select" type="checkbox" name="input-cart" value="<?php echo $item['id']; ?>">
    </div>
    <div class="wishlist-product">
        <div class="product-wishlist">
            <div class="product-image">
                <a href="<?php echo get_url_product($item['id']); ?>">
                    <img src="<?php echo _HOST_URL_PUBLIC; ?>/img/product_<?php echo $item['id']; ?>.jpg" alt="Ecom">
                </a>
            </div>
            <div class="product-info">
                <a href="<?php echo get_url_product($item['id']); ?>">
                    <h6 class="color-brand-3"><?php echo $item['name']; ?></h6>
                </a>
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
    <div class="wishlist-remove">
        <a class="btn btn-delete btn-remove-cart" href="#" data-product="<?php echo $item['id']; ?>">Delete</a>
    </div>
</div>
<?php endforeach; ?>