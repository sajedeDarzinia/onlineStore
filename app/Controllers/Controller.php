<?php namespace App\Controllers;

use App\Core\Application;

class Controller 
{
    public string $layout = 'Main';

    public function setLayout($layout){
        $this -> layout = $layout;
    }

    public function render($view , $params=[]){
        return Application::$app->router->renderView($view , $params);
    }

    public function renderModel($model)
    {
        include_once Application::$ROOT_DIR."/app/Models/$model.php";
    }

    
}