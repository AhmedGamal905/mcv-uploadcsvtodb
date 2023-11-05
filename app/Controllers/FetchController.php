<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\FetchModel;
use App\View;

class FetchController
{
    private $fetchModel;

    public function __construct()
    {
        $this->fetchModel = new FetchModel();
    }

    public function fetch(): View
    {
        $transactionsArray = $this->fetchModel->fetchFromDb();
        return View::make('transactions', ['transactions' => $transactionsArray]);
    }
}