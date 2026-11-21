<?php
class CommentsController extends BaseController
{
    private $commentsModel;
    private $reviewsModel;
    private $productModel;
    private $postModel;
    public function __construct()
    {
        $this->commentsModel = new Comments();
        $this->reviewsModel = new Reviews();
        $this->productModel = new Product();
        $this->postModel = new Posts();
    }

    public function comments()
    {
        $filter = filterData();
        $chuoiWhere = '';
        $comments = '';
        $keyword = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (isset($filter['comments'])) {
                $comments = $filter['comments'];
            }

            if (!empty($keyword)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "(a.fullname LIKE '%$keyword%')";
            }

            if (!empty($comments)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "a.category_id = $comments";
            }
        }
        // dd($chuoiWhere);
        // Xử lý chân trang 
        $maxData = $this->commentsModel->countComments($chuoiWhere);

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

        $getComments = $this->commentsModel->getAllComments("SELECT * FROM comments a 
        $chuoiWhere LIMIT $offset, $perPage;
");


        //Xử lý query 
        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'commentModel' => $this->commentsModel,
            'getComment'   => $getComments,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
            'comment'     => $comments,
        ];
        $this->renderView('layouts-part/comments/comments', $data);
    }

    public function showEditComments()
    {
        $filter = filterData('get');

        if (empty($filter['id'])) {
            redirect('/admin/comments');
            return;
        }

        $comments = $this->commentsModel->getOneComment("SELECT * FROM comments WHERE id = " . $filter['id']);

        if (empty($comments)) {
            redirect('/admin/comments');
            return;
        }

        $data = [
            'comment' => $comments,
            'idComment' => $filter['id']
        ];

        $listPosts = $this->postModel->getAllPosts("SELECT * FROM posts");
        $data['listPosts'] = $listPosts;
        $this->renderView('layouts-part/comments/editComments', $data);
    }

    public function editComments()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['fullname']))) {
                $errors['fullname']['required'] = 'Tên người viết bắt buộc phải nhập';
            }

            if (empty(trim($filter['post_id']))) {
                $errors['post_id']['required'] = 'Bài viết bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $updateComments = [
                    'fullname' => $filter['fullname'],
                    'content' => htmlspecialchars_decode($filter['content']), 
                    'post_id' => $filter['post_id'],
                    'updated_at' => date('Y:m:d H:i:s')
                ];

                $idComment = $filter['idComments'];
                $condition = "id=" . $idComment;
                $updateComments = $this->commentsModel->updateComments($updateComments, "id=$idComment");
                if ($updateComments) {
                    setSessionFlash('msg', 'Chỉnh sửa nội dung thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/comments');
                } else {
                    setSessionFlash('msg', 'Chỉnh sửa nội dung thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/comments/editComments?id=' . $filter['idComments']);
            }
        }
        $this->renderView('layouts-part/comments/editComments');
    }

    public function showAddComments()
    {
        $listPosts = $this->postModel->getAllPosts("SELECT * FROM posts");
        $this->renderView('layouts-part/comments/addComments', ['listPosts' => $listPosts]);
    }

    public function addComments()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['fullname']))) {
                $errors['fullname']['required'] = 'Tên đầy đủ bắt buộc phải nhập';
            }

            if (empty(trim($filter['post_id']))) {
                $errors['post_id']['required'] = 'Bài viết bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $dataInsert = [
                    'fullname' => $filter['fullname'],
                    'content' => htmlspecialchars_decode($filter['content']),
                    'post_id' => $filter['post_id'],
                    'created_at' => date('Y:m:d H:i:s')
                ];

                $dataInsert = $this->commentsModel->insertComments($dataInsert);
                if ($dataInsert) {
                    setSessionFlash('msg', 'Thêm nội dung thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/comments');
                } else {
                    setSessionFlash('msg', 'Thêm nội dung thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/comments/addComments');
            }
        }

        $this->renderView('layouts-part/comments/addComments');
    }

    public function deleteComments()
    {
        $filter = filterData('get');
        if (!empty($filter)) {
            $comments_id = $filter['id'];
            $checkComments = $this->commentsModel->getOneComment("SELECT * FROM comments WHERE id = $comments_id");
            if (!empty($checkComments)) {
                $deleteComments = $this->commentsModel->deleteComments("id = '$comments_id'");
                if ($deleteComments) {
                    setSessionFlash('msg', 'Xóa nội dung thành công');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/comments');
                }
            } else {
                setSessionFlash('msg', 'Nội dung không tồn tại');
                setSessionFlash('msg_type', 'danger');
                redirect('/admin/comments');
            }
        } else {
            setSessionFlash('msg', 'Đã có lỗi xảy ra , vui lòng thử lại sau');
            setSessionFlash('msg_type', 'danger');
        }
    }

    public function reviews()
    {
        $filter = filterData();
        $chuoiWhere = '';
        $reviews = '';
        $keyword = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (isset($filter['reviews'])) {
                $reviews = $filter['reviews'];
            }

            if (!empty($keyword)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "(a.name LIKE '%$keyword%')";
            }

            if (!empty($reviews)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "a.product_id = $reviews";
            }
        }
        // dd($chuoiWhere);
        // Xử lý chân trang 
        $maxData = $this->reviewsModel->countReviews($chuoiWhere);

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

        $getReviews = $this->reviewsModel->getAllReviews("SELECT * FROM reviews a 
        $chuoiWhere LIMIT $offset, $perPage;
");


        //Xử lý query 
        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'commentModel' => $this->reviewsModel,
            'getReviews'   => $getReviews,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
            'reviews'     => $reviews,
        ];
        $this->renderView('layouts-part/reviews/reviews', $data);
    }

    public function addReviews()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['name']))) {
                $errors['name']['required'] = 'Tên đầy đủ bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }
            if (empty($filter['product_id'])) {
                $errors['product_id']['required'] = 'Vui lòng chọn sản phẩm';
            }

            if (empty($errors)) {

                $dataInsert = [
                    'name' => $filter['name'],
                    'content' => htmlspecialchars_decode($filter['content']),
                    'product_id' => $filter['product_id'],
                    'created_at' => date('Y:m:d H:i:s')
                ];

                $dataInsert = $this->reviewsModel->insertReviews($dataInsert);
                if ($dataInsert) {
                    setSessionFlash('msg', 'Thêm nội dung thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/reviews');
                } else {
                    setSessionFlash('msg', 'Thêm nội dung thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/reviews/addReviews');
            }
        }
        
        
        $this->renderView('layouts-part/reviews/addReviews');
    }

    public function showAddReviews()
    {
        $listProducts = $this->productModel->getAllProducts("SELECT * FROM products");
        $this->renderView('layouts-part/reviews/addReviews', ['listProducts' => $listProducts]);
    }

    public function showEditReviews()
    {
        $filter = filterData('get');

        if (empty($filter['id'])) {
            redirect('/admin/reviews');
            return;
        }

        $review = $this->reviewsModel->getOneReview("SELECT * FROM reviews WHERE id = " . $filter['id']);

        if (empty($review)) {
            redirect('/admin/reviews');
            return;
        }

        $data = [
            'review' => $review,
            'idReview' => $filter['id']
        ];

        $this->renderView('layouts-part/reviews/editReviews', $data);
    }

    public function editReviews()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['name']))) {
                $errors['name']['required'] = 'Tên người viết bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $updateReviews = [
                    'name' => $filter['name'],
                    'content' =>  htmlspecialchars_decode($filter['content']), 
                    'product_id' => $filter['product_id'],
                    'updated_at' => date('Y:m:d H:i:s')
                ];

                $idReview = $filter['idReviews'];
                //$condition = "id=" . $idReview;
                $updateReviews = $this->reviewsModel->updateReviews($updateReviews, "id=$idReview");
                if ($updateReviews) {
                    setSessionFlash('msg', 'Chỉnh sửa nội dung thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/reviews');
                } else {
                    setSessionFlash('msg', 'Chỉnh sửa nội dung thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/reviews/editReviews?id=' . $filter['idReviews']);
            }
        }
        $this->renderView('layouts-part/reviews/editReviews');
    }

    public function deleteReviews()
    {
        $filter = filterData('get');
        if (!empty($filter)) {
            $reviews_id = $filter['id'];
            $checkReviews = $this->reviewsModel->getOneReview("SELECT * FROM reviews WHERE id = $reviews_id");
            if (!empty($checkReviews)) {
                $deleteReviews = $this->reviewsModel->deleteReviews("id = '$reviews_id'");
                if ($deleteReviews) {
                    setSessionFlash('msg', 'Xóa nội dung thành công');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/reviews');
                }
            } else {
                setSessionFlash('msg', 'Nội dung không tồn tại');
                setSessionFlash('msg_type', 'danger');
                redirect('/admin/reviews');
            }
        } else {
            setSessionFlash('msg', 'Đã có lỗi xảy ra , vui lòng thử lại sau');
            setSessionFlash('msg_type', 'danger');
        }
    }
}