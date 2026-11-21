<?php
if(!defined('_HIENU')){
    die('Truy cập không hợp lệ');
}


function countUserWishlist(){
    $usersModel = new Users();
    $user_id = 1;
    $total = $usersModel->getCountUserWishlist($user_id);
    return $total;
}

function countShopCart() {
    $shopCart = getSession('shopCart');
    $shopCart = !empty($shopCart) ? json_decode($shopCart, true) : null;
    return $shopCart['totalProducts'] ?? 0;
}

function getCartProducts() {
    $shopCart = getSession('shopCart');
    $shopCart = !empty($shopCart) ? json_decode($shopCart, true) : null;

    if (empty($shopCart['listProducts'])) return [];

    $productIds = implode(', ', array_column($shopCart['listProducts'], 'product_id'));
    
    $productsModel = new Product();
    $listProducts = $productsModel->getListProductsByIds($productIds);

    $quantityMap = array_column($shopCart['listProducts'], 'quantity', 'product_id');
    foreach ($listProducts as &$product) {
        $product['quantity'] = $quantityMap[$product['id']] ?? 0;
    }
    unset($product);

    return $listProducts;
}