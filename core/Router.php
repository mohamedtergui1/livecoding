<?php

class Router
{
    private $controller = 'App\Controller\UserController';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        $this->router();
    }

    public function router()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $uri = explode('/', trim(strtolower($uri), '/'));
       
        unset($uri[0]);
        if (!empty($uri[1])) {
            $uri[1]= ucwords($uri[1]);
            $controller = $uri[1] . 'Controller';
            var_dump($controller);
          
            unset($uri[1]);
            $controller = 'App\Controller\\' . $controller;

            if (class_exists($controller)) {
                $this->controller = $controller;
            } else {
                echo "error not fined";
                exit;
            }
        }

        $class = $this->controller;
        $class = new $class;


        if (isset($uri[1])) {

            $method = $uri[1];
            unset($uri[1]);

            if (method_exists($class, $method)) {
                $this->method = $method;
            }
            
        }


        if (isset($uri[2])) {
            $this->params = array_values($uri);
        }

        call_user_func_array([$class, $this->method], $this->params);
       
    }
}