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

class DbModel
{
    protected DB $db;
    
    protected PDO $dbConnection;

    public function __construct()
    {
        $this->db = App::db();
        
        $this->dbConnection = new PDO(
            'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS']
        );
    }
    
    public function uploadToDb()
    {
        $date = '11/12/2023';
        $reference = '1515';
        $description = 'Tr ref 1';
        $amount = '500';
        $query = 'INSERT INTO transaction (date, reference, description, amount)
        VALUES (:date, :reference, :description, :amount)';
        try {
            $this->dbConnection->beginTransaction();
            $newInputStmt = $this->dbConnection->prepare($query);
            $newInputStmt->execute([
                'date' => $date,
                'reference' => $reference,
                'description' => $description,
                'amount' => $amount,
            ]);

        } catch (PDOException $e) {
            if ($this->dbConnection->inTransaction()) {
                $this->dbConnection->rollBack();
            }
            echo $e->getMessage();
        }
    }
}