<?php
include_once 'db.php';

class Instructeur {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function addInstructeur($gebruiker_id, $naam, $telefoon, $beschikbaarheid, $email) {
        $sql = "INSERT INTO instructeur (gebruiker_id, naam, telefoon, beschikbaarheid, email)
                VALUES (?, ?, ?, ?, ?)";
        $this->dbh->execute($sql, [$gebruiker_id, $naam, $telefoon, $beschikbaarheid, $email]);
    
        // Haal het laatst toegevoegde instructeur_id op
        $instructeur_id = $this->dbh->lastInsertId();
    
        // Voeg standaard rooster toe
        $this->voegStandaardRoosterToe($instructeur_id);
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
    public function updateInstructeur($instructeur_id, $gebruiker_id, $naam, $telefoon, $beschikbaarheid, $email) {
        $sql = "UPDATE instructeur 
                SET gebruiker_id = ?, naam = ?, telefoon = ?, beschikbaarheid = ?, email = ?
                WHERE instructeur_id = ?";
        return $this->dbh->execute($sql, [$gebruiker_id, $naam, $telefoon, $beschikbaarheid, $email, $instructeur_id]);
    }


    // Instructeur verwijderen
    public function deleteInstructeur($instructeur_id) {
        $sql = "DELETE FROM instructeur WHERE instructeur_id = ?";
        return $this->dbh->execute($sql, [$instructeur_id]);
    }



public function voegStandaardRoosterToe($instructeur_id) {
    $sql = "
        INSERT INTO rooster (instructeur_id, datum, starttijd, eindtijd)
        SELECT ?, CURDATE() + INTERVAL seq DAY, '09:00:00', '17:00:00'
        FROM (
            SELECT 0 AS seq UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
        ) AS days
        WHERE DAYOFWEEK(CURDATE() + INTERVAL seq DAY) BETWEEN 2 AND 6
    ";
    $this->dbh->execute($sql, [$instructeur_id]);
}
}
?>