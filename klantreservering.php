<?php
include_once 'db.php'; 
include_once 'reservering.php';


$rooms = [];
try {
    
    $sql = "SELECT * FROM room WHERE status = 'available' LIMIT 10";
    
    
    $stmt = $myDb->execute($sql);
    
    
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Fout bij het ophalen van kamers: ' . $e->getMessage();
}


session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $reservering = new Reservering($myDb);
        $lastInsertId = $reservering->addReservering(
            $_POST['naam'], 
            $_POST['email'], 
            $_POST['telefoon'], 
            $_POST['aankomst'], 
            $_POST['vertrek'], 
            $_POST['kamertype'], 
            $_POST['room_id']
        );

        $_SESSION['reservering_id'] = $lastInsertId; // ID opslaan voor later
        header("Location: view_reserveringklant.php");
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

?>

<?php

$currentDate = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Reserveer een Kamer | Hotel Ter Duin</title>
    <link rel="stylesheet" href="kamer.css">
</head>
<body>
<div class="d-flex flex-column align-items-center">
    <h1>Reserveer kamer</h1>
    <form method="POST">
        <div class="mb-3">
            <input type="text" name="naam" placeholder="naam" required class="form-control">
        </div>
        <div class="mb-3">
            <input type="email" name="email" placeholder="email" required class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" name="telefoon" placeholder="telefoon" required class="form-control">
        </div>
        <div class="mb-3">
         
            <input type="date" name="aankomst" placeholder="aankomst" required class="form-control" min="<?= $currentDate; ?>">
        </div>
        <div class="mb-3">
            <
            <input type="date" name="vertrek" placeholder="vertrek" required class="form-control" min="<?= $currentDate; ?>">
        </div>
        <div class="mb-3">
            <label for="kamertype">Kamer Type:</label>
            <select id="kamertype" name="kamertype" required class="form-control">
                <option value="">-- Kies een type --</option>
                <option value="standaard">Standaard Kamer</option>
                <option value="luxe">Luxe Kamer</option>
                <option value="suite">Suite</option>
            </select>
        </div>
        <h3 class="text-center mt-4">Kies een kamer:</h3>

<?php if (empty($rooms)): ?>
    <p class="text-danger text-center">Er zijn momenteel geen beschikbare kamers.</p>
<?php else: ?>
    <div class="row row-cols-2 g-4">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-6">
                <div class="border p-3">
                    <h5>Kamer <?= $room['room_number']; ?></h5>
                    <p>Type: <?= ucfirst($room['type']); ?></p>
                    <p>Prijs per nacht: €<?= number_format($room['price'], 2); ?></p>
                    <input type="radio" name="room_id" value="<?= $room['id']; ?>" required> Selecteer
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

        <input type="submit" class="btn btn-primary">
    </form>
</div>
</body>
</html>
