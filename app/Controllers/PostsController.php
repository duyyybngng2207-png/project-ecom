<?php
class PostsController extends BaseController
{
    private $postModel;
    private $categoriesModel;
    
    public function __construct()
    {
        $this->postModel = new Posts();
        $this->categoriesModel = new Categories();
    }

    
    public function list()
    {
        $filter = filterData();
        $chuoiWhere = '';
        $course = '';
        $keyword = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (isset($filter['course'])) {
                $course = $filter['course'];
            }

            if (!empty($keyword)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "(a.title LIKE '%$keyword%')";
            }

            if (!empty($course)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "a.category_id = '$course'";
            }
        }
        // dd($chuoiWhere);
        // Xử lý chân trang 
        $maxData = $this->postModel->countPosts($chuoiWhere);

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

        $getCourse = $this->postModel->getAllPosts("SELECT * FROM posts a 
        $chuoiWhere LIMIT $offset, $perPage;
");


        //Xử lý query 
        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'postModel' => $this->postModel,
            'getCourse' => $getCourse,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
            'course'      => $course,
        ];
        $this->renderView('layouts-part/posts/list', $data);
    }

    public function showAdd()
    {
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories");
        $data = [
            'categoriesModel'=> $this->categoriesModel,
            'getCategory'=> $getCategory,
            
        ];

        $this->renderView('layouts-part/posts/add',$data);
    }

    public function add()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['title']))) {
                $errors['title']['required'] = 'Tên tiêu đề bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $dataInsert = [
                    'title' => $filter['title'],
                    'content' => $filter['content'],
                    'category_id' => $filter['category_id'],
                ];

                $dataInsert = $this->postModel->insertPosts($dataInsert);
                if ($dataInsert) {
                    setSessionFlash('msg', 'Thêm bài viết thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/posts');
                } else {
                    setSessionFlash('msg', 'Thêm bài viết thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/posts/add');
            }
        }
        $this->renderView('layouts-part/posts/add');
    }

    public function showEdit()
    {
        $filter = filterData('get');

        if (empty($filter['id'])) {
            redirect('/admin/posts');
            return;
        }

        $post = $this->postModel->getOnePost("id = " . $filter['id']);

        if (empty($post)) {
            redirect('/admin/posts');
            return;
        }

        $data = [
            'post' => $post,
            'idPost' => $filter['id']
        ];

        $this->renderView('layouts-part/posts/edit', $data);
    }

    public function edit()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['title']))) {
                $errors['title']['required'] = 'Tên tiêu đề bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['content']))) {
                $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $updateStatus = [
                    'title' => $filter['title'],
                    'content' => $filter['content'],
                    'updated_at' => date('Y:m:d H:i:s')
                ];

                $idPost = $filter['idPost'];
                $condition = "id=" . $idPost;
                $updateStatus = $this->postModel->updatePosts($updateStatus, "id=$idPost");
                if ($updateStatus) {
                    setSessionFlash('msg', 'Chỉnh sửa bài viết thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/posts');
                } else {
                    setSessionFlash('msg', 'Chỉnh sửa bài viết thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/posts/edit?id=' . $filter['idPost']);
            }
        }
        $this->renderView('layouts-part/posts/edit');
    }

    public function delete()
    {
        $filter = filterData('get');
        if (!empty($filter)) {
            $post_id = $filter['id'];
            $checkPost = $this->postModel->getOnePost("id = $post_id");
            if (!empty($checkPost)) {
                $deleteStatus = $this->postModel->deletePosts("id = '$post_id'");
                if ($deleteStatus) {
                    setSessionFlash('msg', 'Xóa bài viết thành công');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/posts');
                }
            } else {
                setSessionFlash('msg', 'Bài viết không tồn tại');
                setSessionFlash('msg_type', 'danger');
                redirect('/admin/posts');
            }
        } else {
            setSessionFlash('msg', 'Đã có lỗi xảy ra , vui lòng thử lại sau');
            setSessionFlash('msg_type', 'danger');
        }
    }

    
}
