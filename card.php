<?php
namespace gdlist\www;
class Card
{
    private $id;
    private $info;
    private $records;
    private $fps;
    public function construct($id)
    {
        $db = new Db();
        $params = array(
            'id' => $this->id
        );
        $this->records = $db->get_rows("
            select lr.*, m.name from level_records lr 
        join members m on lr.player_id = m.id   
         where level_id = :id", $params);
        $this->info = $db->get_row("select * from levels where id = :id", $params);
        $this->fps =  $this->info["FPS"] ?  $this->info["FPS"] : "Any";
    }
    function get_media($id)
    {
        $this->id = $id;
        $this->construct($id);
        extract($this->info);
        $points = $this->get_level_points();
        $result = '<div style="margin-top: 1rem; margin-left: 1rem; text-align: center"><h2 style="font-weight: bold;">'.$name.'</h2>';
        $result .= '<h4 style="font-weight: bold;">'.$Account.'</h4>';
        $result .= '<div style="text-align: center; margin-top: 1rem">';
        $result .= '<video
        id="vid'.$this->id.'"
        class="video-js  vjs-theme-fantasy"
        controls
        width="640" height="324"
        data-setup=\'{
        "techOrder": ["youtube"], "sources": [{
            "type": "video/youtube", "src": "https://www.youtube.com/watch?v='.$link.'"}] }\'
>
</video></div>';

        $result .= ' <div style=" margin-top: 1rem; justify-content: center; display: flex"><div class="col-md-6"><table class="table table-borderless">
                    <tr>
                    <th>FPS: '.$this->fps.'</th>
                    <th>Points: '.$points.'</th>
                    </tr>
                    </table></div></div>';
        $result .= $this->get_results_table();
        return $result;
    }
    private function get_results_table()
    {
        $table = '<h2 style="font-weight: bold; margin-top: 1rem">Records</h2>
                        <div style=" margin-top: 1rem; justify-content: center; display: flex">
                    <div class="col-md-6">
                    <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Record Holder</th>
                        <th scope="col">Video Proof</th>
                   </tr>
                    </thead>
                    <tbody>
                    <tr>';
        for ($i = 0; $i < count($this->records);$i++)
        {
            $link = $this->records[$i]["video_proof"] ? '<a href="'.$this->records[$i]["video_proof"].'">':"";
            $table .= '<td>'.$this->records[$i]["name"].'</td>
                    <td>'.$link.'video</a></td>
                    </tr>';
                    }
        $table .='</tbody>
                    </table>
                    </div></div></div>';
        return $table;
    }
    private function get_level_points()
    {
        $jsonFilePath = 'level_types.json';
        $jsonString = file_get_contents($jsonFilePath);
        $levelTypes = json_decode($jsonString, true);
        return $levelTypes[$this->info["type"]];
    }
}