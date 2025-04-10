<?php
session_start();
include '../db.php';

// Controleer of de gebruiker is ingelogd als eigenaar
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'eigenaar') {
    header('Location: login.php');
    exit;
}

$db = new DB();

// Haal alle instructeurs op voor de dropdown
$instructeurs = $db->execute("SELECT instructeur_id, naam FROM instructeur")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO auto (kenteken, merk, model, instructeur_id) VALUES (?, ?, ?, ?)";
        $db->execute($sql, [
            $_POST['kenteken'],
            $_POST['merk'],
            $_POST['model'],
            $_POST['instructeur_id']
        ]);

        $success = "Auto succesvol toegevoegd aan het wagenpark!";
    } catch (Exception $e) {
        $error = "Fout bij het toevoegen van de auto: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Toevoegen - DriveSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="leerling-dashboard.css">

    <style>
        .container { max-width: 600px; margin-top: 50px; }
    </style>
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <h2>DriveSmart</h2>
        <nav>
            <ul>
                <li><a href="eigenaar-dashboard.php">Home</a></li>
                <li><a href="eigenaar-auto-toevoegen.php">Auto toevoegen</a></li>
                <li><a href="eigenaar-wagenpark.php">Wagenpark overzicht</a></li>
                <li><a href="eigenaar-pakket-toevoegen.php">Pakket toevoegen</a></li>
                <li><a href="eigenaar-instructeur-toevoegen.php">Instructeur toevoegen</a></li>
                <li><a href="mededelingen.php">Mededeling</a></li>
                <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="container">
            <h2>Nieuwe Auto Toevoegen</h2>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" class="mt-4">
                <div class="mb-3">
                    <label for="kenteken" class="form-label">Kenteken</label>
                    <input type="text" class="form-control" id="kenteken" name="kenteken" required 
                           pattern="[A-Z0-9-]+" title="Voer een geldig kenteken in (bijv. AB-12-CD)">
                </div>

                <div class="mb-3">
                    <label for="merk" class="form-label">Merk</label>
                    <input type="text" class="form-control" id="merk" name="merk" required>
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" id="model" name="model" required>
                </div>

                <div class="mb-3">
                    <label for="instructeur_id" class="form-label">Toegewezen Instructeur</label>
                    <select class="form-control" id="instructeur_id" name="instructeur_id">
                        <option value="">Selecteer een instructeur</option>
                        <?php foreach ($instructeurs as $instructeur): ?>
                            <option value="<?= $instructeur['instructeur_id'] ?>">
                                <?= htmlspecialchars($instructeur['naam']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Auto Toevoegen</button>
                <a href="eigenaar-wagenpark.php" class="btn btn-secondary">Terug naar Wagenpark</a>
            </form>
        </div>
    </main>
</div>
</body>
</html>