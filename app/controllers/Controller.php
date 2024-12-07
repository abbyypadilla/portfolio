<?php

namespace app\controllers;

abstract class Controller {

    public function returnView($pathToView, $data = []) {
        if (!empty($data)) 
        {
            extract($data);  
        }
        require $pathToView;
        exit();
    }

    public function returnJSON($json) {
        header("Content-Type: application/json");
        echo json_encode($json);
        exit();
    }

    public function notFound() {
        $this->returnView('./assets/views/errors/404.html');
    }

}