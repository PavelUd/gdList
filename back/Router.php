<?php
namespace gdlist\www\back;
require_once 'back\IRouter.php';
class Router implements \IRouter
{
    protected $paths = [];
    protected $params = [];
    public function __construct()
    {
        $paths = require "configs/paths.php";
        foreach ($paths as $path => $param)
        {
            $this->add($path, $param);
        }
    }
    public function add($path, $param)
    {$path = '#^'.$path.'$#';

        $this->paths[$path] = $param;
    }
    public function match()
    {
        $url = trim($_SERVER["REQUEST_URI"], '/');
        foreach ($this->paths as $route => $param)
        {
            if (preg_match($route, $url, $matches))
            {
                $this->params = $param;
                return true;
            }
        }
        return false;
    }
    public function run()
    {
        if($this->match()){
           $path = 'gdlist\www\\'.ucfirst($this->params['controller']);
           if (class_exists($path))
           {
               $method = $this->params["action"];
               if (method_exists($path, $method))
               {
                   $class = new $path;
                   if (isset($this->params["params"])) {
                       $params = $this->params["params"];
                       return $class->$method($params);
                   }
                   else {
                       return $class->$method();
                   }
               }
           }
        }
    }
}
?>
