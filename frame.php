<?php
Class Frame
{
    function get_header($page)
    {
        $array = array(
            "MainList" => "Main List",
            "LegacyList" => "Legacy List",
            "ExtendedList" => "Extended List"
        );
        $result = '
  <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large; margin-top: 1rem">
    <div class="btn-group col-8 mx-auto" role="group" aria-label="Basic outlined example">';
        foreach ($array as $key => $value) {
            if ($key == $page["page"]) {
                $result .= ' <a type="button" class="btn btn-outline-primary active" href="?page=' . $key . '"><b>' . $value . '</b></a>';
            } else {
                $result .= '<a type="button" class="btn btn-outline-primary" href="?page=' . $key . '"><b>' . $value . '</b></a>';
            }
        }
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
    <button style="text-decoration: none; font-family: Georgia" class="btn btn-outline-primary" data-target="#addSingModal" data-toggle="modal"><b>Sign up</b></button>
    </nav>';
      $result .= ' <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large; margin-top: 1rem"><div class="btn-group col-12 mx-auto" role="group"  id="header" onclick="get_info(event)">';
      $page["page"] = (isset($array[$page["page"]])) ? $page["page"] : 'MainList';
      foreach ($types as $type => $typeArray)
      {
          if (isset($page["type"]) && $page["type"] == $type)
          {
              $result .= '<a type="button" class="'.$typeArray["type"].' active" name = "gold" href="?page='.$page["page"].'&type='.$type.'" style="font-weight: bold">'.$typeArray["name"].'</a>';
          }
          else {
              $result .= '<a type="button" class="' . $typeArray["type"] . '" name = "gold" href="?page=' . $page["page"] . '&type=' . $type . '" style="font-weight: bold">' . $typeArray["name"] . '</a>';
          }
      }
$result .= '</div></nav>';
        $result .= '<div class="modal fade" id="addSingModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Войти</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="sing.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Имя Пользователя" name="nameGroup" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Пароль" name="nameGroup" required>
          </div>
          <button style="text-decoration: none; font-family: Georgia" class="btn btn-outline-dark"><b>Sign up</b></button>
        </form>
      </div>
    </div>
  </div>
</div>';
        return $result;
    }
}
?>