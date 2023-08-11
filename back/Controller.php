<?php

namespace gdlist\www\back;

class Controller{
    public function login_exit()
    {
        unset($_SESSION['name']);
        header("Location: /MainList");
    }
    public function redirect($url)
    {
        header('location:'.$url);
        exit;
    }
    public static function errorCode($code)
    {
        http_response_code($code);
        if ($code == 404) {
            header("HTTP/1.0 404 Not Found");
        }
    }
}
?>