<?php
Class Frame
{
    function get_header()
    {
        $result = ' <header class="site-header sticky-top py-3">
  <nav class="container d-flex flex-column flex-md-row justify-content-between" style="font-size: large">
    <div class="btn-group col-8 mx-auto" role="group" aria-label="Basic outlined example">
      <a type="button" class="btn btn-outline-dark" href="?page=MainList"><b>Main List</b></a>
      <a type="button" class="btn btn-outline-dark" href="?page=LegacyList"><b>Legacy List</b></a>
      <a type="button" class="btn btn-outline-dark"><b>Extended List</b></a>
    </div>
    <a style="text-decoration: none; font-family: Georgia" class="btn btn-outline-dark" href="#"><b>Sign up</b></a>
    </nav>
</header>';
        return $result;
    }
}
?>