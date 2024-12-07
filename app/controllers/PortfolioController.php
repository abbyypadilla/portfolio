<?php

namespace app\controllers;

use app\models\PortfolioModel;

require_once '../app/models/PortfolioModel.php';


class PortfolioController {

    private $portfolioModel;

    public function __construct() {
        $this->portfolioModel = new PortfolioModel();
    }

    public function viewPortfolio() {
        include './assets/views/projects/portfolio.php';   
    }

    public function getProjects() {
        $projects = $this->portfolioModel->getAllProjects();
        header('Content-Type: application/json');
        echo json_encode($projects);
    }
}



