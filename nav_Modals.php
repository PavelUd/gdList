<?php

namespace gdlist\www;

class nav_Modals
{
    public $sing_modal = '<div class="modal fade" id="addSingModal" tabindex="-1" role="dialog" aria-hidden="true">
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
function get_nav($levels)
{
    $table = '<div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title" id="offcanvasNavbarLabel">Сервис</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <span style="text-decoration: none; margin-top: 0.5rem" data-target="#addNawModal" data-toggle="modal">Добавить Рекорд</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="text-decoration: none; margin-top: 0.5rem" href="/create_level">Добавить Уровень</a>
                </li>
                <li class="nav-item">
                    <a  class="btn btn-outline-danger" style="text-decoration: none; margin-top: 2rem" href="/exit">Выйти</a>
                </li>
            </ul>
        </div>';
    $table .=   '<div class = "modal fade" tabindex="-1" id="addNawModal">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                              <h3 class="modal-title">Добавить Рекорд</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
            <div class="modal-body"><form action="/add_record" method="post">
    <div class = "col-md-12"<label>Выбор уровня</label>
            <div class="form-group">
            <input type="text" id="autocompleteInput" placeholder="Выберете уровень" class="form-control" name="level" required>
            <ul id="autocompleteList" style="border: none"></ul>
    </div></div>
           <div class="container"><div class="form-group">
      <label for="percentInput">Проценты</label>
      <div class="input-group">
        <input type="number" class="form-control" id="percentInput" placeholder="Введите процент" name ="percent" required>
        <div class="input-group-append">
          <span class="input-group-text">%</span>
        </div>
      </div>
    </div>
    <label for="proffvideo">подтверждение Рекорда</label>
    <div class="input-group">
        <input type="text" class="form-control" id="videoInput" placeholder="Введите ссылку на видео-подтверждение" name = "proof" required>
        </div>
        <div id="data-container" data-array='.$levels.'></div>
        </div>
            </div>
                <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" >Save changes</button>
          </div>
        </div>
      </div>
    </div>';
return $table;
}
}
?>
