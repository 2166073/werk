<?php
include_once 'db.php';




class Instructeur {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    // Instructeur toevoegen
    public function addInstructeur($gebruiker_id, $naam, $telefoonnummer, $beschikbaarheid, $opmerking) {
        $sql = "INSERT INTO instructeur (gebruiker_id, naam, telefoonnummer, beschikbaarheid, opmerking)
                VALUES (?, ?, ?, ?, ?)";
        return $this->dbh->execute($sql, [$gebruiker_id, $naam, $telefoonnummer, $beschikbaarheid, $opmerking]);
    }
    
    // Alle instructeurs ophalen
    public function selectAllInstructeurs() {
        return $this->dbh->execute("SELECT * FROM instructeur");
    }

    // Eén instructeur ophalen op basis van ID
    public function getInstructeurById($instructeur_id) {
        $sql = "SELECT * FROM instructeur WHERE instructeur_id = ?";
        $stmt = $this->dbh->execute($sql, [$instructeur_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Instructeur bijwerken
    public function updateInstructeur($instructeur_id, $gebruiker_id, $naam, $telefoonnummer, $beschikbaarheid, $opmerking) {
        $sql = "UPDATE instructeur 
                SET gebruiker_id = ?, naam = ?, telefoonnummer = ?, beschikbaarheid = ?, opmerking = ?
                WHERE instructeur_id = ?";
        return $this->dbh->execute($sql, [$gebruiker_id, $naam, $telefoonnummer, $beschikbaarheid, $opmerking, $instructeur_id]);
    }
    

    // Instructeur verwijderen
    public function deleteInstructeur($instructeur_id) {
        $sql = "DELETE FROM instructeur WHERE instructeur_id = ?";
        return $this->dbh->execute($sql, [$instructeur_id]);
    }
}
?>
