<?php
    // inkludera föräldern så att man kan ärva
    include_once("_models/Database.php");

    // vi vill göra en klass som ärver från Database.php för att följer Anders kodkonverstion
    // File Model ska ansvara för att allt som har göra med tabellen 'files'
    // T.ex Create, Read, Update, Delete av filer


    // 1. Börja med att göra en tom class 'File' som ärver från Database
    class File extends Database {

        function __construct() {
            // 1. få kontakt med databasen i vår docker-compose
            parent::__construct();
            // 2. gör något extra som är specifikt för File
            $this->setup();
        }

        // Denna metoden ska köras när en FileModel skapas
        // Den ansvara för att starta upp en tabell i databasen om det
        // inte redan finns
        private function setup() {
            // SQL to create table if it does not exist
            $sql = "CREATE TABLE IF NOT EXISTS files (
                id INT AUTO_INCREMENT PRIMARY KEY,
                filename VARCHAR(255) NOT NULL,
                filepath VARCHAR(255) NOT NULL,
                size INT NOT NULL,
                uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `user_id` int(11) NOT NULL,
                KEY `user_id` (`user_id`),
                CONSTRAINT `languages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            )";

            // Execute query
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        }

        public function add_one($fileName, $filePath, $fileSize, $userId) {
            $stmt = $this->db->prepare("INSERT INTO files (filename, filepath, size, user_id) VALUES (?, ?, ?, ?)");  
            $stmt->execute([$fileName, $filePath, $fileSize, $userId]);

            // MySQL returns an id - last insterted Id...
            return $this->db->lastInsertId();
        }

        public function getFilesByUserId($user_id) {
            $stmt = $this->db->prepare("SELECT * FROM files WHERE user_id = ?");  
            $stmt->execute([$user_id]);

            return $stmt->fetchAll();
        }

    }



?>