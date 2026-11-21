<?php 
ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', 'project-ecom.test'); 
session_start();
// require_once './config/config.php';
// require_once './config/database.php';
foreach(glob(__DIR__ . '/config/*.php') as $filename){
    require_once $filename;
}

foreach(glob(__DIR__ . '/core/*.php') as $filename){
    require_once $filename;
}



require_once './core/mailer/Exception.php';
require_once './core/mailer/PHPMailer.php';
require_once './core/mailer/SMTP.php';
// require_once './app/Models/CoreModels.php';
// require_once './app/Models/Users.php';
// require_once './app/Models/Groups.php';
foreach(glob(__DIR__ . '/app/Models/*.php') as $filename){
    require_once $filename;
}

// require_once './app/Controllers/BaseController.php';
// require_once './app/Controllers/UsersController.php';
foreach(glob(__DIR__ . '/app/Controllers/*.php') as $filename){
    require_once $filename;
}

foreach(glob(__DIR__ . '/app/Controllers/clients/*.php') as $filename){
    require_once $filename;
}

$router = new Router();

foreach(glob(__DIR__ . '/routers/*.php') as $filename){
    require_once $filename;
}

$projectName = '/project-ecom';
$requestUrl = str_replace($projectName,'',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
$methodRes = $_SERVER['REQUEST_METHOD'];

$router->xulyPath($methodRes, $requestUrl);



// require_once './templates/layouts/header.php';
// require_once './templates/layouts/sidebar.php';
// require_once './templates/layouts/breadcrumb.php';






// $group = new Group();

// $data = [
//     'name'=>'test MVC',
    
//     'created_at'=>date('Y:m:d H:i:s')
// ];

// echo '<pre>';
// print_r($group->insertGroups($data));
// echo '</pre>';