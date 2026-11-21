<?php
/*
Validate dữ liệu nhập vào 
Check dữ liệu với csdl (email và pass)
Dữ liệu khớp -> token login -> insert vào bảng token_login (kiểm tra đăng nhập)
Kiểm tra đăng nhập:
  Gán token_login lên session
  Trong header -> Lấy token từ session về và so khớp với token trong bảng token_login  
  nếu khớp thì điều hướng trang đích (không khớp điều hướng về login)
Điều hướng dẫn trang dashboard 
Đăng nhập tài khoản ở 1 nơi tại 1 thời điểm
*/
if (!defined('_HIENU')) {
  die('Truy cập không hợp lệ');
}
$data = [
  'title' => 'Đăng nhập hệ thống'
];
layout('header-auth', $data);



$msg = getSessionFlash('msg');
$msg_type = getSessionFlash(('msg_type'));
$oldData = getSessionFlash('oldData');
$errorsArr = getSessionFlash('errors');


?>


<section class="vh-100" style="padding-top: 200px;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="/public/img/banner.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <?php
        if (!empty($msg) && !empty($msg_type)) {
          getMsg($msg, $msg_type);
        }
        ?>
        <form method="POST" , action="<?php echo _HOST_URL; ?>/login" ,enctype="multipart/form-data">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <h2 class=" fw-normal mb-5 me-3">Đăng nhập hệ thống</h2>
          </div>
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" name="email" value="
            <?php
            if (!empty($oldData)) {
              echo oldData($oldData, 'email');
            }
            ?>
            
            " id="form3Example3" class="form-control form-control-lg"
              placeholder="Địa chỉ email" />
            <?php if (!empty($errorsArr)) echo formError($errorsArr, 'email'); ?>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Nhập mật khẩu" />
            <?php
            if (!empty($errorsArr)) {
              echo formError($errorsArr, 'password');
            }
            ?>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->

            <a href="<?php echo _HOST_URL; ?>/forgot" class="text-body">Quên mật khẩu?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng nhập</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Bạn chưa có tài khoản? <a href="<?php echo _HOST_URL; ?>/register"
                class="link-danger">Đăng kí ngay</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>

</section>
<?php
layout('footer');
