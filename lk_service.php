<?php
namespace gdlist\www;
Class Service
{
    function __construct()
    {
        $this->check();
    }
    public function get_record()
    {
        return "hghghghghg";
    }
    public function create_level()
    {
        return "hjhjhjh";
    }
    private function check()
    {
        if (!isset($_SESSION["name"])) {
            header("Location: /MainList");
        }
    }
}
?>