<?php
class BaseController
{
    protected function renderView($view, $data = [])
    {
        extract($data); //Mảng 1 chiều
        require_once './app/Views/' . $view . '.php';
    }

    protected function renderViewHtml($view, $data = [])
    {
        extract($data);
        ob_start(); // Bắt đầu capture output
        require_once './app/Views/' . $view . '.php';
        return ob_get_clean(); // Trả về nội dung đã capture
    }

    protected function renderViewLayout($data = [])
    {
        $user_id = 1; 
        $usersModel = new Users();

        extract($data); //Mảng 1 chiều
        require_once './app/Views/layouts/_layouts.php';
    }
    
    protected function checkLogin()
    {
        if (empty(getSession('token_login'))) {
            redirect('/login');
            exit();
        }
    }
}
