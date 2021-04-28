<?php

require_once "config.php";

class Database
{

    public $conn;

    /**
     * @return mixed
     */
    public function getConnection()
    {
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . DB_HOST.";dbname=". DB_NAME, DB_USER, DB_PASS);
            $this->conn->exec("set names utf8");
        }catch (PDOException $e){
            echo "database error" . $e->getMessage();
        }
        return $this->conn;
    }

    /**
     * @return mixed
     */
    public function getQuery($query)
    {
        $db = new Database();
        $db->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}