<?php
// Kiểm tra xem active_token ở url có giống active_token trong csdl (users)
// Update trường status trong bảng users -> 1(đã kích hoạt) + xóa active token đi.

if (!defined('_HIENU')) {
    die('Truy cập không hợp lệ');
}
$data = [
    'title' => 'Kích hoạt tài khoản'
];
layout('header-auth', $data);

$filter = filterData('get');

// Xử lý đường link hợp lệ 
if (!empty($filter['token'])):
    $token = $filter['token'];
    $checkToken = $coreModel->getOne("SELECT * FROM users WHERE active_token = '$token'");
    
?>

    <section class="vh-100" style="padding-top: 100px;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="/public/img/banner.jpg"
                        class="img-fluid" alt="Sample image">
                </div>
                <?php if (!empty($checkToken)):
                    //Thực hiện update dữ liệu 
                    $data = [
                        'status' => 1,
                        'active_token' => null,
                        'updated_at' => date('Y:m:d H:i:s')
                    ];
                    $condition = "id = " . $checkToken['id'];
                    $coreModel->update('users', $data, $condition);
                    
                ?>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <h2 class=" fw-normal mb-5 me-3">Kích hoạt tài khoản thành công</h2>
                        </div>
                        <a href="<?php echo _HOST_URL ;?>/login"
                            class="link-danger" style="font-size:20px; text-decoration:none;">Đăng nhập ngay
                        </a>
                    </div>
                <?php else: ?>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <h2 class=" fw-normal mb-5 me-3">Kích hoạt tài khoản không thành công.Đường link đã hết hạn.</h2>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <!-- Đường link sai , không hợp lệ -->

    <sec class="row d-flex justify-content-center align-items-center h-100">
        <dtion class="vh-100">
            <div class="container-fluid h-custom">
                <diviv class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <h2 class=" fw-normal mb-5 me-3">Đường link kích hoạt đã hết hạn hoặc không tồn tại</h2>
                </div>
                <a href="/login"
                    class="link-danger" style="font-size:20px; text-decoration:none;">Quay lại trang chủ
                </a>
            </div>
            </div>
            </div>
            </section>

        <?php endif; ?>

        <?php
        layout('footer');

        if ($a < 1):
        // viết code html 
        endif;
        if ($a < 10) {
        }
