<?php

namespace gdlist\www\back;

abstract class Controller
{
    function __construct()
    {
        $this->check();
    }
    private function check()
    {
        if (!isset($_SESSION["name"])) {
            header("Location: /MainList");
        }
    }
}