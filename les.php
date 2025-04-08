<?php

class Les {
    private $db;

    // Constructor voor de DB connectie
    public function __construct($db) {
        $this->db = $db;
    }

    // Functie om een les te verwijderen
    public function deleteLes($id, $reden) {
        // Sla de reden op in de verwijderde_lessen tabel
        $query = "INSERT INTO verwijderde_lessen (les_id, reden) VALUES (:id, :reden)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':reden', $reden);
        $stmt->execute();

        // Verwijder de les uit de originele lessen tabel
        $query = "DELETE FROM lessen WHERE les_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>



<?php

class Les {
    private $db;

    // Constructor voor de DB connectie
    public function __construct($db) {
        $this->db = $db;
    }

    // Functie om een les te verwijderen (of markeren als verwijderd)
    public function deleteLes($id, $reden) {
        // Update de les om aan te geven dat deze is verwijderd en voeg de reden toe
        $query = "UPDATE lessen SET reden = :reden, verwijder_datum = NOW() WHERE les_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':reden', $reden);
        $stmt->execute();
    }
}
?>
  <!-- #region 
   verberterd --> <?php

class Les {
    private $db;

    // Constructor voor de DB connectie
    public function __construct($db) {
        $this->db = $db;
    }

    // Functie om een les te verwijderen
    public function deleteLes($id, $reden) {
        // Sla de reden op in de verwijderde_lessen tabel
        $query = "INSERT INTO verwijderde_lessen (les_id, reden) VALUES (:id, :reden)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':reden', $reden);
        $stmt->execute();

        // Verwijder de les uit de originele lessen tabel
        $query = "DELETE FROM lessen WHERE les_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>

