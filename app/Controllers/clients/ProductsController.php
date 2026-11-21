<?php
class ProductsController extends BaseController
{
    private $postModel;
    private $categoriesModel;
    private $productModel;
    private $reviewsModel;
    private $usersModel;
    private $coreModel;

    public function __construct()
    {
        $this->postModel = new Posts();
        $this->categoriesModel = new Categories();
        $this->productModel = new Product();
        $this->reviewsModel = new Reviews();
        $this->usersModel = new Users();
        $this->coreModel = new CoreModel();

    }

    public function detail()
    {
        $user_id = 1;
        $filter = filterData();
        $product = $this->productModel->getOneProduct("SELECT * FROM products WHERE id = " . $filter['id']);

        if (empty($product)) {
            redirect('/');
            return;
        }
        $product_id = $_GET['id'] ?? 0;

        $productsByCategory = $this->productModel->getAllProducts("SELECT * FROM products ");
        $getAllProducts = $this->productModel->getAllProducts("SELECT * FROM products ");
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories ");
        $getAllReviews = $this->reviewsModel->getAllReviews("SELECT * FROM reviews");
        $review = $this->reviewsModel->countReviews(" WHERE a.product_id = " . $product_id);
        $checkUserWishlist = $this->usersModel->getCheckUserWishlist($product_id);


        $data = [
            'review' => $review,
            'product' => $product,
            'productsByCategory' => $productsByCategory,
            'getAllProducts' => $getAllProducts,
            'getCategory' => $getCategory,
            'getAllReviews' => $getAllReviews,
            'checkUserWishlist' => $checkUserWishlist,

        ];
        $data['main_content'] = $this->renderViewHtml('layouts/product/detail', $data);
        $this->renderViewLayout($data);
    }

    public function detailWishlist()
    {
        
        $user_id = 1; 
        $listProductsWishlist = $this->productModel->getProductsWishlist($user_id);
        $getAllProducts = $this->productModel->getAllProducts("SELECT * FROM products ");
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories ");

        $data = [
            'listProductsWishlist' => $listProductsWishlist,
            'getAllProducts' => $getAllProducts,
            'getCategory' => $getCategory,
        ];

        $data['main_content'] = $this->renderViewHtml('layouts/product/shop-wishlist', $data);
        $this->renderViewlayout($data);
    }

    public function saveWishlist()
    {
        if (isPost()) {
            $filter = filterData();

            if (!empty($filter['product_id'])) {
                $idProduct = $filter['product_id'];

                $checkUserWishlist = $this->usersModel->getCheckUserWishlist($idProduct);
                if(empty($checkUserWishlist)) {
                    $param_stores = [
                        'product_id' => $idProduct,
                        'user_id'    => 1
                    ];

                    $this->usersModel->insertUsersWishlist($param_stores);

                    echo json_encode([
                        'status'  => 'success',
                        'message' => 'Product added to wishlist successfully.',
                        'count'   => countUserWishlist()
                    ]);
                }else {
                    echo json_encode([
                        'status'  => 'danger',
                        'message' => 'Please double check.'
                    ]);
                }
               
            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Please double check.'
                ]);
            }
        }
    }


    public function removeMultiWishlist()
    {
        if (isPost()) {
            $filter = filterData();

            if (!empty($filter['list_product_id'])) {
                $listIdProduct = $filter['list_product_id'];
                $listIdProduct = implode(',', $listIdProduct);

                $this->usersModel->removeUsersWishlist($listIdProduct, 1);

                echo json_encode([
                    'status'  => 'success',
                    'message' => 'removed all products from wishlist successfully.',
                    'count'   => countUserWishlist()
                ]);
                
            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Please double check.'
                ]);
            }
        }
    }

    public function shopCart()
    {
        $getAllProducts = $this->productModel->getAllProducts("SELECT * FROM products ");
        $products     = getSession('shopCart');
        $productsCart = !empty($products) ? json_decode($products, true) : null;
        $listProducts = [];

        if (!empty($productsCart['listProducts'])) {
            $productIds = array_column($productsCart['listProducts'], 'product_id');
            $productIds = implode(', ', $productIds);

            $listProducts = $this->productModel->getListProductsByIds($productIds);
            $quantityMap  = array_column($productsCart['listProducts'], 'quantity', 'product_id');

            foreach ($listProducts as &$product) {
                $product['quantity'] = $quantityMap[$product['id']] ?? 0;
            }
            unset($product);
        }

        $data = [
            'getAllProducts' => $getAllProducts,
            'listProducts'  => $listProducts,  
            'productsCart'  => $productsCart, 
        ];
        $data['main_content'] = $this->renderViewHtml('layouts/product/shop-cart', $data);
        $this->renderViewLayout($data);
    }

    public function applyCoupon()
    {
        $filter = filterData();
        $code   = $filter['code'] ?? '';

        if (empty($code)) {
            echo json_encode([
                'status'  => 'danger',
                'message' => 'The coupon is invalid or has expired.'
            ]);
            die();
        }

        $shopCart     = getSession('shopCart');
        $productsCart = !empty($shopCart) ? json_decode($shopCart, true) : null;
        if (empty($productsCart['listProducts'])) {
            echo json_encode([
                'status'  => 'danger',
                'message' => 'Please add product'
            ]);
            die();
        }

        $coupon = $this->coreModel->getOne("SELECT * FROM coupons WHERE code = '$code' AND status = 1 AND expired > NOW()");

        if (empty($coupon)) {
            echo json_encode([
                'status'  => 'danger',
                'message' => 'The coupon is invalid or has expired.'
            ]);
            die();
        }

        $productsCart = !empty($shopCart) ? json_decode($shopCart, true) : null;
        $total        = $productsCart['total'] ?? 0;

        if ($coupon['discount_type'] == 1) {
            $discount = round($total * $coupon['discount_price'] / 100, 2);
        } else {
            $discount = $coupon['discount_price'];
        }
        $newTotal = round($total - $discount, 2);

        // Lưu thẳng vào shopCart session
        $productsCart['coupons']   = $coupon['code'];
        $productsCart['discount_percent'] = $coupon['discount_price'];
        $productsCart['discount'] = $discount;
        $productsCart['newTotal'] = $newTotal;
        setSession('shopCart', json_encode($productsCart));

        echo json_encode([
            'status'   => 'success',
            'message'  => 'Coupon applied! You save $' . $discount,
            'discount' => $discount,
            'total'    => $newTotal
        ]);
        die();
    }

    public function removeCoupon()
    {
        $shopCart     = getSession('shopCart');
        $productsCart = !empty($shopCart) ? json_decode($shopCart, true) : null;

        unset($productsCart['coupon']);
        unset($productsCart['discount_percent']);

        setSession('shopCart', json_encode($productsCart));

        echo json_encode([
            'status'  => 'success',
            'message' => 'Coupon removed successfully!',
            'total'   => $productsCart['total']
        ]);
        die();
    }

    public function saveShopCart()
    {
        $filter = filterData();
        
        $listProductsShopCart = getSession('shopCart');
        $listProductsShopCart = !empty($listProductsShopCart) 
            ? json_decode($listProductsShopCart, true) 
            : ['listProducts' => [], 'totalProducts' => 0, 'total' => 0 ,];

        if (!empty($filter['product_id']) && !empty($filter['quantity'])) {
            
            $detailProduct = $this->productModel->getDetailProductById($filter['product_id']);
            //dd($detailProduct['available']);
            if(!empty($detailProduct)){
                $quantity = (int)$filter['quantity'];
                $available = (int)$detailProduct['available'];

                $param_stores[$filter['product_id']] = [
                    'product_id' => $filter['product_id'],
                    'quantity'   => $quantity,
                    'price'   => $detailProduct['discount_price'],
                    'total'   => $detailProduct['discount_price'] * $quantity,
                    'user_id'    => 1,
                    'available' => $available
                ];
        
                $merged = array_merge($listProductsShopCart['listProducts'], $param_stores);
                $result = [];
                $total = 0;
                $currentQty = 0;
                foreach ($listProductsShopCart['listProducts'] as $item) {
                    if ($item['product_id'] == $filter['product_id']) {
                        $currentQty = $item['quantity'];
                        break;
                    }
                }
                $totalQty = $currentQty + $quantity;

                if ($totalQty > $available) {
                    echo json_encode([
                        'status'  => 'danger',
                        'message' => 'Only ' . $available . ' items available in stock.'
                    ]);
                    return;
                }

                foreach ($merged as $item) {
                    if (!isset($item['product_id'])) continue;
                    $pid = $item['product_id'];

                    if (isset($result[$pid])) {
                        $result[$pid]['quantity'] += $item['quantity'];
                        $result[$pid]['total'] = $result[$pid]['quantity'] * $detailProduct['discount_price'];
                    } else {
                        $result[$pid] = $item;
                    }

                    $total += $item['total'];
                }
            }

         
            // total_items
            $listProductsShopCart = [
                'listProducts'  => $result,
                'totalProducts' => count($result),
                'total' => $total
            ];
            
            setSession('shopCart', json_encode($listProductsShopCart));

            $productIds = array_column($result, 'product_id');
            $productIds = implode(', ', $productIds);
            $listProducts = $this->productModel->getListProductsByIds($productIds);
            $quantityMap = array_column($result, 'quantity', 'product_id');
            foreach ($listProducts as &$product) {
                $product['quantity'] = $quantityMap[$product['id']] ?? 0;
            }
            unset($product);
            $htmlCartItems = $this->renderViewHtml('layouts/product/shop-cart-items', ['listProducts' => $listProducts]);
            $html = $this->renderViewHtml('layouts/product/cart-dropdown', ['listProducts' => $listProducts]);
        

            echo json_encode([
                'status'  => 'success',
                'message' => 'Success!',
                'totalProducts'   => $listProductsShopCart['totalProducts'],
                'total'   => $total,
                'htmlCartDropdown' => $html,
                'htmlCartItems'=> $htmlCartItems
            ]);

        } else {
            echo json_encode([
                'status'  => 'danger',
                'message' => 'Please double check.'
            ]);
        }
    }

    public function updateCartQuantity()
    {
        $filter = filterData();

        if (!empty($filter['product_id']) && !empty($filter['quantity'])) {
            $listProductsShopCart = getSession('shopCart');
            $listProductsShopCart = !empty($listProductsShopCart)
                ? json_decode($listProductsShopCart, true)
                : ['listProducts' => [], 'totalProducts' => 0, 'total' => 0,];

            $detailProduct = $this->productModel->getDetailProductById($filter['product_id']);
            $available     = (int)$detailProduct['available'];
            $newQty        = max(1, (int)$filter['quantity']);

            if ($newQty > $available) {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Only ' . $available . ' items available in stock.'
                ]);
                return;
            }
                
            $total = 0;
            $subtotal = 0;
            foreach ($listProductsShopCart['listProducts'] as &$item) {
                if ($item['product_id'] == $filter['product_id']) {
                    $item['quantity'] = max(1, (int)$filter['quantity']);
                    $item['total'] = $item['price'] * $item['quantity'];
                    $subtotal = $item['total'];
                }
                $total += $item['price'] * $item['quantity'];
            }
            unset($item);

            $listProducts = getCartProducts();
            $html = $this->renderViewHtml('layouts/product/cart-dropdown', ['listProducts' => $listProducts]);

            $listProductsShopCart['total'] = $total;
            setSession('shopCart', json_encode($listProductsShopCart));


            echo json_encode([
                'status'   => 'success',
                'message'  => 'Updated successfully!',
                'subtotal'      => $subtotal,
                'total'         => $total,
                'totalProducts'    => $listProductsShopCart['totalProducts'],
                'htmlCartDropdown' => $html
            ]);
        }
    }

    public function removeCart()
    {
        if (isPost()) {
            $filter = filterData();

            if (!empty($filter['list_product_id'])) {
                $list_product_id = is_array($filter['list_product_id']) ? $filter['list_product_id'] : [$filter['list_product_id']];

                $listProductsShopCart = getSession('shopCart');
                $listProductsShopCart = !empty($listProductsShopCart) ? json_decode($listProductsShopCart, true) : ['listProducts' => [], 'totalProducts' => 0];

                $listProductsShopCart['listProducts'] = array_values(
                    array_filter($listProductsShopCart['listProducts'], function($item) use ($list_product_id) {
                        return !in_array($item['product_id'], $list_product_id);
                    })
                );

                $total = 0;
                foreach ($listProductsShopCart['listProducts'] as $item) {
                    $total = $total + $item['total'];
                }
                
                $listProductsShopCart['totalProducts'] = count($listProductsShopCart['listProducts']);
                $listProductsShopCart['total'] = $total;
              
                setSession('shopCart', json_encode($listProductsShopCart));
                $listProducts = getCartProducts();
                $html = $this->renderViewHtml('layouts/product/cart-dropdown', ['listProducts' => $listProducts]);

                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Removed products from cart successfully.',
                    'count'   => $listProductsShopCart['totalProducts'],
                    'total'   => $total,
                    'htmlCartDropdown' => $html
                ]);

            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Please double check.'
                ]);
            }
        }
    }

    public function shopCheckout()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate Email
            if (empty(trim($filter['email']))) {
                $errors['email']['required'] = 'Email must be entered';
            } else {
                //Đúng định dạng email , email này đã tồn tại trong CSDL chưa 
                if (!validateEmail(trim($filter['email']))) {
                    $errors['email']['isEmail'] = 'Email is not in the correct format.';
                }
            }

            if (empty(trim($filter['firstname']))) {
                $errors['firstname']['required'] = 'The first name must be entered.';
            }

            if (empty(trim($filter['lastname']))) {
                $errors['lastname']['required'] = 'The last name must be entered.';
            }

            if (empty(trim($filter['address1']))) {
                $errors['address1']['required'] = 'Address1 must be entered';
            }

            if (empty(trim($filter['address2']))) {
                $errors['address2']['required'] = 'Address2 must be entered';
            }

            if (empty(trim($filter['city']))) {
                $errors['city']['required'] = 'City must be entered';
            }

            if (empty(trim($filter['postcode']))) {
                $errors['postcode']['required'] = 'Postcode must be entered';
            }

            if (empty(trim($filter['phone']))) {
                $errors['phone']['required'] = 'Phone must be entered';
            }

            if (!empty($errors)) {
                
                echo json_encode([
                    'status'  => 'danger',
                    'message' => $errors
                ]);
                return;
            }

            // Lấy session giỏ hàng
            $shopCart     = getSession('shopCart');
            $productsCart = !empty($shopCart) ? json_decode($shopCart, true) : null;

            if (empty($productsCart['listProducts'])) {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Your cart is empty.'
                ]);
                return;
            }

            // Lấy user_id từ session
            // $token    = getSession('token_login');
            // $tokenRow = $this->coreModel->getOne("SELECT * FROM token_login WHERE token = '$token'");
            // $user_id  = $tokenRow['user_id'] ?? 1;

            // Tính total
            $total = 0;
            foreach ($productsCart['listProducts'] as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Lưu vào users_orders
            $orderData = [
                'user_id'   => 1,
                'firstname'  => $filter['firstname'],
                'lastname'   => $filter['lastname'],
                'email'      => $filter['email'],
                'phone'      => $filter['phone'],
                'address1'   => $filter['address1'],
                'address2'   => $filter['address2'],
                'city'       => $filter['city'],
                'total'      => $total,
                'status'     => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $users_order_id = $this->coreModel->insertReturnId('users_orders', $orderData);
            if ($users_order_id) {
                
                foreach ($productsCart['listProducts'] as $item) {
                    
                    $detailData = [
                        'users_order_id' => $users_order_id,
                        'product_id'     => $item['product_id'],
                        'quantity'       => $item['quantity'],
                        'price'          => $item['price'],
                        'created_at'     => date('Y-m-d H:i:s')
                    ];
                    
                    $this->coreModel->insert('orders', $detailData);

                    $this->coreModel->query(
                        "UPDATE products SET available = available - {$item['quantity']} WHERE id = {$item['product_id']}"
                    );

                    $this->coreModel->query(
                        "UPDATE products SET sold = sold + {$item['quantity']} WHERE id = {$item['product_id']}"
                    );
                }

                setSession('shopCart', null);

                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Order placed successfully!'
                ]);
            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Order failed. Please try again.'
                ]);
            }

        } else {
            // GET - hiển thị trang checkout
            $shopCart     = getSession('shopCart');
            $productsCart = !empty($shopCart) ? json_decode($shopCart, true) : null;

            if (empty($productsCart['listProducts'])) {
                redirect('/shop-cart');
                return;
            }

            $productIds   = implode(', ', array_column($productsCart['listProducts'], 'product_id'));
            $listProducts = $this->productModel->getListProductsByIds($productIds);

            $quantityMap = array_column($productsCart['listProducts'], 'quantity', 'product_id');
            $total       = 0;
            foreach ($listProducts as &$product) {
                $product['quantity'] = $quantityMap[$product['id']] ?? 0;
                $total              += $product['discount_price'] * $product['quantity'];
            }
            unset($product);

            $dataUser = [];
            $token = getSession('token_login');
            if (!empty($token)) {
                $tokenRow = $this->coreModel->getOne("SELECT * FROM token_login WHERE token = '$token'");
                if (!empty($tokenRow)) {
                    $dataUser = $this->coreModel->getOne("SELECT * FROM users WHERE id = {$tokenRow['user_id']}");
                }
            }

            $data = [
                'listProducts' => $listProducts,
                'productsCart' => $productsCart,
                'total'        => $total,
                'dataUser'     => $dataUser
            ];
            $data['main_content'] = $this->renderViewHtml('layouts/product/shop-checkout', $data);
            $this->renderViewLayout($data);
        }
    }

    public function category()
    {
        
        $filter      = filterData('get');
        $category_id = $filter['id'] ?? null;

        if (empty($category_id)) {
            redirect('/');
            return;
        }

        $category      = $this->categoriesModel->getAllCategories("SELECT * FROM categories WHERE id = $category_id");
        $listProducts  = $this->productModel->getAllProducts("SELECT * FROM products WHERE category_id = $category_id");
        $getAllProducts = $this->productModel->getAllProducts("SELECT * FROM products");
        $getCategory   = $this->categoriesModel->getAllCategories("SELECT * FROM categories");
        //dd($listProducts);

        $priceRanges = [
            ['min' => 0,    'max' => 100,  'label' => 'Free - $100'],
            ['min' => 100,  'max' => 200,  'label' => '$100 - $200'],
            ['min' => 200,  'max' => 400,  'label' => '$200 - $400'],
            ['min' => 400,  'max' => 600,  'label' => '$400 - $600'],
            ['min' => 600,  'max' => 800,  'label' => '$600 - $800'],
            ['min' => 1000, 'max' => 2000, 'label' => 'Over $1000'],
        ];

        foreach ($priceRanges as &$range) {
            $range['count'] = $this->coreModel->getRows(
                "SELECT * FROM products WHERE discount_price BETWEEN {$range['min']} AND {$range['max']}"
            );
        }
        unset($range);

        
        
        $data = [
            'category'      => $category,
            'listProducts'  => $listProducts,
            'getAllProducts' => $getAllProducts,
            'getCategory'   => $getCategory,
            'priceRanges'   => $priceRanges,
        ];


        $data['main_content'] = $this->renderViewHtml('layouts/product/category-products', $data);
        $this->renderViewLayout($data);
    }

    public function filter()
    {
        $filter = filterData('get');
        $min_price = !empty($filter['min_price']) ? (int)$filter['min_price'] : 0;
        $max_price = !empty($filter['max_price']) ? (int)$filter['max_price'] : 2000;
        $sort      = !empty($filter['sort']) ? $filter['sort'] : 'latest';
        $limit     = !empty($filter['limit']) ? (int)$filter['limit'] : 10;
        if ($sort == 'latest') {
            $order = 'ORDER BY id DESC';
        } elseif ($sort == 'oldest') {
            $order = 'ORDER BY id ASC';
        } else {
            $order = 'ORDER BY id DESC';
        }

        $listProducts = $this->productModel->getAllProducts(
        "SELECT * FROM products WHERE discount_price BETWEEN $min_price AND $max_price $order LIMIT $limit"
    );

    $data = [
        'listProducts' => $listProducts,
    ];

    echo $this->renderViewHtml('layouts/product/filter-price', $data);
    die();
    //$this->renderViewLayout($data);
    }
}
