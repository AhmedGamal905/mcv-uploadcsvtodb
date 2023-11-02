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
        $transactions = $this->fetchModel->fetchFromDb();
        echo('<Pre>');
        var_dump($transactions);
        echo('<Pre>');
    }

//header('Location: /transactions');
    public function transactions(array $transactions): View
    {
        return View::make('transactions');
    }
}