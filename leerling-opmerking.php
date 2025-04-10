<?php
session_start();
include '../db.php';

$db = new DB();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'leerling') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['les_id'])) {
    die("Geen les opgegeven.");
}

$les_id = $_GET['les_id'];

$leerling = $db->execute(
    "SELECT leerling_id FROM leerling WHERE gebruiker_id = ?",
    [$_SESSION['gebruiker_id']]
)->fetch(PDO::FETCH_ASSOC);

if (!$leerling) {
    die("Leerling niet gevonden.");
}

$leerling_id = $leerling['leerling_id'];

$les = $db->execute(
    "SELECT leerling_opmerking FROM les WHERE les_id = ? AND leerling_id = ?",
    [$les_id, $leerling_id]
)->fetch(PDO::FETCH_ASSOC);

if (!$les) {
    die("Les niet gevonden of je hebt geen toegang tot deze les.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nieuwe_opmerking = $_POST['leerling_opmerking'];

    $db->execute(
        "UPDATE les SET leerling_opmerking = ? WHERE les_id = ? AND leerling_id = ?",
        [$nieuwe_opmerking, $les_id, $leerling_id]
    );

    header("Location: leerling_viewles.php?succes=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Opmerking Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/leerling-dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <h2>DriveSmart</h2>
        <nav>
            <ul>
                <li><a href="leerling-dashboard.php">Home</a></li>
                <li><a href="leerlingview-les.php">Les rooster</a></li>
                <li><a href="leerling-lesinplannen.php">Les inplannen</a></li>
                <li><a href="leerling-profiel.php">Profiel</a></li>
                <li><a href="view_mededelingenleerling.php">Mededeling</a></li>
                <li><a href="logout.php">Afmelden</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="container mt-5">
            <h2>Opmerking Bewerken</h2>

            <form method="POST">
                <div class="mb-3">
                    <label for="leerling_opmerking" class="form-label">Opmerking</label>
                    <textarea class="form-control" id="leerling_opmerking" name="leerling_opmerking" rows="4" required><?= htmlspecialchars($les['leerling_opmerking']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Opslaan</button>
                <a href="leerlingview-les.php" class="btn btn-secondary">Annuleren</a>
            </form>
        </div>
    </main>
</div>

</body>
</html>
