<?php
require_once 'bd.php';
$db = new \gdlist\www\Db();
if (preg_match('/^[а-яА-Яa-zA-Z0-9]+$/u', $_POST["name"]) && strip_tags($_POST["name"]) == $_POST["name"])
{
    $name =  $_POST["name"];
    $params = [
        'name' => $name
    ];
    $user = $db->get_row("select password, id from members where name = :name", $params);
    if ($user["password"] && $user["password"] == $_POST["password"]) {
        if (session_start()) {
            unset($_SESSION['name']);
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['id'] = $user['id'];


            if (isset($_SESSION['name'])) {
                header("Location: /MainList");
            } else {
                echo "Что-то пошло не так. Попробуйте позже.";
            }
        }
        else echo "jgd";
    }
    else echo "ошибка";
}
else{
    echo 'а ловко ты это придумал';
}

?>
