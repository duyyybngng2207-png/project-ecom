<?php
if(!defined('_HIENU')){
    die('Truy cập không hợp lệ');
}

function layout($layoutName, $data = []){
    if(file_exists( './app/Views/parts/' . $layoutName . '.php')){
        extract($data);
        require_once './app/Views/parts/' . $layoutName . '.php';
    }
}

function layoutClient($layoutName, $data = []){
    if(file_exists( './app/Views/layouts/' . $layoutName . '.php')){
        extract($data);
        require_once './app/Views/layouts/' . $layoutName . '.php';
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Hàm gửi mail
function sendMail($emailTo, $subject, $content){
    $mail = new PHPMailer(true);


    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = _MAIL_USER;                     //SMTP username
        $mail->Password   = _MAIL_PASS;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;             //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(_MAIL_USER, _MAIL_FROM_NAME);
        $mail->addAddress($emailTo);     //Add a recipient
        

        //Content
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => [
                'verify_peer' => true,
                'verify_depth' => 3,
                'allow_self_signed' => true,
                
                
            ],
        );


        $mail->send();
        echo 'Gửi thành công';
    } catch (Exception $e) {
        echo "Gửi thất bại. Mailer Error: {$mail->ErrorInfo}";
    }
}

function dd($data){
    echo '<pre style="border: solid #ff2222 1px;">';
    print_r($data);
    echo '</pre>';
    exit;
}

//Kiểm tra phương post
function isPost(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    }
    return false;
}

//Phương thức GET
function isGet(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;
    }
    return false;
}

//Lọc dữ liệu filterData ('get')
function filterData($method = ''){
    $filterArr = [];
    if(empty($method)){
        if(!empty($_GET)){
            foreach($_GET as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }

        if(!empty($_POST)){
            foreach($_POST as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }else{
        if($method === 'get'){
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    $key = strip_tags($key);
                    if(is_array($value)){
                        $filterArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else{
                        $filterArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }else if($method === 'post'){
            if(!empty($_POST)){
                foreach($_POST as $key => $value){
                    $key = strip_tags($key);
                    if(is_array($value)){
                        $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else{
                        $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        
    }

    return $filterArr;
}

//Validate email
function validateEmail($email){
 
    if(!empty($email)){
        $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    return $checkEmail; 
}

//Validate name
function validateName($name){
 
    if(!empty($name)){
        $checkName = filter_var($name, FILTER_VALIDATE_EMAIL);
    }
    return $checkName; 
}

//Validate int
function validateInt($number){
    if(!empty($number)){
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }
    return $checkNumber; 
}

//Validate phone 0 123456789
function isPhone($phone){
    $phoneFirst = false;
    if($phone[0] == '0'){
        $phoneFirst = true;
        $phone = substr($phone, 1);
    }

    $checkPhone = false;
    if(validateInt($phone)){
        $checkPhone = true;
    }

    if($phoneFirst & $checkPhone){
        return true;
    }
    return false;
}

//Thông báo lỗi 
function getMsg($msg, $type = 'success'){
    echo  '<div class="annouce-messenge alert alert-' . $type . '">';
    echo $msg ;
    echo '</div>';
}

//Hiển thị lỗi 
function formError($errors, $fieldName){
    return (!empty($errors[$fieldName])) ? '<div class="text-danger">' . reset($errors[$fieldName]) . '</div>' : false; 
}

//Hàm hiển thị dữ liệu giá trị cũ 
function oldData($oldData, $fieldName){
    return !empty($oldData[$fieldName]) ? $oldData[$fieldName] : null;
}

// redirect('http://manager_course.test/?module=auth&action=login', true)
// redirect('?module=auth&action=login')
//Hàm chuyển hướng 
function redirect($path, $pathFull = false){
    if($pathFull){
        header("Location: $path");
        exit();
    }else {
        $url = _HOST_URL . $path;
        header("Location: $url");
        exit();
    }
}

function deleteCookie($name) {
    setcookie($name, '', time() - 3600, '/');
    unset($_COOKIE[$name]);
}

// //Hàm checklogin
// function isLogin()
// {
//     $checkLogin = false;
//     $tokenLogin = getSession('token_login');
//     $checkToken = $this->coreModel->getOne("SELECT * FROM token_login WHERE token = '$tokenLogin'");
//     if (!empty($checkToken)) {
//         $checkLogin = true;
//     } else {
//         removeSession('token_login');
//     }
//     return $checkLogin;
// }

function discountPercent($price, $discount_price) {
    if (empty($price) || $price == 0) return 0;
    return round(($price - $discount_price) / $price * 100);
}

function generateRandomString(int $length = 16): string {
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pieces = [];
    $max = strlen($keyspace) - 1;
    
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    
    return implode('', $pieces);
}


