<?php
// $router->get('/users', 'UsersController@index');
class Router
{
    protected $routers = [];
    public function get($url, $action)
    {
        $this->routers['GET'][$url] = $action;
    }

    public function post($url, $action)
    {
        $this->routers['POST'][$url] = $action;
    }

    public function getRout()
    {
        return $this->routers;
    }

    public function xulyPath($method, $url)
    {
        $url = $url ?: '/';
        if ($url !== '/') {
            $url = rtrim($url, '/');
        }
        foreach ($this->routers[$method] as $routePath => $action) {
            $pattern = preg_replace('/\{[^\/]+\}/', '([^/]+)', $routePath);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                [$controller, $funcs] = explode('@', $action);
                $controllerMot = new $controller();
                call_user_func_array([$controllerMot, $funcs], $matches);
                return;
            }
        }

        echo '404 ERROR';
    }
}
