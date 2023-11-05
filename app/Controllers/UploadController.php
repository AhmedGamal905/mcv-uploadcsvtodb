<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UploadModel;

class UploadController
{
    private $uploadModel;

    public function __construct()
    {
        $this->uploadModel = new UploadModel();
    }
    public function upload()
            {
                $filePath= STORAGE_PATH . '/' . $_FILES['csvFile']['name'];

                move_uploaded_file(
                    $_FILES['csvFile']['tmp_name'],
                    $filePath
                );
                $files = scandir(STORAGE_PATH);
          
                $filteredFiles = array_filter($files, function ($file) {
                    
                    return $file !== '.' && $file !== '..' && $file !== '.gitignore';
                    
                });
                
                $fileName = reset($filteredFiles);
                $csvData = [];
                if (($h = fopen(STORAGE_PATH . '/' . $fileName, "r")) !== false) {
                    fgetcsv($h, 1000, ",");
                    
                    while (($data = fgetcsv($h, 1000, ",")) !== false) {
                        $csvData[] = $data;
                    }
                    
                    fclose($h);
                }
                    $this->uploadModel->uploadToDb($csvData);
}
}
