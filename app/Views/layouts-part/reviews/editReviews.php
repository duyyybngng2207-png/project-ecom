<?php
if (!defined('_HIENU')) {
    die('Truy cập không hợp lệ');
}

$data = [
    'title' => 'Danh sách nội dung đánh giá'
];

layout('header', $data);
layout('sidebar');

$msg = getSessionFlash('msg');
$msg_type = getSessionFlash(('msg_type'));
$oldData = getSessionFlash('oldData');
$errorsArr = getSessionFlash('errors');
?>
<div class="container add-user">
    <h2>Chỉnh sửa nội dung đánh giá </h2>
    <hr>
    <?php
    if (!empty($msg) && !empty($msg_type)) {
        getMsg($msg, $msg_type);
    }
    ?>
    <form action="/admin/reviews/editReviews" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idReviews" value="<?php echo $idReview; ?>">
        <input type="hidden" name="product_id" value="<?php echo $review['product_id']; ?>">
        <div class="row">
            <div class="col-12 pb-3">
                <label for="title">Tên người dùng</label>
                <input type="text" name="name" class="form-control" id="name" 
                value="<?php if (!empty($oldData)) {
                echo oldData($oldData, 'name');
                } elseif (!empty($review)) { echo htmlspecialchars($review['name'] ?? ''); }; ?>" 
                placeholder="Tên người dùng ">
                <?php
                if (!empty($errorsArr)) {
                    echo formError($errorsArr, 'name');
                }
                ?>
            </div>
            <div class="col-12 pb-3">
                <label for="content">Nội dung sản phẩm</label>
                <textarea class="content" name="content" id="content">
                    <?php 
                    if (!empty($oldData)) { 
                        echo oldData($oldData, 'content');
                    } elseif (!empty($review)) { 
                        echo ($review['content'] ?? '');
                    }
                    ?>
                </textarea>
                <?php if (!empty($errorsArr)) { echo formError($errorsArr, 'content'); } ?>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Xác nhận</button>
    </form>
</div>

<!-- <script>
    const thumbnailInput = document.getElementById('thumbnail');
    const previewImg = document.getElementById('previewImage');

    thumbnailInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewImg.style.display = 'none';
        }
    });
</script> -->

<!-- <script>
    // //Hàm giúp chuyển text thành slug 
    // function createSlug(str) {
    //     return str.toLowerCase()
    //         .normalize('NFD')
    //         .replace(/[\u0300-\u036f]/g, '')
    //         .replace(/đ/g, 'd')
    //         .replace(/[^a-z0-9\s-]/g, '')
    //         .trim()
    //         .replace(/\s+/g, '-')
    //         .replace(/-+/g, '-');
    // }

    // document.getElementById('title').addEventListener('input', function() {
    //     const getValue = this.value;
    //     document.getElementById('slug').value = createSlug(getValue);
    // });
</script> -->


<?php
layout('footer');
?>