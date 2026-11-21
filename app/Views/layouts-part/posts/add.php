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
    <h2>Thêm mới bài viết</h2>
    <hr>
    <?php
    if (!empty($msg) && !empty($msg_type)) {
        getMsg($msg, $msg_type);
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6 pb-3">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php if (!empty($oldData)) {
                                                                                            echo oldData($oldData, 'title');
                                                                                        }; ?>" placeholder="Tiêu đề">
                <?php
                if (!empty($errorsArr)) {
                    echo formError($errorsArr, 'title');
                }
                ?>
            </div>
            <div class="col-6 pb-3">
                <label for="content">Nội dung bài viết</label>
                <input type="text" name="content" class="form-control" id="content" value="<?php if (!empty($oldData)) {
                                                                                                echo oldData($oldData, 'content');
                                                                                            }; ?>" placeholder="Nội dung">
                <?php
                if (!empty($errorsArr)) {
                    echo formError($errorsArr, 'content');
                }
                ?>
            </div>
            <div class="col-12 pb-3">
                <label for="category_id">Danh mục</label>
                <select class="form-select" name="category_id">
                <?php 
                foreach ($getCategory as $key => $item):    
                ?>
                    <option value="<?php echo $item['id']; ?>"><?php echo $item['title']; ?></option>
                <?php 
                endforeach;
                ?>
                </select>
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