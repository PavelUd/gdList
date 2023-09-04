<?php
namespace gdlist\www;
use gdlist\www\back\Controller;
require_once dirname(__FILE__) . '/back/Controller.php';
Class Service extends Controller
{
    public function get_record()
    {
        $idPlayer = $_SESSION["id"];
        $level = $_POST['level'];
        $proof = $_POST['proof'];
        $percent = $_POST['percent'];

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
            if (!$existingRecord && $this->isYouTubeLink($proof)) {
                $sqlHelper->query("INSERT INTO `level_records`(`player_id`, `level_id`, `video_proof`, `progress`) VALUES ($idPlayer, $levelData, '$proof', $percent)");
                header("Location: /MainList/{$level["type"]}/{$level['id']}");
            } elseif ($existingRecord && $existingRecord["progress"] < $percent && $this->isYouTubeLink($proof)) {
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
        var_dump($_POST);
    }
}
?>