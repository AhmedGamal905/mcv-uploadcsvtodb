<?php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use dotenv;
use App\View;
use App\DB;
use App\App;
use App\Controllers\FetchController;

require_once ('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');

class FetchModel {
    protected DB $db;
    protected PDO $dbConnection;

    private $fetchController;

    public function __construct()
    {
        $this->db = App::db();      
        $this->dbConnection = new PDO(
            'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
        $this->fetchController = new FetchController();
    }

 
   public function fetchFromDb(){
    try {
       $query = 'SELECT * FROM transaction';

       foreach ($this->dbConnection->query($query) as $transactions){
        echo '<pre>';
        var_dump($transactions);
        echo '<pre>';
       }

    //Pass data from here
    // $this->fetchController->whateverfunction(data);
} catch (PDOException $e) {
    if ($this->dbConnection->inTransaction()) {
        $this->dbConnection->rollBack();
    }
    echo $e->getMessage();
}
    }
}