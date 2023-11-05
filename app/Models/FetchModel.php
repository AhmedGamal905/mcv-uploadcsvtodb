<?php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use dotenv;
use App\DB;
use App\App;

require_once ('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');

class FetchModel {
    protected DB $db;
    protected PDO $dbConnection;
    public function __construct()
    {
        $this->db = App::db();
        $this->dbConnection = DB::getConnection();

    }

   public function fetchFromDb(){
    try {
        $query = 'SELECT * FROM transaction';
        $transactionArray = [];

        foreach ($this->dbConnection->query($query) as $transactions){
            $transactionArray[] = $transactions;
       }
       return $transactionArray;

} catch (PDOException $e) {
    echo $e->getMessage();
}
    }
}