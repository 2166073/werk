<?php

include 'db.php';


class Reservering {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }


    public function getAvailableRoomsCount() {
        $stmt = $this->dbh->execute("SELECT COUNT(*) AS available_room FROM room WHERE status = 'available'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['available_room'];
    }
}


$reservering = new Reservering($myDb);


$availableRooms = $reservering->getAvailableRoomsCount();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reserveringen Beheer</title>
    <script>
        function printReservations() {
            var printContents = document.getElementById('print-section').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h2>Dashboard Reserveringen Overzicht</h2>
        <a class="btn btn-danger" href="logout.php">Uitloggen</a>
        <button class="btn btn-success" onclick="printReservations()">Lijst afdrukken</button>
        <br><br>

        
        <?php if ($availableRooms <= 2): ?>
            <div class="alert alert-danger">
                 Let op! Er zijn nog maar <?= $availableRooms; ?> kamers beschikbaar!
            </div>
        <?php endif; ?>

        <div id="print-section">
            <h3>Verhuurde Kamers Lijst</h3>
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>E-mail</th>
                    <th>Telefoon</th>
                    <th>Kamer</th>
                    <th>Type</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th>Acties</th>
                </tr>
                <?php foreach ($reservering as $res): ?>
                    <tr>
                        <td><?= $res['id']; ?></td>
                        <td><?= $res['guest_name']; ?></td>
                        <td><?= $res['email']; ?></td>
                        <td><?= $res['phone']; ?></td>
                        <td><?= $res['room_number']; ?></td>
                        <td><?= $res['type']; ?></td>
                        <td><?= $res['check_in']; ?></td>
                        <td><?= $res['check_out']; ?></td>
                        <td><?= ucfirst($res['status']); ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="edit-reservering.php?id=<?= $res['id']; ?>">Bewerken</a>
                            <a class="btn btn-danger btn-sm" href="delete-reservering.php?id=<?= $res['id']; ?>">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
