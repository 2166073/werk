<?php
session_start();
include 'db.php';
include 'navbar.php';

// Controleer of de gebruiker is ingelogd als eigenaar
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'eigenaar') {
    header('Location: login.php');
    exit;
}

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO pakket (naam, prijs, aantal_lessen) VALUES (?, ?, ?)";
        $db->execute($sql, [
            $_POST['naam'],
            $_POST['prijs'],
            $_POST['aantal_lessen']
        ]);

        $success = "Pakket succesvol toegevoegd!";
    } catch (Exception $e) {
        $error = "Fout bij het toevoegen van het pakket: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakket Toevoegen - DriveSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 600px; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nieuw Pakket Toevoegen</h2>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="naam" class="form-label">Pakketnaam</label>
                <input type="text" class="form-control" id="naam" name="naam" required>
            </div>

            <div class="mb-3">
                <label for="prijs" class="form-label">Prijs (€)</label>
                <input type="number" step="0.01" class="form-control" id="prijs" name="prijs" required>
            </div>

            <div class="mb-3">
                <label for="aantal_lessen" class="form-label">Aantal Lessen</label>
                <input type="number" class="form-control" id="aantal_lessen" name="aantal_lessen" required>
            </div>

            <button type="submit" class="btn btn-primary">Pakket Toevoegen</button>
            <a href="eigenaar-pakketten.php" class="btn btn-secondary">Terug naar Overzicht</a>
        </form>
    </div>
</body>
</html>