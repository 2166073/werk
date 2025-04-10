<?php
include_once 'db.php';

class Leerling {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    //  Nieuw: plan eerste les als koppeling met instructeur en pakket
    public function planEersteLesMetPakket($leerling_id, $pakket_id, $instructeur_id) {
        $sql = "INSERT INTO les (leerling_id, instructeur_id, pakket_id, datum, ophaallocatie)
                VALUES (?, ?, ?, NOW(), 'Koppeling via dashboard')";
        return $this->dbh->execute($sql, [$leerling_id, $instructeur_id, $pakket_id]);
    }

    public function addLeerling($gebruiker_id, $naam, $achternaam, $geboortedatum, $adres, $opmerking, $ophaallocatie, $telefoon) {
        $sql = "INSERT INTO leerling (gebruiker_id, naam, achternaam, geboortedatum, adres, opmerking, ophaallocatie, telefoon)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->dbh->execute($sql, [$gebruiker_id, $naam, $achternaam, $geboortedatum, $adres, $opmerking, $ophaallocatie, $telefoon]);
    }

    public function getLeerlingById($leerling_id) {
        $sql = "SELECT * FROM leerling WHERE leerling_id = ?";
        $stmt = $this->dbh->execute($sql, [$leerling_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLeerlingByGebruikerId($gebruiker_id) {
        $sql = "SELECT * FROM leerling WHERE gebruiker_id = ?";
        $stmt = $this->dbh->execute($sql, [$gebruiker_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLeerlingByGebruikerId($naam, $achternaam, $geboortedatum, $adres, $telefoon, $gebruiker_id) {
        $sql = "UPDATE leerling SET naam = ?, achternaam = ?, geboortedatum = ?, adres = ?, telefoon = ? WHERE gebruiker_id = ?";
        return $this->dbh->execute($sql, [$naam, $achternaam, $geboortedatum, $adres, $telefoon, $gebruiker_id]);
    }

    public function deleteLeerlingByGebruikerId($gebruiker_id) {
        $sql = "DELETE FROM leerling WHERE gebruiker_id = ?";
        return $this->dbh->execute($sql, [$gebruiker_id]);
    }

    //  Controleer of leerling al gekoppeld is aan een pakket via `les`
    public function checkPakketStatus($leerling_id) {
        $sql = "SELECT COUNT(DISTINCT pakket_id) AS pakketten FROM les WHERE leerling_id = ? AND pakket_id IS NOT NULL";
        $stmt = $this->dbh->execute($sql, [$leerling_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && $row['pakketten'] > 0;
    }

    //  Bereken resterende lessen op basis van gevolgde lessen en pakket
    public function getResterendeLessen($leerling_id) {
        $sql = "SELECT p.aantal_lessen, COUNT(l.les_id) AS gevolgde_lessen
                FROM les l
                JOIN pakket p ON l.pakket_id = p.pakket_id
                WHERE l.leerling_id = ?
                GROUP BY p.pakket_id, p.aantal_lessen
                LIMIT 1";
        $stmt = $this->dbh->execute($sql, [$leerling_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['aantal_lessen'] - (int)$result['gevolgde_lessen'] : null;
    }

    // Alle pakketten ophalen
    public function getBeschikbarePakketten() {
        $sql = "SELECT * FROM pakket";
        $stmt = $this->dbh->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  Alle instructeurs ophalen
    public function getInstructeurs() {
        $sql = "SELECT * FROM instructeur";
        $stmt = $this->dbh->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
