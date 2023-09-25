<?php

namespace gdlist\www\back;

abstract class Controller
{
    use YouTubeController;
    function __construct()
    {
        $this->check();
    }
    private function check() : void
    {
        if (!isset($_SESSION["user"])) {
            header("Location: /MainList");
        }
    }
}
trait YouTubeController
{
    function YouTubeLink(string $url)
    {
        $url = trim($url);
         $pattern = "/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=))([a-zA-Z0-9_-]{11})/";
        if(preg_match($pattern, $url, $matches))
        {
            $YouTubeLink = $matches[1];
        }else {
            $YouTubeLink = false;
        }
        return $YouTubeLink;
    }

}
