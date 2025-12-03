<?php

class Database {
    private $host = '127.0.0.1';
    private $db_name = 'room_rent_db';
    private $username = 'root';
    private $password = '';
    private $port = '3306';
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            // First connect without database to check/create it
            $tempConn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port, $this->username, $this->password);
            $tempConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Ensure database exists
            $tempConn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name);
            $tempConn = null; // Close temp connection

            // Now connect to the database
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Run the SQL file to ensure Tables exist
            $sql = file_get_contents(__DIR__ . '/database.sql');
            $this->conn->exec($sql);

        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
