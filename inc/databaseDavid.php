<?php

class Database {

    private $host = 'localhost';
    private $dbname = 'webte2';
    private $username = 'xgavendad';
    private $password = 'EAnOsm#$RgpRG1';

    public $conn = null; 

    public function createConnection(){
        try {
            $this->conn = new PDO("mysql:host=". $this->host .";dbname=". $this->dbname,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}

