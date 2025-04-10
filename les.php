<?php
include_once 'db.php';

class Les {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function addLes($leerling_id, $instructeur_id, $datum, $ophaallocatie, $leerling_opmerking, $instructeur_opmerking) {
        $sql = "INSERT INTO les (leerling_id, instructeur_id, datum, ophaallocatie, leerling_opmerking, instructeur_opmerking)
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->dbh->execute($sql, [$leerling_id, $instructeur_id, $datum, $ophaallocatie, $leerling_opmerking, $instructeur_opmerking]);
    }

    public function getLesById($les_id) {
        $sql = "SELECT * FROM les WHERE les_id = ?";
        $stmt = $this->dbh->execute($sql, [$les_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateleerling_Opmerking($leerling_opmerking, $les_id) {
        $sql = "UPDATE les SET leerling_opmerking = ? WHERE les_id = ?";
        return $this->dbh->execute($sql, [$leerling_opmerking, $les_id]);
    }
    public function updateLes( $datum, $ophaallocatie, $leerling_opmerking, $instructeur_opmerking, $les_id) {
        $sql = "UPDATE les SET datum = ?,  ophaallocatie = ?,  leerling_opmerking = ?, instructeur_opmerking= ? WHERE les_id = ?";
        return $this->dbh->execute($sql, array($datum, $ophaallocatie, $leerling_opmerking, $instructeur_opmerking, $les_id));
    }
    public function deleteLes($les_id) {
        $sql = "DELETE FROM les WHERE id = ?";
        return $this->dbh->execute($sql, array($les_id));
    }

 public function getAllLessen() {
        $sql = "SELECT * FROM les";
        return $this->dbh->execute($sql);
    }
}
?>