<?php
Class MainList
{
    function get_header()
    {
        $result = '<div class="col-md-6" style="margin-left: 1.5rem">';
        for ($i = 0;$i < 10; $i++)
        {
            $result .= '<a href="?page=LegacyList" class="card mb-3" style="max-width: 540px; margin-left: 1.5rem; margin-top: 1.5rem; text-decoration: none; color: black"><div class = "mini-card">
          <div class="row g-0">
            <div class="col-md-3">
              <img src="css/img/h.jpg" class="img-fluid rounded-start" style="margin: 1rem">
            </div>
    <div class="col-md-4">
      <div class="card-body">
        <h5 class="card-title">Заголовок карточки</h5>
        <p class="card-text">fgf</p>
      </div>
    </div>
  </div>
</div>
</a>';
        }
        $result .= '</div>';
        return $result;
    }
}
?>