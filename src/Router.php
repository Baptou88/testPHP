<?php

namespace App;

use AltoRouter;

class Router  
{
    /**
     * @var Altorouter
     */
    private AltoRouter $aRouter;
    
    /**
     * @var String
     */
    private string $viewPath;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->aRouter = new AltoRouter();
    }

    public function get(string $url,string $view, ?string $name = null):self
    {
        $this->aRouter->map('GET', $url , $view , $name);
        return $this;
    }

    public function run()
    {
        $match = $this->aRouter->match();
        ob_start();
        if ($match) {
            $view = $match['target'];
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
            
        } else {
            require $this->viewPath . DIRECTORY_SEPARATOR . "404.php";
        }
        $content = ob_get_clean();
        require $this->viewPath . DIRECTORY_SEPARATOR . "layouts/default.php";
    }

    public function generate(string $routeName, array $Params =[]): string
    {
        return $this->aRouter->generate($routeName , $Params);
    }
        

}
