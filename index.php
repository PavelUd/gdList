
<?php
include 'index.html';
include 'bd.php';
require_once 'main_list.php';
require_once 'frame.php';
require_once 'legacy_list.php';
require_once 'card.php';
$frame = new Frame();
$page=$_REQUEST["page"];
switch ($page)
{
    case 'MainList':
        $main_list = new MainList();
        $result = $frame->get_header($_REQUEST);
        $type = isset($_REQUEST["type"]) ? $_REQUEST["type"] : null;
        $result .= $main_list->get_header($type);
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
$result .= '<footer class=" text-center text-lg-start">
  <div class="text-center p-3" >
    discord:
    <a class="text-dark" href="https://discord.gg/yCKX8HMj">server</a>
  </div>
</footer>';
echo $result;
?>