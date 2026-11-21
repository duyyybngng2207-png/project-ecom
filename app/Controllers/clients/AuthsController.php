<?php
class AuthsController extends BaseController
{
    private $coreModel;
    private $usersModel;
    public function __construct()
    {
        $this->coreModel = new CoreModel();
        $this->usersModel = new Users();
    }

    public function showLogin()
    {
        $this->renderView('layouts-part/login');
    }

    public function pageLogin()
    {
        if (isPost()) {
            // Kiểm tra đã đăng nhập chưa
            // if (!empty(getSession('token_login'))) {
            //     echo json_encode([
            //         'status'  => 'danger',
            //         'message' => 'You are already logged in. Please log out first.'
            //     ]);
            //     return;
            //}

            $filter = filterData();
            $errors = [];

            if (empty(trim($filter['email']))) {
                $errors['email']['required'] = 'Email address is required.';
            } else {
                if (!validateEmail(trim($filter['email']))) {
                    $errors['email']['isEmail'] = 'Email is not in the correct format.';
                }
            }

            if (empty(trim($filter['password']))) {
                $errors['password']['required'] = 'Password must be entered.';
            } else {
                if (strlen(trim($filter['password'])) < 6) {
                    $errors['password']['length'] = 'The password must be longer than 6 characters.';
                }
            }

            if (empty($errors)) {
                $email    = $filter['email'];
                $password = $filter['password'];

                $checkEmail = $this->coreModel->getOne("SELECT * FROM users WHERE email = '$email'");

                if (!empty($checkEmail)) {
                    $checkStatus = password_verify($password, $checkEmail['password']);    

                    if ($checkStatus) {
                        $user_id      = $checkEmail['id'];
                        $checkAlready = $this->coreModel->getRows("SELECT * FROM token_login WHERE user_id = $user_id");
                        dd($checkAlready);

                        if (!empty($checkAlready)) {
                            echo json_encode([
                                'status'  => 'danger',
                                'message' => 'The account is currently logged in from elsewhere.'
                            ]);
                        } else {
                            $token = sha1(uniqid() . time());
                            setSession('token_login', $token);

                            $data = [
                                'token'      => $token,
                                'created_at' => date('Y:m:d H:i:s'),
                                'user_id'    => $checkEmail['id']
                            ];

                            $insertToken = $this->coreModel->insert('token_login', $data);

                            if ($insertToken) {
                                echo json_encode([
                                    'status'   => 'success',
                                    'message'  => 'Login successfully!',
                                ]);

                                setcookie("userId", "$user_id");
                            } else {
                                echo json_encode([
                                    'status'  => 'danger',
                                    'message' => 'Login failed. Please try again.'
                                ]);
                            }
                        }
                    } else {
                        echo json_encode([
                            'status'  => 'danger',
                            'message' => 'Invalid email or password.'
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status'  => 'danger',
                        'message' => 'Email not found.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => $errors
                ]);
            }

        } else {
            $data['main_content'] = $this->renderViewHtml('layouts/home/page-login', []);
            $this->renderViewLayout($data);
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
                $data = ['status' => 1]; 
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

    public function pageRegister()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            if (empty(trim($filter['fullname']))) {
                $errors['fullname']['required'] = 'Full name is required.';
            } else {
                if (strlen(trim($filter['fullname'])) < 5) {
                    $errors['fullname']['length'] = 'Full name must be more than 5 characters long.';
                }
            }

            if (empty(trim($filter['email']))) {
                $errors['email']['required'] = 'Email address is required.';
            } else {
                if (!validateEmail(trim($filter['email']))) {
                    $errors['email']['isEmail'] = 'Email is not in the correct format.';
                } else {
                    $email = $filter['email'];
                    $checkEmail = $this->coreModel->getRows("SELECT * FROM users WHERE email = '$email'");
                    if (!empty($checkEmail)) {
                        $errors['email']['isEmail'] = 'Your email address is already taken.';
                    }
                }
            }

            if (empty($filter['phone'])) {
                $errors['phone']['required'] = 'The phone number must be entered.';
            } else {
                if (!isPhone($filter['phone'])) {
                    $errors['phone']['isPhone'] = 'The phone number is not in the correct format.';
                }
            }

            if (empty($filter['password'])) {
                $errors['password']['required'] = 'Password must be entered.';
            } else {
                if (strlen(trim($filter['password'])) < 6) {
                    $errors['password']['length'] = 'The password must be longer than 6 characters.';
                }
            }

            if (empty($filter['confirm_password'])) {
                $errors['confirm_password']['required'] = 'Please re-enter your password.';
            } else {
                if (trim($filter['password']) !== trim($filter['confirm_password'])) {
                    $errors['confirm_password']['like'] = 'The re-entered password does not match.';
                }
            }

            if (empty($errors)) {
                $activeToken = sha1(uniqid() . time());
                $dataInsert  = [
                    'fullname'     => $filter['fullname'],
                    'email'        => $filter['email'],
                    'phone'        => $filter['phone'],
                    'password'     => password_hash($filter['password'], PASSWORD_DEFAULT),
                    'active_token' => $activeToken,
                    'created_at'   => date('Y:m:d H:i:s')
                ];

                $insertStatus = $this->coreModel->insert('users', $dataInsert);

                if ($insertStatus) {
                    echo json_encode([
                        'status'  => 'success',
                        'message' => 'Registration successful! Please check your email to activate your account.'
                    ]);
                } else {
                    echo json_encode([
                        'status'  => 'danger',
                        'message' => 'Registration failed, please try again later.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => $errors
                ]);
            }

        } else {
            $data['main_content'] = $this->renderViewHtml('layouts/home/page-register', []);
            $this->renderViewLayout($data);
        }
    }

    public function pageForgot()
    {
        if (isPost()) {
            $filter = filterData();
            $errors = [];

            if (empty(trim($filter['email']))) {
                $errors['email']['required'] = 'Email address is required.';
            } else {
                if (!validateEmail(trim($filter['email']))) {
                    $errors['email']['isEmail'] = 'Email is not in the correct format.';
                }
            }

            if (empty($errors)) {
                $email      = $filter['email'];
                $checkEmail = $this->coreModel->getOne("SELECT * FROM users WHERE email = '$email'");

                if (!empty($checkEmail)) {
                    $forgot_token = sha1(uniqid() . time());
                    $data         = ['forgot_token' => $forgot_token];
                    $condition    = "id=" . $checkEmail['id'];
                    $updateStatus = $this->coreModel->update('users', $data, $condition);

                    if ($updateStatus) {
                        $emailTo  = $email;
                        $subject  = 'Reset mật khẩu tài khoản hệ thống.';
                        $content  = 'Bạn đang yêu cầu reset lại mật khẩu. </br>';
                        $content .= 'Để thay đổi mật khẩu tài khoản, bạn hãy click vào đường link bên dưới: </br>';
                        $content .= _HOST_URL . '/page-reset?token=' . $forgot_token . '</br>';
                        $content .= 'Cảm ơn các bạn đã ủng hộ!';
                        ob_start();
                        sendMail($emailTo, $subject, $content);
                        ob_end_clean();

                        echo json_encode([
                            'status'  => 'success',
                            'message' => 'Request sent successfully, please check your email.'
                        ]);
                    } else {
                        echo json_encode([
                            'status'  => 'danger',
                            'message' => 'An error occurred, please try again.'
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status'  => 'danger',
                        'message' => 'Email not found.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => $errors
                ]);
            }

        } else {
            $data['main_content'] = $this->renderViewHtml('layouts/home/page-forgot', []);
            $this->renderViewLayout($data);
        }
    }

    public function pageReset()
    {
        $filterGet = filterData('get');
        $tokenReset = $filterGet['token'] ?? '';

        if (isPost()) {
            if (empty($tokenReset)) {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Invalid reset token.'
                ]);
                return;
            }

            $checkToken = $this->coreModel->getOne("SELECT * FROM users WHERE forgot_token = '$tokenReset'");

            if (empty($checkToken)) {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => 'Reset request not found.'
                ]);
                return;
            }

            $filter = filterData();
            $errors = [];

            if (empty(trim($filter['password']))) {
                $errors['password']['required'] = 'Password must be entered.';
            } else {
                if (strlen(trim($filter['password'])) < 6) {
                    $errors['password']['length'] = 'The password must be longer than 6 characters.';
                }
            }

            if (empty($filter['confirm_password'])) {
                $errors['confirm_password']['required'] = 'Please re-enter your password.';
            } else {
                if (trim($filter['password']) !== trim($filter['confirm_password'])) {
                    $errors['confirm_password']['like'] = 'Passwords do not match.';
                }
            }

            if (empty($errors)) {
                $data = [
                    'password'     => password_hash($filter['password'], PASSWORD_DEFAULT),
                    'forgot_token' => null,
                    'updated_at'   => date('Y:m:d H:i:s')
                ];

                $condition    = "id=" . $checkToken['id'];
                $updateStatus = $this->coreModel->update('users', $data, $condition);

                if ($updateStatus) {
                    $emailTo  = $checkToken['email'];
                    $subject  = 'Đổi mật khẩu thành công!';
                    $content  = 'Chúc mừng bạn đã đổi mật khẩu thành công! </br>';
                    $content .= 'Nếu không phải bạn thao tác thì hãy liên hệ với admin. </br>';
                    $content .= 'Cảm ơn các bạn đã ủng hộ!';
                    ob_start();
                    sendMail($emailTo, $subject, $content);
                    ob_end_clean();

                    echo json_encode([
                        'status'  => 'success',
                        'message' => 'Password reset successfully!'
                    ]);
                } else {
                    echo json_encode([
                        'status'  => 'danger',
                        'message' => 'Please check your data again.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status'  => 'danger',
                    'message' => $errors
                ]);
            }

        } else {
            if (empty($tokenReset)) {
                redirect('/page-login');
                return;
            }

            $checkToken = $this->coreModel->getOne("SELECT * FROM users WHERE forgot_token = '$tokenReset'");
            if (empty($checkToken)) {
                redirect('/page-reset');
                return;
            }

            $data['main_content'] = $this->renderViewHtml('layouts/home/page-reset', []);
            $this->renderViewLayout($data);
        }
    }

    public function pageLogout()
    {
        $token = getSession('token_login');

        if (!empty($token)) {
            $this->coreModel->delete('token_login', "token = '$token'");
        }

        setSession('token_login', null);
        setcookie('token_login', '', time() - 3600, '/');
        redirect('/page-login');
        return;
    }

   public function pageAccount()
    {
        if (empty(getSession('token_login'))) {
            redirect('/page-login');
            return;
        }

        $token    = getSession('token_login');
        $tokenRow = $this->coreModel->getOne("SELECT * FROM token_login WHERE token = '$token'");
        $user     = $this->coreModel->getOne("SELECT * FROM users WHERE id = {$tokenRow['user_id']}");

        $wishlist = $this->usersModel->getListWishlist($tokenRow['user_id']);
        //dd($wishlist);
        $data = [
            'user' => $user,
            'wishlist' => $wishlist
        ];

        $data['main_content'] = $this->renderViewHtml('layouts/home/page-account', $data);
        $this->renderViewLayout($data);
    }
}