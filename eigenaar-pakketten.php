<?php
session_start();
include '../db.php';
include '../navbar.php';

// Controleer of de gebruiker is ingelogd als eigenaar
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'eigenaar') {
    header('Location: login.php');
    exit;
}

$db = new DB();

// Haal alle pakketten op
$pakketten = $db->execute("SELECT * FROM pakket ORDER BY naam")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakketten Overzicht - DriveSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Pakketten Overzicht</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Beheer alle pakketten</h4>
            <a href="eigenaar-pakket-toevoegen.php" class="btn btn-primary">Nieuw Pakket Toevoegen</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pakketnaam</th>
                        <th>Prijs (€)</th>
                        <th>Aantal Lessen</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pakketten as $pakket): ?>
                        <tr>
                            <td><?= htmlspecialchars($pakket['naam']) ?></td>
                            <td><?= htmlspecialchars($pakket['prijs']) ?></td>
                            <td><?= htmlspecialchars($pakket['aantal_lessen']) ?></td>
                            <td>
                                <a href="eigenaar-pakket-bewerken.php?pakket_id=<?= $pakket['pakket_id'] ?>" 
                                   class="btn btn-sm btn-warning">Bewerken</a>
                                <a href="eigenaar-pakket-verwijderen.php?pakket_id=<?= $pakket['pakket_id'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Weet je zeker dat je dit pakket wilt verwijderen?')">Verwijderen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>