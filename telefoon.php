<?php
include '../db.php';
   

 
 
 class Telefoon{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;

    }
    public function addtelefoon($merk, $model, $opslag, $prijs)
    {
        return $this->dbh->execute("INSERT INTO telefoon (merk, model, opslag, prijs)
        VALUES (?,?,?,?)",
        [$merk, $model, $opslag, $prijs]);
    }
    public function selectAlltelefoon(){
        return $this->dbh->execute("SELECT * FROM telefoon");
    }
    public function updateTelefoon( $merk, $model, $opslag, $prijs, $ID) {
        $sql = "UPDATE telefoon SET merk = ?,  model = ?,  opslag = ?, prijs= ? WHERE ID = ?";
        return $this->dbh->execute($sql, array($merk, $model, $opslag, $prijs, $ID));
    }
    

    public function getTelefoonById($ID) {
        $sql = "SELECT * FROM telefoon WHERE ID = ?";
        $stmt = $this->dbh->execute($sql, array($ID));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteTelefoon($ID) {
        $sql = "DELETE FROM telefoon WHERE ID = ?";
        return $this->dbh->execute($sql, array($ID));
    }


}


 
?>
 

 
