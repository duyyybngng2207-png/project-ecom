
<?php

/**
 * @var array $product
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $review
 * @var array $listProducts
 * @var array $getProduct
 * @var array $page
 * @var array $queryString
 * @var array $maxPage
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
<div class="container add-user">
    <h2>Thêm mới sản phẩm</h2>
    <hr>
    <?php
    if (!empty($msg) && !empty($msg_type)) {
        getMsg($msg, $msg_type);
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6 pb-3">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" id="name" 
                    value="<?php if (!empty($oldData)) echo oldData($oldData, 'name'); ?>" 
                    placeholder="Tên">
                <?php if (!empty($errorsArr)) echo formError($errorsArr, 'name'); ?>
            </div>

            <div class="col-6 pb-3">
                <label for="price">Giá sản phẩm</label>
                <input type="text" name="price" class="form-control" id="price" 
                    value="<?php if (!empty($oldData)) echo oldData($oldData, 'price'); ?>" 
                    placeholder="Giá(VND)">
                <?php if (!empty($errorsArr)) echo formError($errorsArr, 'price'); ?>
            </div>

            <div class="col-6 pb-3">
                <label for="image">Ảnh</label>
                <input type="file" name="image" class="form-control" id="image" >
                <img id="previewImage" src="" style="display:none; width:100px; margin-top:10px;">
                <?php if (!empty($oldData)) { echo oldData($oldData, 'image'); } ?>
                
                <?php if (!empty($product['image'])): ?>
                    <img src="/public/img/product_<?php echo $product['id']; ?>.jpg" 
                        style="width: 100px; margin-top: 10px;">
                <?php endif; ?>
                <?php if (!empty($errorsArr)) { echo formError($errorsArr, 'image'); } ?>
            </div>
            <div class="col-6 pb-3">
                <label for="category_id">Danh mục</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($getCategory as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" 
                        <?php echo (!empty($filter['category_id']) && $filter['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                        <?php echo $cat['title']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 pb-3">
                <label for="content">Nội dung sản phẩm</label>
                <textarea class="content" name="content" id="content">
                    <?php 
                    if (!empty($oldData)) { 
                        echo oldData($oldData, 'content');
                    } elseif (!empty($product)) { 
                        echo htmlspecialchars($product['content'] ?? '');
                    }
                    ?>
                </textarea>
                <?php if (!empty($errorsArr)) { echo formError($errorsArr, 'content'); } ?>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Xác nhận</button>
    </form>
</div>

<script>
    const thumbnailInput = document.getElementById('image');
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
</script>

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