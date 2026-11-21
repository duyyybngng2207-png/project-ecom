<?php

/**
 * @var array $product
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $review
 * @var array $listPosts
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
    'title' => 'Danh sách nội dung bình luận'
];

layout('header', $data);
layout('sidebar');

$msg = getSessionFlash('msg');
$msg_type = getSessionFlash(('msg_type'));
$oldData = getSessionFlash('oldData');
$errorsArr = getSessionFlash('errors');
?>
<div class="container add-user">
    <h2>Chỉnh sửa nội dung bình luận</h2>
    <hr>
    <?php
    if (!empty($msg) && !empty($msg_type)) {
        getMsg($msg, $msg_type);
    }
    ?>
    <form action="/admin/comments/editComments" method="post" enctype="multipart/form-data">
        <input type ="hidden" name="idComments" value="<?php echo $idComment; ?>">
        <div class="row">
            <div class="col-12 pb-3">
                <label for="title">Tên người dùng</label>
                <input type="text" name="fullname" class="form-control" id="fullname" 
                    value="<?php if (!empty($oldData)) { 
                        echo oldData($oldData, 'fullname');
                    } elseif (!empty($comment)) { 
                        echo htmlspecialchars($comment['fullname'] ?? '');
                    }; ?>" 
                    placeholder="Tên người dùng">
                <?php if (!empty($errorsArr)) { echo formError($errorsArr, 'fullname'); } ?>
            </div>
            <div class="col-12 pb-3">
                <label for="post_id">Bài viết</label>
                <select name="post_id" class="form-control">
                    <option value="">-- Chọn bài viết --</option>
                    <?php foreach ($listPosts as $post): ?>
                    <option value="<?php echo $post['id']; ?>"
                        <?php echo (!empty($oldData['post_id']) && $oldData['post_id'] == $post['id']) ? 'selected' : ''; ?>>
                        <?php echo $post['title']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errorsArr)) echo formError($errorsArr, 'post_id'); ?>
            </div>
            <div class="col-12 pb-3">
                <label for="content">Nội dung bình luận</label>
                <textarea class="content" name="content" id="content">
                    <?php 
                    if (!empty($oldData)) { 
                        echo oldData($oldData, 'content');
                    } elseif (!empty($comment)) { 
                        echo htmlspecialchars($comment['content'] ?? '');
                    }
                    ?>
                </textarea>
                <?php if (!empty($errorsArr)) { echo formError($errorsArr, 'content'); } ?>
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