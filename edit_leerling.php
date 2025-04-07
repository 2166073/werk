<?php
include_once('db.php');
include_once('leerling.php');

$leerling = new Leerling($myDb);
$Leerling = null;

if (isset($_GET["leerling_id"])) {
    $leerling_id = $_GET["leerling_id"];
    $Leerling = $leerling->getLeerlingById($leerling_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($leerling_id)) {
    try {
        $opmerking = $_POST["opmerking"];
        // Zorg dat deze methode bestaat in leerling.php
        $leerling->updateOpmerking($opmerking, $leerling_id);
        header("Location: view-leerlingen.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Opmerking Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php if ($Leerling): ?>
        <h2>Opmerking aanpassen voor <?= htmlspecialchars($Leerling['naam']) ?> <?= htmlspecialchars($Leerling['achternaam']) ?></h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Naam:</label>
                <input type="text" class="form-control" value="<?= $Leerling['naam'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Achternaam:</label>
                <input type="text" class="form-control" value="<?= $Leerling['achternaam'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Geboortedatum:</label>
                <input type="date" class="form-control" value="<?= $Leerling['geboortedatum'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Adres:</label>
                <textarea class="form-control" readonly><?= $Leerling['adres'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Opmerking:</label>
                <textarea class="form-control" name="opmerking"><?= htmlspecialchars($Leerling['opmerking']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Ophaallocatie:</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($Leerling['ophaallocatie']) ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">Leerling niet gevonden.</div>
    <?php endif; ?>
</div>
</body>
</html>
