<?php
class ProductController extends BaseController
{
    private $productModel;
    private $categoriesModel;
    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoriesModel = new Categories();
    }

    public function product()
    {
        $filter = filterData();
        $chuoiWhere = '';
        $product = '';
        $keyword = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (isset($filter['product'])) {
                $product = $filter['product'];
            }

            if (!empty($keyword)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "(a.name LIKE '%$keyword%')";
            }

            if (!empty($product)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "a.category_id = $product";
            }
        }
        // dd($chuoiWhere);
        // Xử lý chân trang 
        $maxData = $this->productModel->countProducts($chuoiWhere);

        $perPage = 3;
        $maxPage = ceil($maxData / $perPage);
        $offset = 0;
        $page = 1;

        if (isset($filter['page'])) {
            $page = (int)$filter['page'];
        }
        if ($page > $maxPage || $page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $perPage;

        $getProduct = $this->productModel->getAllProducts("SELECT * FROM products a 
        $chuoiWhere LIMIT $offset, $perPage;
");


        //Xử lý query 
        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'postModel' => $this->productModel,
            'getProduct'   => $getProduct,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
            'product'     => $product,
        ];
        $this->renderView('layouts-part/product/product', $data);
    }

    public function showEditProduct()
    {
        $filter = filterData('get');

        if (empty($filter['id'])) {
            redirect('/admin/product');
            return;
        }

        $product = $this->productModel->getOneProduct("SELECT * FROM products WHERE id = " . $filter['id']);

        if (empty($product)) {
            redirect('/admin/product');
            return;
        }

        $listCategories = $this->categoriesModel->getAllCategories("SELECT * FROM categories");

        $data = [
            'product' => $product,
            'listCategories' => $listCategories,
            'idProduct' => $filter['id']
        ];

        $this->renderView('layouts-part/product/editProduct', $data);
    }

    public function editProduct()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['name']))) {
                $errors['name']['required'] = 'Tên sản phẩm bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }

            if (empty(trim($filter['price']))) {
                $errors['price']['required'] = 'Giá tiền bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $updateProducts = [
                    'name' => $filter['name'],
                    'content' => $filter['content'],
                    'price' => $filter['price'],
                    'category_id' => $filter['category_id'],
                    'updated_at' => date('Y:m:d H:i:s')
                ];

                if (!empty($_FILES['image']['name'])) {
                    $image     = $_FILES['image'];
                    $imageName = 'product_' . $filter['idProduct'] . '.jpg';
                    $imagePath = './public/img/' . $imageName;
                    

                    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                    } else {
                        setSessionFlash('msg', 'Upload ảnh thất bại.');
                        setSessionFlash('msg_type', 'danger');
                        redirect('/admin/product/editProduct?id=' . $filter['idProduct']);
                        return;
                    }
                }

                $idProduct = $filter['idProduct'];
                //$condition = "id=" . $idProduct;
                $updateProducts = $this->productModel->updateProducts($updateProducts, "id=$idProduct");
                if ($updateProducts) {
                    setSessionFlash('msg', 'Chỉnh sửa sản phẩm thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/product');
                } else {
                    setSessionFlash('msg', 'Chỉnh sửa sản phẩm thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/product/editProduct?id=' . $filter['idProduct']);
            }
        }
        $this->renderView('layouts-part/product/editProduct');
    }

    public function showAddProduct()
    {
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories");
        $this->renderView('layouts-part/product/addProduct', ['getCategory' => $getCategory]);
    }

    public function addProduct()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            if (empty(trim($filter['name']))) {
                $errors['name']['required'] = 'Tên sản phẩm bắt buộc phải nhập';
            }

            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }

            if (empty(trim($filter['price']))) {
                $errors['price']['required'] = 'Giá tiền bắt buộc phải nhập';
            }

            if (empty($errors)) {
                $dataInsert = [
                    'name'       => $filter['name'],
                    'content'    => $filter['content'],
                    'price'      => $filter['price'],
                    'category_id' => $filter['category_id'],
                    'created_at' => date('Y:m:d H:i:s')
                ];

                $insertId = $this->productModel->insertProducts($dataInsert);

                if ($insertId) {
                    // Xử lý upload ảnh
                    if (!empty($_FILES['image']['name'])) {
                        $image     = $_FILES['image'];
                        $imageName = 'product_' . $this->productModel->lastID() . '.jpg';
                        $imagePath = './public/img/' . $imageName;
                        move_uploaded_file($image['tmp_name'], $imagePath);
                    }

                    setSessionFlash('msg', 'Thêm sản phẩm thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/product');
                } else {
                    setSessionFlash('msg', 'Thêm sản phẩm thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/product/addProduct');
            }
        }
        $this->renderView('layouts-part/product/addProduct');
    }

    public function deleteProduct()
    {
        $filter = filterData('get');
        
        if (!empty($filter['id'])) {
            $product_id   = $filter['id'];
            $checkProduct = $this->productModel->getOneProduct("SELECT * FROM products WHERE id = $product_id");
            
            if (!empty($checkProduct)) {
                $deleteProduct = $this->productModel->deleteProducts("id = $product_id");
                if ($deleteProduct) {
                    setSessionFlash('msg', 'Xóa sản phẩm thành công');
                    setSessionFlash('msg_type', 'success');
                } else {
                    setSessionFlash('msg', 'Xóa sản phẩm thất bại');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Sản phẩm không tồn tại');
                setSessionFlash('msg_type', 'danger');
            }
        } else {
            setSessionFlash('msg', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
            setSessionFlash('msg_type', 'danger');
        }

        redirect('/admin/product');
    }

    public function orders()
    {
        $filter = filterData();
        $chuoiWhere = '';
        $product = '';
        $keyword = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (isset($filter['product'])) {
                $product = $filter['product'];
            }

            if (!empty($keyword)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "(a.name LIKE '%$keyword%')";
            }

            if (!empty($product)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "a.category_id = $product";
            }
        }
        // dd($chuoiWhere);
        // Xử lý chân trang 
        $maxData = $this->productModel->countProducts($chuoiWhere);

        $perPage = 3;
        $maxPage = ceil($maxData / $perPage);
        $offset = 0;
        $page = 1;

        if (isset($filter['page'])) {
            $page = (int)$filter['page'];
        }
        if ($page > $maxPage || $page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $perPage;

        $getProduct = $this->productModel->getAllProducts("SELECT * FROM products a 
        $chuoiWhere LIMIT $offset, $perPage;
");


        //Xử lý query 
        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'postModel' => $this->productModel,
            'getProduct'   => $getProduct,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
            'product'     => $product,
        ];
        $this->renderView('layouts-part/orders/orders', $data);
    }
}