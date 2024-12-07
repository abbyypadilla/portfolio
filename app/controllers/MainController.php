<?php

namespace app\controllers;

use app\controllers\Controller;

require_once 'Controller.php';

class MainController extends Controller {
    
    public function homepage() {
        $this->returnView('./assets/views/main/homepage.php');
    }

    public function about() {
        $this->returnView('./assets/views/main/about.php');
    }
    
    public function contact() {
        $this->returnView('./assets/views/main/contact.php');
    }

    public function portfolio() {
        $this->returnView('./assets/views/projects/portfolio.php');
    }

    public function register() {
        $this->returnView('./assets/views/users/register.php');
    }

    public function signin() {
        $this->returnView('./assets/views/users/signin.php');
    }

    public function logout() {
        $this->returnView('./assets/views/users/logout.php');
    }
}