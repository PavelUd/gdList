<?php
namespace gdlist\www;
use gdlist\www\back\Controller;
use gdlist\www\back\User;
require_once dirname(__FILE__) . '/back/Controller.php';
Class Service extends Controller
{
    public function get_record() : void
    {
        extract($_POST);

        $user = User::getInstance();
        $idPlayer = $user->getId();
        $sqlHelper = new Db();

        $param = [
            'level' => $level,
        ];
        $levelData = $sqlHelper->get_row("SELECT id FROM levels WHERE name = :level", $param)["id"];

        $pr_param = [
            'id' => $levelData,
            'idPlayer' => $idPlayer
        ];
        $existingRecord = $sqlHelper->get_row("SELECT * FROM `level_records` WHERE `level_id` = :id AND `player_id` = :idPlayer", $pr_param);
        if (!$existingRecord && $this->YouTubeLink($proof)) {
            $_POST["typeVerify"] = "add_record";
            $_POST["idPlayer"] = $idPlayer;
            $this->verification_log($_POST);
        } elseif ($existingRecord && $existingRecord["progress"] <= $percent && $this->YouTubeLink($proof)) {
            $_POST["typeVerify"] = "update_record";
            $_POST["idPlayer"] = $idPlayer;
            $this->verification_log($_POST);
        } else {
            header("Location: /MainList");
        }
    }

    public function create_level()
    {
        $sqlHelper = new Db();
       extract($_POST);
        $link = $this->YouTubeLink($video);
        $islevel = $sqlHelper->get_rows("select * from levels where name = '$level' or link = '$link'");
        if (!$islevel && $link) {
            $_POST["typeVerify"] = "add_level";
            $_POST["video"] = $link;
            $this->verification_log($_POST);
        }
    }
}
trait Verification_Service
{
    public function verify()
    {
        $sqlHelper = new Db();
        $id_ver = $_POST['id'];
        $verData = $sqlHelper->get_row("SELECT info, sender FROM `verification` WHERE id = $id_ver");
        $info = json_decode($verData['info'], true);
        extract($info);

        if ($typeVerify == "add_record" || $typeVerify == "update_record")
        {
            $param = ['level' => $level];
            $levelData = $sqlHelper->get_row("SELECT * FROM levels WHERE name = :level", $param);
            $levelData["idPlayer"] = $idPlayer;
        }
        switch ($typeVerify)
        {
            case "add_record":
                $sqlHelper->query("INSERT INTO `level_records`(`player_id`, `level_id`, `video_proof`, `progress`) VALUES ($idPlayer, {$levelData['id']}, '$proof', $percent)");
                break;
            case "add_level":
                $sqlHelper->query("INSERT INTO `levels` (`name`, `Account`, `FPS`, `type`, `link`) 
                                      VALUES ('$level', '$author', '$fps', '$type', '$video')");
                break;
            case "update_record":
                $up_data=['id'=> $levelData['id'], 'idPlayer' => $levelData['idPlayer']];
                $sqlHelper->query("UPDATE `level_records` SET `video_proof`= '$proof', `progress` = $percent WHERE `player_id` = :idPlayer AND level_id = :id", $up_data);
                break;
        }

        if ($typeVerify == "add_record" || $typeVerify == "update_record") {
            header("Location: /MainList/{$levelData['type']}/{$levelData['id']}");
        }
        $sqlHelper->query("UPDATE `verification` set typeVerify = 'successfully' where id = $id_ver");
    }
    public function verification_log($info) : void{
        $sqlHelper = new Db();
        $datetime = date('Y-m-d H:i:s');
        $user = User::getInstance()->getName();
        $params = json_encode($info, JSON_UNESCAPED_UNICODE);
        $sqlHelper->query("INSERT INTO `verification`(`typeVerify`, `sender`, `info`, `dateTime`) VALUES ('Confirmation','$user','$params','$datetime')");
        header("Location: /MainList");
    }
}
?>