
<?php
include 'index.html';
require_once 'frame.php';
require_once 'main_list.php';
require_once 'legacy_list.php';
$frame = new Frame();
$header = $frame->get_header();
$result = $header;
$page=$_REQUEST["page"];
switch ($page)
{
    case 'MainList':

        $main_list = new MainList();
        $result = $header;
        $result .= $main_list->get_header();
        break;
    case  'LegacyList':
        $LegacyList = new legacy_list();
        $result = $header;
        $result .= $LegacyList->get_page();
        break;

}
$result .= '<footer class="bg-light text-center text-lg-start">
  <div class="text-center p-3" style="background-color:white">
    discord:
    <a class="text-dark" href="https://discord.gg/yCKX8HMj">server</a>
  </div>
</footer>';
echo $result;
?>