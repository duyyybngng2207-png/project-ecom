<?php

/**
 * @var array $order
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $review
 * @var array $listProducts
 * @var array $getProduct
 * @var array $page
 * @var array $queryString
 * @var array $maxPage
 * @var array $orderDetails
 * @var array $product
 */
?>
<?php
if (!defined('_HIENU')) {
    die('Truy cập không hợp lệ');
}

$data = [
    'title' => 'Danh sách khóa học'
];

layout('header', $data);
layout('sidebar');

$msg = getSessionFlash('msg');
$msg_type = getSessionFlash(('msg_type'));
$oldData = getSessionFlash('oldData');
$errorsArr = getSessionFlash('errors');
?>
<div class="container">
    <h2>Chi tiết đơn hàng #<?php echo $order['id']; ?></h2>
    <hr>

    <div class="row mb-30">
        <div class="col-6">
    <h5>Thông tin khách hàng</h5>
    <form action="<?php echo _HOST_URL; ?>/admin/orders/updateInfo" method="POST">
        <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
        <table class="table table-bordered">
            <tr>
                <td><strong>Tên</strong></td>
                <td><input type="text" name="firstname" class="form-control" value="<?php echo $order['firstname']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Họ</strong></td>
                <td><input type="text" name="lastname" class="form-control" value="<?php echo $order['lastname']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td><input type="text" name="email" class="form-control" value="<?php echo $order['email']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Phone</strong></td>
                <td><input type="text" name="phone" class="form-control" value="<?php echo $order['phone']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Địa chỉ 1</strong></td>
                <td><input type="text" name="address1" class="form-control" value="<?php echo $order['address1']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Địa chỉ 2</strong></td>
                <td><input type="text" name="address2" class="form-control" value="<?php echo $order['address2']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Ngày đặt</strong></td>
                <td><?php echo $order['created_at']; ?></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
    </form>
</div>
        <div class="col-6">
            <h5>Trạng thái đơn hàng</h5>
            <form action="<?php echo _HOST_URL; ?>/admin/orders/updateStatus" method="POST">
                <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                <select name="status" class="form-control mb-2">
                    <option value="0" <?php echo $order['status'] == 0 ? 'selected' : ''; ?>>Chờ xử lý</option>
                    <option value="1" <?php echo $order['status'] == 1 ? 'selected' : ''; ?>>Đang xử lý</option>
                    <option value="2" <?php echo $order['status'] == 2 ? 'selected' : ''; ?>>Đã giao</option>
                    <option value="3" <?php echo $order['status'] == 3 ? 'selected' : ''; ?>>Hủy</option>
                </select>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>

    <h5>Danh sách sản phẩm</h5>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderDetails as $key => $item): ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>$<?php echo number_format($item['price']); ?></td>
                <td>$<?php echo number_format($item['price'] * $item['quantity']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td><strong>Tổng</strong></td>
                <td><strong></strong></td>
                <td><strong></strong></td>
                <td><strong></strong></td>
                <td><strong>$<?php echo number_format($order['total']); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <a href="<?php echo _HOST_URL; ?>/admin/orders" class="btn btn-primary">Quay lại</a>
</div>



<?php
layout('footer');
?>