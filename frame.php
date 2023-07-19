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
        $result = ' <header class="site-header sticky-top py-3">
  <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large; margin-bottom: 1rem">
    <div class="btn-group col-8 mx-auto" role="group" aria-label="Basic outlined example">';
        foreach ($array as $key => $value) {
            if ($key == $page) {
                $result .= ' <a type="button" class="btn btn-outline-dark active" href="?page=' . $key . '"><b>' . $value . '</b></a>';
            } else {
                $result .= '<a type="button" class="btn btn-outline-dark" href="?page=' . $key . '"><b>' . $value . '</b></a>';
            }
        }

      $result .= '
    </div>
    <button style="text-decoration: none; font-family: Georgia" class="btn btn-outline-dark" data-target="#addSingModal" data-toggle="modal"><b>Sign up</b></button>
    </nav>';
      $result .= ' <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large; margin-bottom: 1rem"><div class="btn-group col-12 mx-auto" role="group" aria-label="Basic outlined example" id="header" onclick="get_info(event)">
                    <button type="button" class="btn btn-outline-danger" style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-gold" name = "gold" style="font-weight: bold">Gold</button>
                    <button type="button" class="btn btn-outline-dark" style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-primary" style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-diamond" name="diamond" style="font-weight: bold">Diamond</button>
                    <button type="button" class="btn btn-outline-success"  style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-secondary" style="font-weight: bold">' . $value . '</button>
</div></nav></header>';
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