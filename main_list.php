<?php
Class MainList
{
    function get_header($nameCard)
    {
        $params = array(
          "type" => $nameCard
        );
        $sqlHelper= new \gdlist\www\Db();
        $result = '<div class="col-md-12"  style="justify-content: center; display: flex; margin-top: 1rem"><div id="TreeCard">';
        if (isset($nameCard)) {
            $cards = $sqlHelper->get_rows('select * from levels where type = :type', $params);
        }
        else {
            $cards = $sqlHelper->get_rows("select * from levels");
        }
        $i=0;
                foreach ($cards as $card) {
                    extract($card);
                    $i++;
                    $result .= '<div class="aos" data-aos="fade-down"><a href="?page=card&id='.$id.'" class="card" style="  min-width: 740px ; margin-left: 1.5rem; margin-top: 1.5rem; text-decoration: none; color: black;" name="'.$type.'" ><div class = "mini-card">
                  <div class="row g-0">
                    <span style="max-width: 170px; margin-left: 1rem;">
                      <img src="http://img.youtube.com/vi/'.$link.'/mqdefault.jpg" class="img-fluid rounded-start" style="margin: 0.5rem">
                    </span>
            <div style="margin-left: 1rem">
              <div class="card-body"><h3 class="card-text" style="font-weight: bold">
                '.$name.' - #'.$i.'</h3>
                <h4 class="card-title">'.$Account.'</h4>
              </div>
            </div>
          </div>
        </div>
        </a>
                </div>';
                }   
                    $result .= '</div></div>';
                return $result;
    }
}
?>