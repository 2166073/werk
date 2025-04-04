<?php
include 'data/db.php';

 class Boek{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;

    }
    public function addBoeking($naam, $achternaam, $email, $telefoonnummer, $aankomst, $vertrek)
    {
        return $this->dbh->execute("INSERT INTO boeking (naam, achternaam, email, telefoonnummer, aankomst, vertrek)
        VALUES (?,?,?,?,?,?,?)",
        [$naam, $achternaam, $email, $telefoonnummer, $aankomst, $vertrek]);
    }
    public function selectAllBoeking(){
        return $this->dbh->execute("SELECT * FROM boeking");
    }
    public function updateBoeking($naam, $achternaam, $email, $telefoonnummer, $aankomst, $vertrek, $ID) {
        $sql = "UPDATE boeking SET naam = ?, achternaam = ?, email = ?,  telefoonnummer = ?, aankomst = ?, vertrek= ? WHERE ID = ?";
        return $this->dbh->execute($sql, array($naam, $achternaam, $email, $telefoonnummer, $aankomst, $vertrek, $ID));
    }
    

    public function getBoekingById($ID) {
        $sql = "SELECT * FROM boeking WHERE ID = ?";
        $stmt = $this->dbh->execute($sql, array($ID));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteBoeking($ID) {
        $sql = "DELETE FROM boeking WHERE ID= ?";
        return $this->dbh->execute($sql, array($ID));
    }


}


 
?>
 
