<?php
include 'db.php';
   

 
 
 class Reservering{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;

    }
    public function addReservering($naam, $email, $telefoon, $aankomst, $vertrek, $kamertype, $room_id)
    {
        $sql = "INSERT INTO reservering (naam, email, telefoon, aankomst, vertrek, kamertype, room_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->dbh->execute($sql, [$naam, $email, $telefoon, $aankomst, $vertrek, $kamertype, $room_id]);
        return $this->dbh->lastInsertId(); // Voeg dit toe om ID terug te geven
    }
        public function selectAllreservering(){
        return $this->dbh->execute("SELECT * FROM reservering");
    }
    public function updateReservering( $naam, $email, $telefoon, $aankomst, $vertrek, $kamertype, $id) {
        $sql = "UPDATE reservering SET naam = ?, email = ?, telefoon = ?, aankomst = ?, vertrek = ?, kamertype = ? WHERE id = ?";
        return $this->dbh->execute($sql, array($naam, $email, $telefoon, $aankomst, $vertrek, $kamertype, $id));
    }
    

    public function getReserveringById($id) {
        $sql = "SELECT * FROM reservering WHERE id = ?";
        $stmt = $this->dbh->execute($sql, array($id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteReservering($id) {
        $sql = "DELETE FROM reservering WHERE id = ?";
        return $this->dbh->execute($sql, array($id));
    }

    public function getAvailableRoomsCount() {
        $stmt = $this->dbh->execute("SELECT COUNT(*) AS available_room FROM room WHERE status = 'available'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['available_room'];
    }
    public function updateRoomStatus($roomId, $status) {
        $sql = "UPDATE room SET status = :status WHERE id = :room_id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':room_id', $roomId);
        return $stmt->execute(); 
    }

    
    


}


 
?>