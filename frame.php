<?php
namespace gdlist\www;
Class Frame
{
    function get_header($path)
    {
        $naw_modals = new nav_Modals();
        if (isset($_SESSION["name"])){
            $reg = $this->get_member_form();
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
        $result .= $naw_modals->sing_modal;
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
    private function get_member_form(){
        $naw_modals = new nav_Modals();
        $table = '<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Переключить навигацию">
      <span style="font-weight: bold">'.$_SESSION["name"].'</span>
    </button>
    ';
        $sql = new Db();
        $levels = $sql->get_rows("select id, name from levels");
        $json_levels = json_encode($levels,JSON_UNESCAPED_UNICODE);
        $json_levels = (str_replace(' ', '_',$json_levels));
        $table .= $naw_modals->get_nav($json_levels);
        return $table;
    }
}
?>