<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\FetchModel;
use App\View;

class FetchController {
    private $fetchModel;

    public function __construct() {
        $this->fetchModel = new FetchModel();
    }

    public function fetch() {
        $this->fetchModel->fetchFromDb();
        
    }

    public function retrieveData($transactions){
      echo('<pre>');
      var_dump($transactions);
      echo('<pre>');
    }

//header('Location: /transactions');
    public function transactions(): View
    {
        return View::make('transactions');
    }
}