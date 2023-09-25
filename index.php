<?php
include 'index.html';
include 'bd.php';
require 'main_list.php';
require_once 'frame.php';
require_once 'card.php';
require_once 'lk_service.php';
require_once 'View.php';
require_once dirname(__FILE__) . '/back/User.php';
require_once dirname(__FILE__) . '/back/Router.php';
use gdlist\www\back\Router;
use gdlist\www\Frame;
use \gdlist\www\back\User;
session_start();
$route = new Router;
$frame = new Frame();
$user = $_SESSION ? User::getInstance($_SESSION['name'], $_SESSION['id']) : null;
session_destroy();

$_SESSION["status"] = $user ? "ok" : "fail";
$result = $frame->get_header($_SERVER["REQUEST_URI"]);
$result .= $route->run();
$result .= '<footer class=" text-center text-lg-start">
  <div class="text-center p-3" >
    discord:
    <a class="text-dark" href="https://discord.gg/yCKX8HMj">server</a>
  </div>
</footer>';
echo $result;
?>