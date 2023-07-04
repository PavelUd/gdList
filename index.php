
<?php
include 'index.html';
require_once 'frame.php';
$frame = new Frame();
$result = $frame->get_h();
echo $result;
?>