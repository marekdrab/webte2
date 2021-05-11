<?php
class DatabasePeter {
    private $DB_HOST = "localhost";
    private $DB_USER = "xandrejko";
    private $DB_PASS = "rPKR#$5llalehx";
    private $DB_NAME = "webte2finalne";

    public function getConnection(){
        $conn = null;
        try{
            $conn = new PDO("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
            $conn->exec("set names utf8");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $conn;
    }
}