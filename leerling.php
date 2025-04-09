<?php
// leerling.php
include_once('db.php');

class Leerling {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function addLeerling($gebruiker_id, $naam, $achternaam, $geboortedatum, $adres, $opmerking, $ophaallocatie) {
        $sql = "INSERT INTO leerling (gebruiker_id, naam, achternaam, geboortedatum, adres, opmerking, ophaallocatie)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->dbh->execute($sql, [$gebruiker_id, $naam, $achternaam, $geboortedatum, $adres, $opmerking, $ophaallocatie]);
    }

    public function getLeerlingById($leerling_id) {
        $sql = "SELECT * FROM leerling WHERE leerling_id = ?";
        $stmt = $this->dbh->execute($sql, [$leerling_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLeerling($naam, $achternaam, $geboortedatum, $adres, $opmerking, $ophaallocatie, $leerling_id) {
        $sql = "UPDATE leerling SET naam = ?, achternaam = ?, geboortedatum = ?, adres = ?, opmerking = ?, ophaallocatie = ? WHERE leerling_id = ?";
        return $this->dbh->execute($sql, [$naam, $achternaam, $geboortedatum, $adres, $opmerking, $ophaallocatie, $leerling_id]);
    }

    public function updateOpmerking($opmerking, $leerling_id) {
        $sql = "UPDATE leerling SET opmerking = ? WHERE leerling_id = ?";
        return $this->dbh->execute($sql, [$opmerking, $leerling_id]);
    }
    

    public function getAllLeerlingen() {
        $sql = "SELECT * FROM leerling";
        return $this->dbh->execute($sql);
    }
}
?>
