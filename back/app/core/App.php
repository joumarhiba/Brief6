<?php 


class App 
{
    protected $controller = "ClientController";
    protected $action = "allC";
    protected $params = [];
    
    
    
    
    public function __construct(){
        $this->prepareURL();
        $this->render();
    }
    
    private function prepareURL()
    {
        $get= $_SERVER['REQUEST_URI'];
        $path = ltrim($get, "/");
        $url = explode("/",$path) ;
        
        if(!empty($url)){
            $this->controller = !empty($url[1])? ucwords($url[1])."Controller":"ClientController";
            $this->action = !empty($url[2])? ucwords($url[2]):"allC";
        }
        unset($url[2],$url[2]);

        $this->params = !empty($url) ? array_values($url):[];
    }

    private function render()
    {
        $files = "./app/Controllers/".$this->controller.".php";
        if(file_exists($files))
        {
            require_once "./app/Controllers/".$this->controller.".php";
            $controller = new $this->controller ;
        }
        else{
            echo "This controller : ".$this->controller." doesn't exist";
        }
        if(method_exists($controller,$this->action)){
            call_user_func_array([$controller,$this->action],$this->params);
        }else{
            echo "This method : ".$this->action." doesn't exist";
        }
    }


}


