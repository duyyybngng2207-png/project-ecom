<?php
class CategoriesController extends BaseController
{
    private $categoriesModel;
    public function __construct()
    {
        $this->categoriesModel = new Categories();
    }

    public function categories()
    {
        $filter = filterData();
        $chuoiWhere = '';
        $categories = '';
        $keyword = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (isset($filter['categories'])) {
                $categories = $filter['categories'];
            }

            if (!empty($keyword)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "(a.title LIKE '%$keyword%')";
            }

            if (!empty($categories)) {
                if (strpos($chuoiWhere, 'WHERE') === false) {
                    $chuoiWhere .= ' WHERE ';
                } else {
                    $chuoiWhere .= ' AND ';
                }
                $chuoiWhere .= "a.category_id = $categories";
            }
        }
        // dd($chuoiWhere);
        // Xử lý chân trang 
        $maxData = $this->categoriesModel->countCategories($chuoiWhere);

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

        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories a 
        $chuoiWhere LIMIT $offset, $perPage;
");


        //Xử lý query 
        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'commentModel' => $this->categoriesModel,
            'getCategory'   => $getCategory,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
            'category'     => $categories,
        ];
        $this->renderView('layouts-part/categories/categories', $data);
    }

    public function showEditCategories()
    {
        $filter = filterData('get');

        if (empty($filter['id'])) {
            redirect('/admin/categories');
            return;
        }

        $categories = $this->categoriesModel->getOneCategory("id = " . $filter['id']);

        if (empty($categories)) {
            redirect('/admin/categories');
            return;
        }

        $data = [
            'category' => $categories,
            'idCategory' => $filter['id']
        ];

        $this->renderView('layouts-part/categories/editCategories', $data);
    }

    public function editCategories()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['title']))) {
                $errors['title']['required'] = 'Tên danh mục bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['slug']))) {
                $errors['slug']['required'] = 'Slug bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $updateCategories = [
                    'title' => $filter['title'],
                    'slug' => $filter['slug'], 
                ];

                $idCategory = $filter['idCategories'];
                $condition = "id=" . $idCategory;
                $updateCategories = $this->categoriesModel->updateCategories($updateCategories, "id=$idCategory");
                if ($updateCategories) {
                    setSessionFlash('msg', 'Chỉnh sửa danh mục thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/categories');
                } else {
                    setSessionFlash('msg', 'Chỉnh sửa danh mục thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/categories/editCategories?id=' . $filter['idCategories']);
            }
        }
        $this->renderView('layouts-part/categories/editCategories');
    }

    public function showAddCategories()
    {
        $this->renderView('layouts-part/categories/addCategories');
    }

    public function addCategories()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate name 
            if (empty(trim($filter['title']))) {
                $errors['title']['required'] = 'Tên danh mục bắt buộc phải nhập';
            }

            //Validate slug 
            if (empty(trim($filter['slug']))) {
                $errors['slug']['required'] = 'Slug bắt buộc phải nhập';
            }

            if (empty($errors)) {

                $dataInsert = [
                    'title' => $filter['title'],
                    'slug' => $filter['slug'],
                ];

                $dataInsert = $this->categoriesModel->insertCategories($dataInsert);
                if ($dataInsert) {
                    setSessionFlash('msg', 'Thêm danh mục thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/categories');
                } else {
                    setSessionFlash('msg', 'Thêm danh mục thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/categories/addCategories');
            }
        }
        $this->renderView('layouts-part/categories/addCategories');
    }

    public function deleteCategories()
    {
        $filter = filterData('get');
        if (!empty($filter)) {
            $categories_id = $filter['id'];
            $checkCategories = $this->categoriesModel->getOneCategory("id = " . $filter['id']);
            if (!empty($checkCategories)) {
                $deleteCategories = $this->categoriesModel->deleteCategories("id = '$categories_id'");
                if ($deleteCategories) {
                    setSessionFlash('msg', 'Xóa danh mục thành công');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/categories');
                }
            } else {
                setSessionFlash('msg', 'Danh mục không tồn tại');
                setSessionFlash('msg_type', 'danger');
                redirect('/admin/categories');
            }
        } else {
            setSessionFlash('msg', 'Đã có lỗi xảy ra , vui lòng thử lại sau');
            setSessionFlash('msg_type', 'danger');
        }
    }
}