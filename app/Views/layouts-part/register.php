<?php
if (!defined('_HIENU')) {
  die('Truy cập không hợp lệ');
}
$data = [
  'title' => 'Đăng ký tài khoản'
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
        <form method="POST" , action="/register" ,enctype="multipart/form-data">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <h2 class=" fw-normal mb-5 me-3">Đăng ký tài khoản</h2>

          </div>
          <!-- Name, email, sdt, mật khẩu, nhập lại mật khẩu -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input name="fullname" type="text" value="<?php if (!empty($oldData)) {
                                                        echo oldData($oldData, 'fullname');
                                                      }; ?>" class="form-control form-control-lg"
              placeholder="Họ tên" />
            <?php
            if (!empty($errorsArr)) {
              echo formError($errorsArr, 'fullname');
            }
            ?>
          </div>
          <!-- Nhập email -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input name="email" type="email" value="<?php if (!empty($oldData)) {
                                                        echo oldData($oldData, 'email');
                                                      }; ?>" class="form-control form-control-lg"
              placeholder="Địa chỉ email" />
            <?php echo formError($errorsArr, 'email'); ?>
          </div>

          <!-- Nhập số điện thoại-->
          <div data-mdb-input-init class="form-outline mb-4">
            <input name="phone" type="text" value="<?php if (!empty($oldData)) {
                                                        echo oldData($oldData, 'phone');
                                                      }; ?>" class="form-control form-control-lg"
              placeholder="Nhập số điện thoại" />
            <?php echo formError($errorsArr, 'phone'); ?>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input name="password" type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Nhập mật khẩu" />
            <?php echo formError($errorsArr, 'password'); ?>
          </div>

          <!-- Nhập lại mật khẩu -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input name="confirm_password" type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Nhập lại mật khẩu" />
            <?php echo formError($errorsArr, 'confirm_password'); ?>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng ký</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Bạn đã có tài khoản? <a href="/login"
                class="link-danger">Đăng nhập ngay</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>

</section>
<?php
layout('footer');
