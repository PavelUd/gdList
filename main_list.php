<?php
namespace gdlist\www;
Class MainList
{
    function get_main_list($nameCard = null)
    {
        $colors = array(
            "exodium" =>["background" => 'black',
                        "text" => '#c0c0c0'],
            "legend" => ["background" => '#6c757d',
                        "text" => 'black'],
            "amethyst" =>["background" =>  '#9966cc',
                        "text" => 'black'],
            "diamond" =>["background" =>  '#9ec5fe',
                        "text" => 'black'],
            "ruby" => ["background" => '#ca0147',
                        "text" => 'black'],
            "emerald" =>["background" =>  '#50c878',
                        "text" => 'black'],
            "gold" => ["background" => '#d39e00',
                        "text" => 'black'],
            "silver" => ["background" => '#c0c0c0',
                        "text" => 'black'],
            "bronze" =>["background" =>  '#cd7f32',
                        "text" => 'black'],
            "rock" =>["background" =>  '#721c24',
                        "text" => 'black'],
        );
        $params = array(
          "type" => $nameCard
        );
        $sqlHelper= new Db();
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
                    $result .= '<div class="aos" data-aos="fade-down"><a href="/MainList/'.$card["type"].'/'.$card["id"].'"class="card" style="min-width: 740px ; margin-left: 1.5rem; margin-top: 1.5rem; text-decoration: none; color: black; background: linear-gradient(56deg, '.$colors[$card["type"]]["background"].', #fff);" name="'.$type.'" ><div class = "mini-card" style="background: linear-gradient(56deg, '.$colors[$card["type"]]["background"].', #fff);">
                  <div class="row g-0">
                    <span style="max-width: 180px; margin-left: 1rem;">
                      <img src="http://img.youtube.com/vi/'.$link.'/mqdefault.jpg" class="img-fluid rounded-start" style="margin: 0.5rem">
                    </span>
            <div style="margin-left: 1rem; color: '.$colors[$card["type"]]["text"].'">
              <div class="card-body"><h3 class="card-text" style="font-weight: bold; margin-top: 1rem">
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