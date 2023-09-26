<?php
namespace gdlist\www;
spl_autoload_register(function ($classname) {
    $dirs = array (
        './Twig-2.x/'
    );

    foreach ($dirs as $dir) {
        $filename = $dir . str_replace('\\', '/', $classname) .'.php';
        if (file_exists($filename)) {
            require_once $filename;
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
        global $user;
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
        if (isset($_SESSION["id"])){
            $user = User::getInstance($_SESSION['id']);

            $reg = $this->get_member_form($types);
        }
        else
        {
            $reg = ' <button style="text-decoration: none; font-family: Georgia" class="btn btn-outline-primary" data-target="#addSingModal" data-toggle="modal"><b>Sign up</b></button>';
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
        $table = '<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Переключить навигацию">
      <span style="font-weight: bold">'.$_SESSION["name"].'</span>
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
        $table.= $twig->render('create.html', ['name' => $_SESSION["name"], 'types' => $s]);
        return $table;
    }
}
?>