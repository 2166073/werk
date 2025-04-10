<?php
session_start();
require_once 'db.php';

// Alleen toegankelijk voor eigenaren
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'eigenaar' || !isset($_SESSION['rol_id'])) {
    header('Location: login.php');
    exit;
}

$db = new DB();
$pdo = $db->getConnection(); 

$feedback = "";

// Formulierverwerking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inhoud = $_POST['inhoud'] ?? '';
    $gebruiker_id = $_POST['gebruiker_id'] ?? '';
    $datum = date("Y-m-d H:i:s");

    if ($inhoud && $gebruiker_id) {
        try {
            $stmt = $pdo->prepare("INSERT INTO mededeling (inhoud, gebruiker_id, datum) VALUES (?, ?, ?)");
            $stmt->execute([$inhoud, $gebruiker_id, $datum]);
            $feedback = "<div class='alert alert-success'>Mededeling toegevoegd.</div>";
        } catch (PDOException $e) {
            $feedback = "<div class='alert alert-danger'>Fout: " . $e->getMessage() . "</div>";
        }
    } else {
        $feedback = "<div class='alert alert-warning'>Vul alle velden in.</div>";
    }
}

// Haal gebruikers op voor het dropdown-menu
$gebruikers = $pdo->query("SELECT gebruiker_id, rol FROM gebruiker ORDER BY rol")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mededeling Toevoegen - DriveSmart</title>
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
        <div class="container mt-5" style="max-width: 700px;">
            <h2 class="mb-4">Mededeling Toevoegen</h2>
            <?= $feedback ?>

            <form method="POST" class="bg-light p-4 border rounded shadow-sm">
                <div class="mb-3">
                    <label for="inhoud" class="form-label">Bericht</label>
                    <textarea name="inhoud" id="inhoud" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="gebruiker_id" class="form-label">Bestemd voor</label>
                    <select name="gebruiker_id" id="gebruiker_id" class="form-select" required>
                        <option value="">Kies gebruiker</option>
                        <?php foreach ($gebruikers as $gebruiker): ?>
                            <option value="<?= $gebruiker['gebruiker_id'] ?>">
                                <?= htmlspecialchars($gebruiker['rol']) ?> (ID: <?= $gebruiker['gebruiker_id'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Opslaan</button>
            </form>

            <div class="text-center mt-4">
                <a href="eigenaar-dashboard.php" class="btn btn-secondary">Terug naar Dashboard</a>
            </div>
        </div>
    </main>
</div>
</body>
</html>