<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\PortfolioController;
use app\controllers\UserController;

require_once '../app/controllers/Controller.php';
require_once '../app/controllers/MainController.php';
require_once '../app/controllers/PortfolioController.php';
require_once '../app/controllers/ContactController.php';
require_once '../app/controllers/UserController.php';

class Router {
    public $urlArray;

    function __construct() {
        $this->urlArray = $this->routeSplit();
        $this->handleMainRoutes();
        $this->handlePortfolioRoutes();  
        $this->handlePageRoutes();
        $this->handleContactRoutes();  
        $this->handleUserRoutes();
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    protected function handleMainRoutes() {
        if ($this->urlArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
        }
    }

    protected function handlePortfolioRoutes() {
        if ($this->urlArray[1] === 'portfolio' && count($this->urlArray) === 2 && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $portfolioController = new PortfolioController();
            $portfolioController->viewPortfolio();   
        }
    
        if ($this->urlArray[1] === 'portfolio' && isset($this->urlArray[2]) && $this->urlArray[2] === 'data' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $portfolioController = new PortfolioController();
            $portfolioController->getProjects();   
        }
    }
    
    protected function handleContactRoutes() {
        if ($this->urlArray[1] === 'contact' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactController = new \app\controllers\ContactController();
            $contactController->submitContactForm();
        }
    }

    protected function handleUserRoutes() {
        if ($this->urlArray[1] === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController = new UserController();
            $userController->registerUser($_POST['username'], $_POST['email'], $_POST['password']);
        }

        if ($this->urlArray[1] === 'signin' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController = new UserController();
            $userController->loginUser();
        }
    }    

    protected function handleLogoutRoute() {
        if ($this->urlArray[1] === 'signin' && isset($_GET['logout']) && $_GET['logout'] === 'true') {
            $userController = new UserController();
            $userController->logout();
        }
    }

    protected function handlePageRoutes() {
        $mainController = new MainController();

        if ($this->urlArray[1] === 'about' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController->about();
        }

        if ($this->urlArray[1] === 'contact' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController->contact();
        }

        if ($this->urlArray[1] === 'register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController->register();
        }

        if ($this->urlArray[1] === 'signin' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController->signin();
        }
    }
}

