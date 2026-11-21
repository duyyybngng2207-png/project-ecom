<?php
class OrdersController extends BaseController
{
    private $ordersModel;
    private $coreModel;

    public function __construct()
    {
        $this->ordersModel = new Orders();
        $this->coreModel   = new CoreModel();
    }

    public function orders()
    {
        $filter     = filterData();
        $chuoiWhere = '';
        $keyword    = '';

        if (isGet()) {
            if (isset($filter['keyword'])) {
                $keyword = $filter['keyword'];
            }
            if (!empty($keyword)) {
                $chuoiWhere .= " WHERE (a.firstname LIKE '%$keyword%' OR a.lastname LIKE '%$keyword%' OR a.email LIKE '%$keyword%')";
            }
        }

        $maxData = $this->ordersModel->countOrders($chuoiWhere);
        $perPage = 5;
        $maxPage = ceil($maxData / $perPage);
        $page    = 1;

        if (isset($filter['page'])) {
            $page = (int)$filter['page'];
        }
        if ($page > $maxPage || $page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $perPage;

        $getOrders = $this->ordersModel->getAllOrders(
            "SELECT * FROM users_orders a $chuoiWhere ORDER BY a.created_at DESC LIMIT $offset, $perPage"
        );

        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            $queryString = str_replace('&page=' . $page, '', $queryString);
        }

        $data = [
            'getOrders'   => $getOrders,
            'page'        => $page,
            'maxPage'     => $maxPage,
            'queryString' => $queryString ?? '',
            'keyword'     => $keyword,
        ];

        $this->renderView('layouts-part/orders/orders', $data);
    }

    public function detail()
    {
        $filter = filterData('get');

        if (empty($filter['id'])) {
            redirect('/admin/orders');
            return;
        }

        $order = $this->ordersModel->getOneOrder("SELECT * FROM users_orders WHERE id = " . $filter['id']);

        if (empty($order)) {
            redirect('/admin/orders');
            return;
        }

        $orderDetails = $this->ordersModel->getOrderWithDetails($filter['id']);

        $data = [
            'order'        => $order,
            'orderDetails' => $orderDetails,
            'idOrder'      => $filter['id']
        ];

        $this->renderView('layouts-part/orders/detail', $data);
    }

    public function delete()
    {
        $filter = filterData('get');

        if (!empty($filter['id'])) {
            $order = $this->ordersModel->getOrderById($filter['id']);

            if (!empty($order)) {
                $this->ordersModel->deleteOrder("id = " . $filter['id']);
                setSessionFlash('msg', 'Xóa đơn hàng thành công');
                setSessionFlash('msg_type', 'success');
            } else {
                setSessionFlash('msg', 'Đơn hàng không tồn tại');
                setSessionFlash('msg_type', 'danger');
            }
        }

        redirect('/admin/orders');
    }

    public function updateStatus()
    {
        $filter = filterData();

        if (!empty($filter['id']) && isset($filter['status'])) {
            $this->ordersModel->updateOrder(
                ['status' => $filter['status']],
                "id = " . $filter['id']
            );
            setSessionFlash('msg', 'Cập nhật trạng thái thành công');
            setSessionFlash('msg_type', 'success');
        }

        redirect('/admin/orders');
    }

    public function updateInfo()
    {
        $filter = filterData();

        if (!empty($filter['id'])) {
            $this->ordersModel->updateOrder([
                'firstname' => $filter['firstname'],
                'lastname' => $filter['lastname'],
                'email'    => $filter['email'],
                'phone'    => $filter['phone'],
                'address1'  => $filter['address1'],
                'address2'  => $filter['address2'],
            ], "id = " . $filter['id']);

            setSessionFlash('msg', 'Cập nhật thông tin thành công');
            setSessionFlash('msg_type', 'success');
        }

        redirect('/admin/orders/detail?id=' . $filter['id']);
    }
}