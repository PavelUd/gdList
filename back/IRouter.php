<?php

interface IRouter
{
    public function add($route, $param);

    public function match();

    public function run();
}

?>