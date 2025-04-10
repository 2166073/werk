<?php
//connectie
session_start();
include 'db.php';

$db = new DB("drivesmart");

// Controleer of de gebruiker is ingelogd als leerling
if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: login.php");
    exit();
}

// Controleer of les_id is verzonden
if (isset($_POST['les_id'])) {
    $les_id = $_POST['les_id'];

    // Haal de les op die verwijderd moet worden
    $les = $db->execute(
        "SELECT * FROM les WHERE les_id = ?",
        [$les_id]
    )->fetch(PDO::FETCH_ASSOC);

    if (!$les) {
        die("Les niet gevonden.");
    }

    // Verwijder de les uit de les-tabel en verplaats de gegevens naar de verwijderde_lessen-tabel
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reden'])) {
        $reden = $_POST['reden'];

        try {
            // Verplaats de les naar de verwijderde_lessen tabel
            $db->execute(
                "INSERT INTO verwijderd_les (les_id, reden)
                 VALUES (?, ?)",
                [$les['les_id'], $reden]
            );

            // Verwijder de les uit de les-tabel
            $db->execute(
                "DELETE FROM les WHERE les_id = ?",
                [$les_id]
            );

            // Redirect naar een bevestigingspagina of naar de overzichtspagina
            header("Location: leerlingview-les.php");
            exit();
        } catch (PDOException $e) {
            die("Fout bij verwijderen: " . $e->getMessage());
        }
    }
} else {
    die("Geen les gevonden om te verwijderen.");
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Verwijderen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Les Verwijderen</h2>

        <p>Weet je zeker dat je de les van <?= htmlspecialchars($les['les_id'])  ?> wilt verwijderen?</p>

        <form method="POST">
            <input type="hidden" name="les_id" value="<?= $les['les_id'] ?>">

            <div class="form-group">
                <label for="reden">Reden voor verwijdering:</label>
                <textarea name="reden" id="reden" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-danger mt-3">Verwijder Les</button>
            <a href="les_inplannen.php" class="btn btn-secondary mt-3">Annuleer</a>
        </form>
    </div>
</body>
</html>
