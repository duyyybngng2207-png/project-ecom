<?php 
class UsersController extends BaseController
{
    public function index()
    {
        $user = new Users();
        $userDetail = $user->getAllUsers();
        ob_start();
        $this->renderView('layouts-part/users',$userDetail);
        $data = [
            'content'=>ob_get_clean()
        ];
        $this->renderView('layouts/main-layouts',$data);    
    }

    public function dashboard()
    {
        $corer = new CoreModel();
        $getUserDetail = $corer->getUserDetail();
        setSession('getUserDetail', $getUserDetail);

        if (empty(getSession('token_login'))) {
        redirect('/login');
        return;
        }

        if (!$getUserDetail) {
            $getUserDetail = [];
        }

        ob_start();
        extract($getUserDetail);
        require './app/Views/layouts-part/dashboard.php';
        $content = ob_get_clean();

        $data = [
            'content'       => $content,
            'getUserDetail' => $getUserDetail
        ];

        $this->renderView('layouts/main-layouts', $data);
    }

}