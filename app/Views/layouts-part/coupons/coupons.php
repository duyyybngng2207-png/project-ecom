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
 * @var array $getCoupons
 */
?>
<?php
if (!defined('_HIENU')) {
    die('Truy cập không hợp lệ');
}

$data = ['title' => 'Danh sách thẻ giảm giá'];
layout('header', $data);
layout('sidebar');

$msg      = getSessionFlash('msg');
$msg_type = getSessionFlash('msg_type');
?>
<div class="container">
    <h2>Danh sách thẻ giảm giá</h2>
    <hr>
    <?php if (!empty($msg)) getMsg($msg, $msg_type); ?>

    <a href="<?php echo _HOST_URL; ?>/admin/coupons/addCoupons" class="btn btn-success mb-3">+ Thêm mới</a>

    <table class="table table-bordered text-center">
        
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên mã giảm giá</th>
                <th>Mã code</th>
                <th>Loại mã</th>
                <th>Giá được giảm</th>
                <th>Ngày tạo</th>
                <th>Hết hạn</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getCoupons as $key => $item): ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $item['title']; ?></td>
                <td><?php echo $item['code']; ?></td>
                <td><?php echo $item['discount_type'] == 1 ? 'Giảm %' : 'Giảm tiền'; ?></td>
                <td><?php echo $item['discount_price']; ?></td>
                <td><?php echo $item['created_at']; ?></td>
                <td><?php echo $item['expired']; ?></td>
                <td>
                    <form action="<?php echo _HOST_URL; ?>/admin/coupons/updateStatus" method="POST" class="d-flex align-items-center">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <select name="status" class="form-control form-control-sm mr-2">
                            <option value="0" <?php echo $item['status'] == 0 ? 'selected' : ''; ?>>Chưa phát hành</option>
                            <option value="1" <?php echo $item['status'] == 1 ? 'selected' : ''; ?>>Chưa sử dụng</option>
                            <option value="2" <?php echo $item['status'] == 2 ? 'selected' : ''; ?>>Đã sử dụng</option>
                            <option value="3" <?php echo $item['status'] == 3 ? 'selected' : ''; ?>>Hết hạn</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                    </form>
                </td>
                <td>
                    <a href="<?php echo _HOST_URL; ?>/admin/coupons/deleteCoupons?id=<?php echo $item['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo $page - 1; ?>">Trước</a></li>
            <?php endif; ?>

            <?php
            $start = max(1, $page - 2);
            $end   = min($maxPage, $page + 1);
            ?>

            <?php if ($start > 1): ?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
            <?php endif; ?>

            <?php for ($i = $start; $i <= $end; $i++): ?>
                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($end < $maxPage): ?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
            <?php endif; ?>

            <?php if ($page < $maxPage): ?>
                <li class="page-item"><a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo $page + 1; ?>">Sau</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php layout('footer'); ?>