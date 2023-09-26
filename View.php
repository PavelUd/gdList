<?php

namespace gdlist\www;

class View
{
    public function login_exit()
    {

        unset($_SESSION['id']);
        header("Location: /MainList");
    }

    public function redirect($url)
    {
        header('location:' . $url);
        exit;
    }

    public static function errorCode($code)
    {
        http_response_code(404);
        include('errors/404.php');
        exit();
    }
}

?>