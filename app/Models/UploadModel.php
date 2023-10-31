<?php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use dotenv;
use App\View;
use App\DB;
use App\App;

require_once ('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');

class UploadModel
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
    
    public function uploadToDb($csvData)
    {
        $query = 'INSERT INTO transaction (date, reference, description, amount)
        VALUES (:date, :reference, :description, :amount)';
        try {
            $this->dbConnection->beginTransaction();
            foreach ($csvData as $transaction) {
                $newInputStmt = $this->dbConnection->prepare($query);
                $newInputStmt->execute([
                    'date' => $transaction[0],
                    'reference' => $transaction[1],
                    'description' => $transaction[2],
                    'amount' => $transaction[3],
                ]);
            }

            $this->dbConnection->commit();
            
            header('Location: /successful');

        } catch (PDOException $e) {
            if ($this->dbConnection->inTransaction()) {
                $this->dbConnection->rollBack();
            }
            echo $e->getMessage();
        }
    }
    public function successful(): View
    {
        return View::make('successful');
    }
}