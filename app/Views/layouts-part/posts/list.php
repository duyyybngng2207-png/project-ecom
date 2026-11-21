<?php
if(!defined('_HIENU')){
    die('Truy cập không hợp lệ');
}
// ?module=users$action=list&group=9&keyword=Bằng
// Phân trang: Trước ....5,'6',7.....Sau
// '1' ,2,3 ... Sau -> Trước 1,'2',3,4...Sau
//Perpage,Max page ,offset 
$data = [
    'title' => 'Danh sách khóa học'
];
layout('header', $data);
layout('sidebar');

// echo '<pre>';
// print_r($getCourse);
// echo '</pre>';


$msg = getSessionFlash('msg');
$msg_type = getSessionFlash(('msg_type'));

?>

<div class="container grid-user">
    <div class="container-fluid">
        <a href="<?php echo _HOST_URL; ?>/admin/posts/add" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i>Thêm mới bài viết</a>
        <?php
            if (!empty($msg) && !empty($msg_type)) {
                getMsg($msg, $msg_type);
            }
            ?>
        <form class="mb-3" action="" method="get">
            <input type="hidden" name="module" value="course">
            <input type="hidden" name="action" value="list">
                <div class="col-7">
                    <input class="form-control" type="text" value="<?php echo (!empty($keyword)) ? $keyword : false; ?>" name="keyword" placeholder="Nhập thông tin tìm kiếm...">
                </div>
                <div class="col-2"><button class="btn btn-primary" type="submit">Tìm kiếm</button></div>
            </div>
        </form>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ngày viết</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($getCourse as $key => $item):
                ?>
                    <tr>
                        <th scope="row"><?php echo $key + 1; ?></th>
                        <td><?php echo $item['title']; ?></td>
                        <td><?php echo $item['content']; ?></td>
                        <td><?php echo $item['created_at']; ?></td>
                        <td><a href="<?php echo _HOST_URL; ?>/admin/posts/edit?id=<?php echo $item['id']; ?>" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button></td>
                        <td><a href="<?php echo _HOST_URL; ?>/admin/posts/delete?id=<?php echo $item['id'];?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>
                <?php
                endforeach;
                ?>

            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!--Xử lý nút "Trước" -->
                <?php
                if ($page > 1):
                ?>
                    <li class="page-item"><a class="page-link" href="?<?php echo $queryString; ?>&page=<?php echo $page - 1; ?>">Trước</a></li>
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
</div>

<?php
layout('footer');
?>