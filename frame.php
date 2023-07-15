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
    <a style="text-decoration: none; font-family: Georgia" class="btn btn-outline-dark" href="#"><b>Sign up</b></a>
    </nav>';
      $result .= ' <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large; margin-bottom: 1rem"><div class="btn-group col-12 mx-auto" role="group" aria-label="Basic outlined example" id="header" onclick="get_info(event)">
                    <button type="button" class="btn btn-outline-danger" style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-gold" name = "gold" style="font-weight: bold">gold</button>
                    <button type="button" class="btn btn-outline-dark" style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-primary" style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-diamond" name="diamond" style="font-weight: bold">diamond</button>
                    <button type="button" class="btn btn-outline-success"  style="font-weight: bold">' . $value . '</button>
                    <button type="button" class="btn btn-outline-secondary" style="font-weight: bold">' . $value . '</button>
</div></nav></header>';
        return $result;
    }
}
?>