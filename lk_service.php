<?php
namespace gdlist\www;
use gdlist\www\back\Controller;
require_once dirname(__FILE__) . '/back/Controller.php';
Class Service extends Controller
{
    public function get_record() : void
    {
        extract($_POST);
        $idPlayer = $_SESSION["id"];

        $sqlHelper = new Db();

        $param = [
            'level' => $level,
        ];
        $levelData = $sqlHelper->get_row("SELECT id FROM levels WHERE name = :level", $param)["id"];

        if ($levelData) {
            $pr_param = [
                'id' => $levelData,
                'idPlayer' => $idPlayer
            ];
            $level = $sqlHelper->get_row("select * from levels where id = $levelData");
            $existingRecord = $sqlHelper->get_row("SELECT * FROM `level_records` WHERE `level_id` = :id AND `player_id` = :idPlayer", $pr_param);
            if (!$existingRecord && $this->YouTubeLink($proof)) {
                $sqlHelper->query("INSERT INTO `level_records`(`player_id`, `level_id`, `video_proof`, `progress`) VALUES ($idPlayer, $levelData, '$proof', $percent)");
                header("Location: /MainList/{$level["type"]}/{$level['id']}");
            } elseif ($existingRecord && $existingRecord["progress"] < $percent && $this->YouTubeLink($proof)) {
                $sqlHelper->query("UPDATE `level_records` SET `video_proof`= '$proof', `progress` = $percent WHERE `player_id` = :idPlayer AND level_id = :id", $pr_param);
                header("Location: /MainList/{$level["type"]}/{$level['id']}");
            }
            else{
                header("Location: /MainList");
            }
        }
        else{
            header("Location: /MainList");
        }
    }

    public function create_level()
    {
        $sqlHelper = new Db();
       extract($_POST);
        $link = $this->YouTubeLink($video);
       $islevel = $sqlHelper->get_rows("select * from levels where name = '$name' or link = '$link'");
       if(!$islevel && $link) {
           $namePlayer = $_SESSION["name"];
           $sqlHelper->query("INSERT INTO `levels` (`name`, `Account`, `FPS`, `Wr%`, `Acc%`, `WR_holder`, `type`, `link`) VALUES ('$name', '$namePlayer', '$fps', '', '', '', '$type', '$link')");
       }
    }
}
?>