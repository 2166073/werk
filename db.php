<?php

class DB{
    private $dbh;  
    protected $stmt;

    public function __construct($db = "drivesmart", $host ="localhost:3306", $user = "root", $pass = "")
    {
        try{
            $this->dbh = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOEXception $e) {
            die("Connection error: " . $e->getMessage());
        }

    }

    
    public function getConnection() {
        return $this->dbh;
    }


    public function execute($sql, $params = []) {

            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute($params);
            return $this->stmt;

    }
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
    
    
    
}


$myDb = new DB("drivesmart");
?>