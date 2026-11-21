<?php 
//Class router
$router->get('/dashboard', 'UsersController@dashboard');

$router->get('/users', 'UsersController@index');
$router->post('/users', 'UsersController@index');

$router->get('/admin/group', 'GroupController@index');
$router->post('/admin/group', 'GroupController@index');

$router->get('/product', 'ProductController@index');

$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');

$router->get('/register', 'AuthController@showRegister');
$router->post('/register', 'AuthController@register');

$router->get('/forgot', 'AuthController@showForgot');
$router->post('/forgot', 'AuthController@forgot');

$router->get('/active', 'AuthController@active');

$router->get('/reset', 'AuthController@Showreset');
$router->post('/reset', 'AuthController@reset');

$router->get('/logout', 'AuthController@logout');

//Admin Posts
$router->get('/admin/posts', 'PostsController@list');
$router->get('/admin/posts/list', 'PostsController@list');

$router->get('/admin/posts/add', 'PostsController@showAdd');
$router->post('/admin/posts/add', 'PostsController@add');

$router->get('/admin/posts/edit', 'PostsController@showEdit');
$router->post('/admin/posts/edit', 'PostsController@edit');

$router->get('/admin/posts/delete', 'PostsController@delete');

//Admin Products
$router->get('/admin/product', 'ProductController@product');
$router->post('/admin/product', 'ProductController@product');

$router->get('/admin/product/editProduct', 'ProductController@showEditProduct');
$router->post('/admin/product/editProduct', 'ProductController@editProduct');

$router->get('/admin/product/addProduct', 'ProductController@showAddProduct');
$router->post('/admin/product/addProduct', 'ProductController@addProduct');

$router->get('/admin/product/deleteProduct', 'ProductController@deleteProduct');

//Admin Comments
$router->get('/admin/comments', 'CommentsController@comments');
$router->post('/admin/comments', 'CommentsController@comments');

$router->get('/admin/comments/editComments', 'CommentsController@showEditComments');
$router->post('/admin/comments/editComments', 'CommentsController@editComments');

$router->get('/admin/comments/addComments', 'CommentsController@showAddComments');
$router->post('/admin/comments/addComments', 'CommentsController@addComments');

$router->get('/admin/comments/deleteComments', 'CommentsController@deleteComments');

//Admin Reviews
$router->get('/admin/reviews', 'CommentsController@reviews');
$router->post('/admin/reviews', 'CommentsController@reviews');

$router->get('/admin/reviews/editReviews', 'CommentsController@showEditReviews');
$router->post('/admin/reviews/editReviews', 'CommentsController@editReviews');

$router->get('/admin/reviews/addReviews', 'CommentsController@showAddReviews');
$router->post('/admin/reviews/addReviews', 'CommentsController@addReviews');

$router->get('/admin/reviews/deleteReviews', 'CommentsController@deleteReviews');

//Admin categories
$router->get('/admin/categories', 'CategoriesController@categories');
$router->post('/admin/categories', 'CategoriesController@categories');

$router->get('/admin/categories/editCategories', 'CategoriesController@showEditCategories');
$router->post('/admin/categories/editCategories', 'CategoriesController@editCategories');

$router->get('/admin/categories/addCategories', 'CategoriesController@showAddCategories');
$router->post('/admin/categories/addCategories', 'CategoriesController@addCategories');

$router->get('/admin/categories/deleteCategories', 'CategoriesController@deleteCategories');

//Admin order
$router->get('/admin/orders', 'OrdersController@orders');
$router->post('/admin/orders', 'OrdersController@orders');

$router->get('/admin/orders/detail', 'OrdersController@detail');

$router->post('/admin/orders/updateInfo', 'OrdersController@updateInfo');

$router->post('/admin/orders/updateStatus', 'OrdersController@updateStatus');

$router->get('/admin/orders/deleteOrders', 'OrdersController@delete');

//Admin Coupon 
$router->get('/admin/coupons', 'CouponsController@coupons');
$router->post('/admin/coupons', 'CouponsController@coupons');

$router->get('/admin/coupons/addCoupons', 'CouponsController@addCoupons');
$router->post('/admin/coupons/addCoupons', 'CouponsController@addCoupons');

$router->post('/admin/coupons/updateInfo', 'CouponsController@updateInfo');

$router->post('/admin/coupons/updateStatus', 'CouponsController@updateStatus');

$router->get('/admin/coupons/deleteCoupons', 'CouponsController@deleteCoupons');
$router->post('/admin/coupons/ajax_random_code', 'CouponsController@ajax_random_code');




//Front end 
//Home
$router->get('/', 'HomeController@index');
$router->post('/view-more-posts','HomeController@viewMorePosts');
$router->post('/filter-by-category','HomeController@filterByCategory');

//Category post
$router->get('/category-detail', 'CategoryController@detail');
$router->post('/view-more','CategoryController@viewMore');


//Detail post
$router->get('/post-detail', 'PostController@detail');
$router->post('/post-detail', 'PostController@detail');
$router->post('/post-detail/save-comment', 'PostController@comment');
$router->get('/search-result', 'PostController@searchKeywords');


//Detail Product
$router->get('/product-detail', 'ProductsController@detail');
$router->get('/shop-wishlist', 'ProductsController@detailWishlist');

//Shop cart 
$router->get('/shop-cart', 'ProductsController@shopCart');

//Order Checkout
$router->get('/shop-checkout', 'ProductsController@shopCheckout');
$router->post('/shop-checkout', 'ProductsController@shopCheckout');
//Login 
$router->get('/page-login','AuthsController@pageLogin');
$router->post('/page-login','AuthsController@pageLogin');

//Register
$router->get('/page-register','AuthsController@pageRegister');
$router->post('/page-register','AuthsController@pageRegister');

//Forgot
$router->get('/page-forgot','AuthsController@pageForgot');
$router->post('/page-forgot','AuthsController@pageForgot');

//Reset
$router->get('/page-reset', 'AuthsController@pageReset');
$router->post('/page-reset', 'AuthsController@pageReset');

//Logout
$router->get('/page-logout', 'AuthsController@pageLogout');

//Account
$router->get('/page-account', 'AuthsController@pageAccount');
$router->post('/page-account', 'AuthsController@pageAccount');

//Category-products
$router->get('/category-products', 'ProductsController@category');

//Change price filter
$router->get('/products/filter-price', 'ProductsController@filter');


//Ajax
$router->post('/ajax-save-wishlist', 'ProductsController@saveWishlist');
$router->post('/ajax-remove-all-wishlist', 'ProductsController@removeMultiWishlist');
$router->post('/ajax-save-shop-cart', 'ProductsController@saveShopCart');
$router->post('/ajax-update-cart-quantity', 'ProductsController@updateCartQuantity');
$router->post('/ajax-remove-cart', 'ProductsController@removeCart');
$router->get('/ajax-get-products-by-category', 'HomeController@ajaxGetProductsByCategory');
$router->post('/ajax-apply-coupon', 'ProductsController@applyCoupon');
$router->post('/ajax-remove-coupon', 'ProductsController@removeCoupon');