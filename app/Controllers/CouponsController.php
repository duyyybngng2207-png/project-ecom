<?php
class CouponsController extends BaseController
{
    private $couponsModel;

    public function __construct()
    {
        $this->couponsModel = new Coupons();
    }

    public function coupons()
    {
        $filter     = filterData();
        $chuoiWhere = '';
        $keyword    = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (!empty($keyword)) {
                $chuoiWhere .= " WHERE (a.title LIKE '%$keyword%' OR a.code LIKE '%$keyword%')";
            }
        }

        $maxData = $this->couponsModel->countCoupons($chuoiWhere);
        $perPage = 10;
        $maxPage = ceil($maxData / $perPage);
        $page    = 1;

        if (isset($filter['page'])) {
            $page = (int)$filter['page'];
        }
        if ($page > $maxPage || $page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $perPage;

        $getCoupons = $this->couponsModel->getAllCoupons(
            "SELECT * FROM coupons a $chuoiWhere ORDER BY a.created_at DESC LIMIT $offset, $perPage"
        );

        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'getCoupons'  => $getCoupons,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
        ];

        $this->renderView('layouts-part/coupons/coupons', $data);
    }

    public function showAddCoupons()
    {
        $this->renderView('layouts-part/coupons/addCoupons');
    }

    public function addCoupons()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];


            if (empty(trim($filter['title']))) {
                $errors['title']['required'] = 'Tên coupon bắt buộc phải nhập';
            }

            if (empty(trim($filter['code']))) {
                $errors['code']['required'] = 'Mã code bắt buộc phải nhập';
            }

            if (empty(trim($filter['discount_price']))) {
                $errors['discount_price']['required'] = 'Giá trị giảm bắt buộc phải nhập';
            }

            if (empty($errors)) {
                $dataInsert = [
                    'title'          => $filter['title'],
                    'code'           => $filter['code'],
                    'discount_price' => $filter['discount_price'],
                    'discount_type'  => $filter['discount_type'],
                    'status'         => $filter['status'] ?? 1,
                    'expired'        => $filter['expired'],
                    'created_at'     => date('Y-m-d H:i:s')
                ];

                $insert = $this->couponsModel->insertCoupon($dataInsert);
                if ($insert) {
                    setSessionFlash('msg', 'Thêm coupon thành công.');
                    setSessionFlash('msg_type', 'success');
                    redirect('/admin/coupons');
                } else {
                    setSessionFlash('msg', 'Thêm coupon thất bại.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
                redirect('/admin/coupons/addCoupons');
            }
        }
        $this->renderView('layouts-part/coupons/addCoupons');
    }

    public function deleteCoupons()
    {
        $filter = filterData('get');

        if (!empty($filter['id'])) {
            $coupon = $this->couponsModel->getOneCoupon("SELECT * FROM coupons WHERE id = " . $filter['id']);

            if (!empty($coupon)) {
                $this->couponsModel->deleteCoupon("id = " . $filter['id']);
                setSessionFlash('msg', 'Xóa coupon thành công');
                setSessionFlash('msg_type', 'success');
            } else {
                setSessionFlash('msg', 'Coupon không tồn tại');
                setSessionFlash('msg_type', 'danger');
            }
        }

        redirect('/admin/coupons');
    }

    public function updateStatus()
    {
        $filter = filterData();

        if (!empty($filter['id']) && isset($filter['status'])) {
            $this->couponsModel->updateCoupon(
                ['status' => $filter['status']],
                "id = " . $filter['id']
            );
            setSessionFlash('msg', 'Cập nhật trạng thái thành công');
            setSessionFlash('msg_type', 'success');
        }

        redirect('/admin/coupons');
    }

    public function ajax_random_code() {
        $getRandomCode = 'ECOM-'.generateRandomString(5);
        
        $checkCode = $this->couponsModel->getCouponByCode($getRandomCode);
        if(empty($checkCode)){
            echo json_encode([
                'status'  => 'success',
                'message' => 'Save code successfully',
                'code' => $getRandomCode
            ]);
        }else{
            echo json_encode([
                'status'  => 'danger',
                'message' => 'Code dupplicate'
            ]);
        }
    }
}