<?php

class DB{
    private $dbh;  
    protected $stmt;

    public function __construct($db, $host ="localhost:3306", $user = "root", $pass = "Rasool123!")
    {
        try{
            $this->dbh = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOEXception $e) {
            die("Connection error: " . $e->getMessage());
        }
        
    }

    public function execute($sql, $params = []) {
         
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute($params);
            return $this->stmt;
        
    }
}


$myDb = new DB('toets');
?>