<?php
class AuthController extends BaseController
{
    //Xừ lý đăng nhập 
    private $coreModel;
    public function __construct()
    {
        $this->coreModel = new CoreModel();
    }
    public function showLogin()
    {
        $this->renderView('layouts-part/login');
    }

    public function login()
    {

        if (isPost()) {

            $filter = filterData();
            $errors = [];

            //Validate Email
            if (empty(trim($filter['email']))) {
                $errors['email']['required'] = 'Email bắt buộc phải nhập';
            } else {
                //Đúng định dạng email , email này đã tồn tại trong CSDL chưa 
                if (!validateEmail(trim($filter['email']))) {
                    $errors['email']['isEmail'] = 'Email không đúng định dạng';
                }
            }

            //Validate password mk > 6 kí tự
            if (empty(trim($filter['password']))) {
                $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập';
            } else {
                if (strlen(trim($filter['password'])) < 6) {
                    $errors['password']['length'] = 'Mật khẩu phải lớn hơn 6 kí tự';
                }
            }

            if (empty($errors)) {
                //Kiểm tra email
                $email = $filter['email'];
                $password = $filter['password'];

                $checkEmail = $this->coreModel->getOne("SELECT * FROM users WHERE email = '$email'");

                if (!empty($checkEmail)) {
                    if (!empty($password)) {
                        $checkStatus = password_verify($password, $checkEmail['password']);
                        if ($checkStatus) {
                            //Tài khoản chỉ login 1 nơi 
                            $user_id = $checkEmail['id'];
                            $checkAlready = $this->coreModel->getRows("SELECT * FROM token_login WHERE user_id = $user_id");
                            if (!empty($checkAlready)) {
                                setSessionFlash('msg', 'Tài khoản đang được đăng nhập ở một nơi khác , vui lòng thử lại sau.');
                                setSessionFlash('msg_type', 'danger');
                                redirect('/login');
                            } else {
                                //Tạo token và insert vào bảng token_login 
                                $token = sha1(uniqid() . time());
                                //Gán token và insert vào hàng token_login 
                                setSession('token_login', $token);
                                $data = [
                                    'token' => $token,
                                    'created_at' => date('Y:m:d H:i:s'),
                                    'user_id' => $checkEmail['id']
                                ];

                                $insertToken = $this->coreModel->insert('token_login', $data);
                                if ($insertToken) {
                                    redirect('/dashboard');
                                } else {
                                    setSessionFlash('msg', 'Đăng nhập không thành công.');
                                    setSessionFlash('msg_type', 'danger');
                                }
                            }
                        } else {
                            setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                            setSessionFlash('msg_type', 'danger');
                        }
                    }
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
            }

            redirect('/login');
        }
    }

    public function showRegister()
    {
        $this->renderView('layouts-part/register');
    }

    public function active()
    {
        $token = $_GET['token'] ?? '';

        if (!empty($token)) {
            // Tìm user có token này
            $checkToken = $this->coreModel->getOne("SELECT * FROM users WHERE active_token = '$token'");

            if (!empty($checkToken)) {
                // Cập nhật trạng thái active
                $data = ['status' => 1]; // loi cho nay ne
                $condition = "id = " . $checkToken['id'];
                $this->coreModel->update('users', $data, $condition);

                echo "Kích hoạt tài khoản thành công!";
            } else {
                echo "Đường link đã hết hạn.";
            }
        }

        $data = ['coreModel' => $this->coreModel];
        $this->renderView('layouts-part/active', $data);
    }

    public function register()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate fullname 
            if (empty(trim($filter['fullname']))) {
                $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập';
            } else {
                if (strlen(trim($filter['fullname'])) < 5) {
                    $errors['fullname']['length'] = 'Họ tên phải lớn hơn 5 kí tự';
                }
            }

            //Validate Email
            if (empty(trim($filter['email']))) {
                $errors['email']['required'] = 'Email bắt buộc phải nhập';
            } else {
                //Đúng định dạng email , email này đã tồn tại trong CSDL chưa 
                if (!validateEmail(trim($filter['email']))) {
                    $errors['email']['isEmail'] = 'Email không đúng định dạng';
                } else {
                    $email = $filter['email'];
                    $checkEmail = $this->coreModel->getRows("SELECT * FROM users WHERE email = '$email' ");
                    if (!empty($checkEmail)) {
                        $errors['email']['isEmail'] = 'Email của bạn đã bị trùng';
                    }
                }
            }

            //Validate phone
            if (empty($filter['phone'])) {
                $errors['phone']['required'] = 'Số điện thoại bắt buộc phải nhập';
            } else {
                if (!isPhone($filter['phone'])) {
                    $errors['phone']['isPhone'] = 'Số điện thoại không dúng định dạng';
                }
            }

            //Validate password mk > 6 kí tự
            if (empty($filter['password'])) {
                $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập';
            } else {
                if (strlen(trim($filter['password'])) < 6) {
                    $errors['password']['length'] = 'Mật khẩu phải lớn hơn 6 kí tự';
                }
            }

            //Validate confirm password
            if (empty($filter['password'])) {
                $errors['confirm_password']['required'] = 'Vui lòng nhập lại mật khẩu';
            } else {
                if (trim($filter['password']) !== trim($filter['confirm_password'])) {
                    $errors['confirm_password']['like'] = 'Mật khẩu nhập lại không khớp';
                }
            }

            if (empty($errors)) {
                //table:users,data
                $activeToken = sha1(uniqid() . time());

                $dataInsert = [
                    'fullname'    => $filter['fullname'],
                    'email'       => $filter['email'],
                    //'address'     =>$filter['address'],
                    'phone'       => $filter['phone'],
                    'password'    => password_hash($filter['password'], PASSWORD_DEFAULT),
                    'active_token' => $activeToken,
                    'created_at' => date('Y:m:d H:i:s')
                ];

                $insertStatus = $this->coreModel->insert('users', $dataInsert);

                if ($insertStatus) {
                    $emailTo = $filter['email'];
                    $subject = 'Kích hoạt tài khoản hệ thống';
                    $content = 'Chúc mừng bạn đã đăng ký thành công tài khoản. </br>';
                    $content .= 'Để kích hoạt tài khoản, bạn hãy click vào đường link bên dưới: </br>';
                    $content .= _HOST_URL . '/active?token=' . $activeToken . '</br>';

                    $content .= 'Cảm ơn các bạn đã ủng hộ!';
                    // Gửi email 
                    $rel = sendMail($emailTo, $subject, $content);


                    setSessionFlash('msg', 'Đăng ký thành công , vui lòng kích hoạt tài khoản.');
                    setSessionFlash('msg_type', 'success');
                } else {
                    setSessionFlash('msg', 'Đăng ký không thành công , vui lòng thử lại sau.');
                    setSessionFlash('msg_type', 'danger');
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
            }
            redirect('/register');
        }
    }

    public function showForgot()
    {
        $this->renderView('layouts-part/forgot');
    }

    public function forgot()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            //Validate Email
            if (empty(trim($filter['email']))) {
                $errors['email']['required'] = 'Email bắt buộc phải nhập';
            } else {
                //Đúng định dạng email , email này đã tồn tại trong CSDL chưa 
                if (!validateEmail(trim($filter['email']))) {
                    $errors['email']['isEmail'] = 'Email không đúng định dạng';
                }
            }

            if (empty($errors)) {
                //Xử lý và gửi mail
                if (!empty($filter['email'])) {
                    $email = $filter['email'];
                    $checkEmail = $this->coreModel->getOne("SELECT * FROM users WHERE email = '$email'");
                    if (!empty($checkEmail)) {
                        //update forgot_token vào bảng users
                        $forgot_token = sha1(uniqid() . time());
                        $data = [
                            'forgot_token' => $forgot_token
                        ];
                        $condition = "id=" . $checkEmail['id'];
                        $updateStatus = $this->coreModel->update('users', $data, $condition);
                        if ($updateStatus) {
                            $emailTo = $email;
                            $subject = 'Reset mật khẩu tài khoản hệ thống.';
                            $content = 'Bạn đang yêu cầu reset lại mật khẩu. </br>';
                            $content .= 'Để thay đổi mật khẩu tài khoản, bạn hãy click vào đường link bên dưới: </br>';
                            $content .= _HOST_URL . '/reset?token=' . $forgot_token . '</br>';
                            $content .= 'Cảm ơn các bạn đã ủng hộ!';
                            // Gửi email 
                            sendMail($emailTo, $subject, $content);

                            setSessionFlash('msg', 'Gửi yêu cầu thành công , vui lòng kiểm tra email.');
                            setSessionFlash('msg_type', 'success');
                        } else {
                            setSessionFlash('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu nhập vào.');
                            setSessionFlash('msg_type', 'danger');
                        }
                    }
                }
            } else {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('oldData', $filter);
                setSessionFlash('errors', $errors);
            }
            redirect('/forgot');
        }
    }

    public function showReset()
    {
        $this->renderView('layouts-part/reset');
    }

    public function reset()
    {
        $filterGet = filterData('get');

        if (!empty($filterGet['token'])) {
            $tokenReset = $filterGet['token'];
        }
        
        if (!empty($tokenReset)) {
            //Check token có chính xác hay không
            $checkToken = $this->coreModel->getOne("SELECT * FROM users WHERE forgot_token = '$tokenReset'");
           
            if (!empty($checkToken)) {
                if (isPost()) {
                    
                    $filter = filterData();
                    $errors = [];
                    //Validate password mk > 6 kí tự
                    if (empty(trim($filter['password']))) {
                        $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập';
                    } else {
                        if (strlen(trim($filter['password'])) < 6) {
                            $errors['password']['length'] = 'Mật khẩu phải lớn hơn 6 kí tự';
                        }
                    }

                    //Validate confirm password
                    if (empty($filter['password'])) {
                        $errors['confirm_password']['required'] = 'Vui lòng nhập lại mật khẩu';
                    } else {
                        if (trim($filter['password']) !== trim($filter['confirm_password'])) {
                            $errors['confirm_password']['like'] = 'Mật khẩu nhập lại không khớp';
                        }
                    }

                    if (empty($errors)) {
                        $password = password_hash($filter['password'], PASSWORD_DEFAULT);
                        
                        
                        $data = [
                            'password' => $password,
                            // 'forgot_token' => null,
                            'updated_at' => date('Y:m:d H:i:s')
                        ];

                        $condition = "id=" . $checkToken['id'];
                        $updateStatus = $this->coreModel->update('users', $data, $condition);

                        if ($updateStatus) {
                            //Gửi mail
                            $emailTo = $checkToken['email'];
                            $subject = 'Đổi mật khẩu thành công!';
                            $content = 'Chúc mừng bạn đã đổi mật khẩu thành công trên hệ thống! </br>';
                            $content .= 'Nếu không phải bạn thao tác mật khẩu thì hãy liên hệ với admin. </br>';
                            $content .= 'Cảm ơn các bạn đã ủng hộ!';
                            // Gửi email 
                            sendMail($emailTo, $subject, $content);

                            setSessionFlash('msg', 'Đổi mật khẩu thành công!');
                            setSessionFlash('msg_type', 'success');
                        } else {
                            setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                            setSessionFlash('msg_type', 'danger');
                        }
                        redirect('/login');

                    } else {
                        setSessionFlash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào.');
                        setSessionFlash('msg_type', 'danger');
                        setSessionFlash('oldData', $filter);
                        setSessionFlash('errors', $errors);
                    }
                }
            }else{
                echo "Không tồn tại yêu cầu nào trong DB";
            }
        }else{
            echo "Không tồn tại yêu cầu nào trong DB";
        }
    }

    public function logout()
    {
        $token = getSession('token_login');

        if (!empty($token)) {
            $this->coreModel->delete('token_login', "token = '$token'");
        }

        setSession('token_login', null);
        setcookie('token_login', '', time() - 3600, '/');
        
        redirect('/login');
        exit();
    }
}
