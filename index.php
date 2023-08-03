<?php
include 'index.html';
include 'bd.php';
require 'main_list.php';
require_once 'frame.php';
require_once 'card.php';
require_once dirname(__FILE__) . '/back/Router.php';
use gdlist\www\back\Router;
$route = new Router;
$frame = new Frame();

$result = $frame->get_header($_SERVER["REQUEST_URI"]);
$result .= $route->run();
/*if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    switch ($page) {
        case 'MainList':
            $main_list = new MainList();
            $result = $frame->get_header($_REQUEST);
            $type = isset($_REQUEST["type"]) ? $_REQUEST["type"] : null;
            $result .= $main_list->get_main_list($type);
            break;
        case  'LegacyList':
            $LegacyList = new legacy_list();
            $result = $frame->get_header($_REQUEST);
            $result .= $LegacyList->get_page();
            break;
        case 'card':
            $result = $frame->get_header($_REQUEST);
            $Card = new Card();
            $result .= $Card->get_media();
            break;
    }
}
*/
$result .= '<footer class=" text-center text-lg-start">
  <div class="text-center p-3" >
    discord:
    <a class="text-dark" href="https://discord.gg/yCKX8HMj">server</a>
  </div>
</footer>';
echo $result;
?>