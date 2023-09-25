<?php
namespace gdlist\www;
use \gdlist\www\back\User;
require_once dirname(__FILE__) . '/back/User.php';
spl_autoload_register(function ($classname) {
    $dirs = array (
        './Twig-2.x/'
    );

    foreach ($dirs as $dir) {
        $filename = $dir . str_replace('\\', '/', $classname) .'.php';
        if (file_exists($filename)) {
            require $filename;
            break;
        }
    }
});
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
Class Frame
{
    function get_header($path) : string
    {
        global $twig;
        $types = array(
            "exodium" => array("name" => "Exodium",
                "type" => "btn btn-outline-dark"),
            "legend" => array("name" => "Legend",
                "type" => "btn btn-outline-secondary"),
            "amethyst" => array("name" => "Amethyst",
                "type" => "btn btn-outline-amethyst"),
            "diamond" => array("name" => "Diamond",
                "type" => "btn btn-outline-diamond"),
            "ruby" => array("name" => "Ruby",
                "type" => "btn btn-outline-ruby"),
            "emerald" => array("name" => "Emerald",
                "type" => "btn btn-outline-emerald"),
            "gold" => array("name" => "Gold",
                "type" => "btn btn-outline-gold"),
            "silver" => array("name" => "Silver",
                "type" => "btn btn-outline-silver"),
            "bronze" => array("name" => "Bronze",
                "type" => "btn btn-outline-bronze"),
            "rock" => array("name" => "Rock",
                "type" => "btn btn-outline-rock"),
        );
        if ($_SESSION["status"] == 'ok'){
            $reg = $this->get_member_form($types);
        }
        else
        {
            $reg = ' <button style="text-decoration: none; font-family: Georgia;border-radius: 5px;" class="btn btn-outline-primary active" data-target="#addSingModal" data-toggle="modal"><b>Sign up</b></button>';
        }
        $page = explode('/', trim($path, '/'));
        $array = array(
            "MainList" => "Main List",
            "LegacyList" => "Legacy List",
            "ExtendedList" => "Extended List"
        );
        $result = '
  <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large; margin-top: 1rem">
    <div class="btn-group col-8 mx-auto" role="group" aria-label="Basic outlined example">';
        foreach ($array as $key => $value) {
            if ($key == $page[0]) {
                $result .= ' <a type="button" class="btn btn-outline-primary active" href="/' . $key . '"><b>' . $value . '</b></a>';
            } else {
                $result .= '<a type="button" class="btn btn-outline-primary" href="/' . $key . '"><b>' . $value . '</b></a>';
            }
        }
       $result.= $twig->render('login_modal.html');
      $result .= '
    </div>
   '.$reg.'
    </nav>';
      $result .= ' <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large; margin-top: 1rem"><div class="btn-group col-12 mx-auto" role="group"  id="header">';
      $page[0] = (isset($array[$page[0]])) ? $page[0] : 'MainList';
      foreach ($types as $type => $typeArray)
      {
          if (isset($page[1]) && $page[1] == $type)
          {
              $result .= '<a type="button" class="'.$typeArray["type"].' active" href="/'.$page[0].'/'.$type.'" style="font-weight: bold">'.$typeArray["name"].'</a>';
          }
          else {
              $result .= '<a type="button" class="' . $typeArray["type"] . '" href="/'.$page[0].'/'.$type.'" style="font-weight: bold">' . $typeArray["name"] . '</a>';
          }
      }
$result .= '</div></nav>';

        return $result;
    }
    private function get_member_form($types): string{

        global $twig;
        $user = User::getInstance();
        var_dump($user);
        $userName = $user->getName();

        $table = '<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Переключить навигацию">
      <span style="font-weight: bold">'.$userName.'</span>
    </button>
    ';
        $sql = new Db();
        $levels = $sql->get_rows("select id, name from levels");
        $json_levels = json_encode($levels,JSON_UNESCAPED_UNICODE);
        $json_levels = (str_replace(' ', '_',$json_levels));
       $table .= $twig->render('naw.html');
        $table .= $twig->render('add_record.html', ['levels' => $json_levels]);
            foreach ($types as $name => $type)
            {
                $s[$name] = $type["name"];
            }
            $cards = $sql->get_rows("select * from `verification` where typeVerify = 'Confirmation'");
        $table.= $twig->render('create.html', ['name' => $userName, 'types' => $s]);
            $table .= '<div class = "modal fade" tabindex="-1" id="verify">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Верификация</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            foreach ($cards as $card) {
                $info = json_decode($card["info"]);
                $id = $card["id"];
                $table .= '<div class="modal-body">
                <div class="card"><form action="/verify" method="post">
                    <div class="card-title" style="text-align: center"><label>'.$info->level.'</label></div>
                    <div class="card-body">
                        <span>'.$info->typeVerify.'</span>
                       <input type = hidden name = "id" value="'.$id.'">
                    </div>
                    <div style="margin: 1rem" class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-success">Добавить</button>
                    <button type="button" class="btn btn-outline-danger">Отклонить</button>
                    </div></form>
                </div>
            </div>';
            }
        return $table;
    }
}
?>