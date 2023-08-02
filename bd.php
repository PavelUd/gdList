<?php
namespace gdlist\www;
use PDO;
class Db
{
    protected $db;
    public function __construct()
    {
        $servername = "localhost";
        $base = "gd_list";
        $username = "root";
        $password = "";
        $this->db = new PDO('mysql:host='.$servername.';dbname='.$base.'', $username, $password);
    }

    public function query($sqlQuery, $params = []) {
        $result = $this->db->prepare($sqlQuery);
        if($params)
        {
            foreach ($params as $key => $value)
            {
                $result->bindValue(':'.$key, $value);
            }
        }
        $result ->execute();
        return $result;
    }
    public function get_rows($sqlQuery,$params = [])
    {
        $result = $this->query($sqlQuery,$params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_row($sqlQuery, $params = [])
    {
        $result = $this->query($sqlQuery, $params);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public function get_column($sqlQuery,$params = [])
    {
        $result = $this->query($sqlQuery,$params);
        return $result->fetchColumn();
    }
}
?>