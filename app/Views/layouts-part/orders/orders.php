<?php

/**
 * @var array $product
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $review
 * @var array $getOrders
 * @var array $getProduct
 * @var array $page
 * @var array $queryString
 * @var array $maxPage
 * @var array $keyword
 */
?>
<?php
$data = ['title' => 'Danh sách đơn hàng'];
layout('header', $data);
layout('sidebar');

$msg      = getSessionFlash('msg');
$msg_type = getSessionFlash('msg_type');
?>

<div class="container">
    <h2>Danh sách đơn hàng</h2>
    <hr>
    <a href="<?php echo _HOST_URL; ?>/admin/product/addProduct" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i>Thêm mới đơn hàng</a>
        <?php
            if (!empty($msg) && !empty($msg_type)) {
                getMsg($msg, $msg_type);
            }
            ?>

    <form class="mb-3" action="" method="get">
        <div class="d-flex mb-3">
            <input type="text" name="keyword" class="form-control mr-2" 
                   value="<?php echo (!empty($keyword)) ? $keyword : false; ?>" name="keyword" placeholder="Nhập thông tin tìm kiếm..."">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getOrders as $key => $item): ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $item['firstname']; ?></td>
                <td><?php echo $item['lastname']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['phone']; ?></td>
                <td>$<?php echo $item['total']; ?></td>
                <td>
                    <?php
                    $statusMap = [0 => 'Chờ xử lý', 1 => 'Đang xử lý', 2 => 'Đã giao', 3 => 'Hủy'];
                    $statusClass = [0 => 'warning', 1 => 'info', 2 => 'success', 3 => 'danger'];
                    echo '<span class="badge bg-' . $statusClass[$item['status']] . '">' . $statusMap[$item['status']] . '</span>';
                    ?>
                </td>
                <td><?php echo $item['created_at']; ?></td>
                <td>
                    <a href="<?php echo _HOST_URL; ?>/admin/orders/detail?id=<?php echo $item['id']; ?>" class="btn btn-info btn-sm">Chi tiết
                    <a href="<?php echo _HOST_URL; ?>/admin/orders/deleteOrders?id=<?php echo $item['id'];?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!--Xử lý nút "Trước" -->
            <?php
            if ($page > 1):
            ?>
                <li class="page-item"><a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo ($page - 1); ?>">Trước</a></li>
            <?php endif; ?>

            <!--Tính vị trí bắt đầu 3-2=1  -->
            <?php
            $start = $page - 2;
            if ($start < 1) {
                $start = 1;
            }
            ?>
            <?php
            if ($start > 1):
            ?>
                <li class="page-item"><a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo $page + 1; ?>">...</a></li>
            <?php endif;
            $end = $page + 1;
            if ($end > $maxPage) {
                $end = $maxPage;
            }
            ?>
            <?php for ($i = $start; $i <= $end; $i++): ?>
                <li class="page-item <?php echo ($page == $i) ? 'active' : false; ?>"><a class="page-link"
                        href="?<?php echo $queryString; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            endfor;
            if ($end < $maxPage):
            ?>
                <li class="page-item"><a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo $page + 1; ?>">...</a></li>
            <?php endif; ?>

            <!--Xử lý nút "Sau" -->
            <?php
            if ($page < $maxPage):
            ?>
                <li class="page-item"><a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo $page + 1; ?>">Sau</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php layout('footer'); ?>