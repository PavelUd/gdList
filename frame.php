<?php
namespace gdlist\www;
Class Frame
{
    function get_header($path)
    {
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
        <form action="/login.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Имя Пользователя" name="name" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Пароль" name="password" required>
          </div>
          <button type ="submit" style="text-decoration: none; font-family: Georgia" class="btn btn-outline-dark"><b>Sign up</b></button>
        </form>
      </div>
    </div>
  </div>
</div>';
        return $result;
    }
    private function get_member_form(){
        $table = '<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Переключить навигацию">
      <span style="font-weight: bold">'.$_SESSION["name"].'</span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="offcanvasNavbarLabel">Сервис</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" style="text-decoration: none; margin-top: 0.5rem" href="/add_record">Добавить Рекорд</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="text-decoration: none; margin-top: 0.5rem" href="/create_level">Добавить Уровень</a>
          </li> 
          <li class="nav-item">
            <a  class="btn btn-outline-danger" style="text-decoration: none; margin-top: 2rem" href="/exit">Выйти</a>
          </li> 
        </ul>
      </div>
    </div>';
        return $table;
    }
    function login_exit()
    {
        unset($_SESSION['name']);
        header("Location: /MainList");
    }
}
?>