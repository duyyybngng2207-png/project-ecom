<?php
if (!defined('_HIENU')) {
    die('Truy cập không hợp lệ');
}

$data = ['title' => 'Thêm mới mã giảm giá'];
layout('header', $data);
layout('sidebar');

$msg      = getSessionFlash('msg');
$msg_type = getSessionFlash('msg_type');
$oldData  = getSessionFlash('oldData');
$errorsArr = getSessionFlash('errors');
?>

<div class="container">
    <h2>Thêm mới mã giảm giá</h2>
    <hr>
    <?php if (!empty($msg)) getMsg($msg, $msg_type); ?>

    <form action="/admin/coupons/addCoupons" method="POST">
        <div class="row">
            <div class="col-6 pb-3">
                <label>Tên mã giảm giá</label>
                <input type="text" name="title" class="form-control"
                    value="<?php echo !empty($oldData) ? oldData($oldData, 'title') : ''; ?>"
                    placeholder="Tên mã giảm giá">
                <?php if (!empty($errorsArr)) echo formError($errorsArr, 'title'); ?>
            </div>

            <div class="col-6 pb-3">
                <label>Mã code</label>
                <div class="d-flex">
                    <input type="text" name="code" class="form-control" id="code"
                        value="" placeholder="Mã code">
                    <button type="button" class="btn btn-success" id="btn-generate">Tạo ngẫu nhiên</button>
                </div>
                <?php if (!empty($errorsArr)) echo formError($errorsArr, 'code'); ?>
            </div>
            <div class="col-6 pb-3">
                <label>Loại giảm giá</label>
                <select name="discount_type" class="form-control">
                    <option value="1">Giảm theo %</option>
                    <option value="2">Giảm theo giá tiền</option>
                </select>
            </div>

            <div class="col-6 pb-3">
                <label>Giá trị giảm</label>
                <input type="number" name="discount_price" class="form-control" min="1" max="100"
                    value="<?php echo !empty($oldData) ? oldData($oldData, 'discount_price') : ''; ?>"
                    placeholder="Ví dụ: 10">
                <?php if (!empty($errorsArr)) echo formError($errorsArr, 'discount_price'); ?>
            </div>


            <div class="col-6 pb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="0" <?php echo (!empty($oldData) && oldData($oldData, 'status') == 0) ? 'selected' : ''; ?>>Chưa phát hành</option>
                    <option value="1" <?php echo (!empty($oldData) && oldData($oldData, 'status') == 1) ? 'selected' : ''; ?>>Chưa sử dụng</option>
                    <option value="2" <?php echo (!empty($oldData) && oldData($oldData, 'status') == 2) ? 'selected' : ''; ?>>Đã sử dụng</option>
                    <option value="3" <?php echo (!empty($oldData) && oldData($oldData, 'status') == 3) ? 'selected' : ''; ?>>Hết hạn</option>
                </select>
            </div>

            <div class="col-6 pb-3">
                <label>Ngày hết hạn</label>
                <input type="date" name="expired" class="form-control"
                    value="<?php echo !empty($oldData) ? oldData($oldData, 'expired') : ''; ?>">
                    <?php if (!empty($errorsArr)) echo formError($errorsArr, 'expired'); ?>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Xác nhận</button>
        <a href="/admin/coupons" class="btn btn-secondary">Quay lại</a>
    </form>
</div>


<?php layout('footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#btn-generate').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'ajax_random_code',
                type: 'POST',
                dataType: 'json',
            }).done(function (response) {
                $('#code').val(response.code);
                $('#code').text(response.code);
            });
        });
    });

    $('select[name="discount_type"]').change(function() {
    if ($(this).val() == 1) {
        $('input[name="discount_price"]').attr('placeholder', 'Ví dụ: 10 (%)');
        $('label[for="discount_price"]').text('Giá trị giảm (%)');
    } else {
        $('input[name="discount_price"]').attr('placeholder', 'Ví dụ: 15 (USD)');
        $('label[for="discount_price"]').text('Giá trị giảm (VNĐ)');
    }
});
</script>