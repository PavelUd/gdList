<?php
class  CardTree
{
    function get_cards($card_name)
    {

        $result = '<div class="col-md-6" style="margin-left: 1.5rem"><div id="TreeCard">';
        for ($i = 0; $i < 10; $i++) {
            $result .= '<a href="?page=LegacyList" class="card" style="max-width: 540px; margin-left: 1.5rem; margin-top: 1.5rem; text-decoration: none; color: black " name="diamond"><div class="aos aos--first" data-aos="fade-right"><div class = "mini-card" data-aos="fade-down">
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
</div>
</a>';
        }
        $result .= '</div></div>';
    }
}
?>
