<?php
if(!defined('_HIENU')){
    die('Truy cập không hợp lệ');
}

function get_url_post($idPost){
    $link = '/post-detail?id='.$idPost;
    return $link;
}

function get_url_category($idCategory){
    $link = '/category-detail?id='.$idCategory;
    return $link;
}

function get_url_product($idProduct){
    $link = '/product-detail?id='.$idProduct;
    return $link;
}