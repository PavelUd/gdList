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
    function isYouTubeLink($url) {
        $url = trim($url);
        $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)$/';
        return preg_match($pattern, $url);
    }
}