<?php
include '../db.php';
session_start();

// Check of instructeur is ingelogd
if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: ../login.php");
    exit();
}

$db = new DB("drivesmart");

// Haal alle leerlingen op
$leerlingen = $db->execute("SELECT leerling_id, naam, achternaam FROM leerling")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Les Aanmaken</title>
    <link rel="stylesheet" href="instructeur-dashboard.css">
    <link rel="stylesheet" href="../css/les_aanmaken.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #04AA6D;
        }
        .form-container label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            background-color: #04AA6D;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #039f65;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <h2>DriveSmart</h2>
        <nav>
            <ul>
                <li><a href="instructeur-dashboard.php">Home</a></li>
                <li><a href="week_rooster.php">Week rooster</a></li>
                <li><a href="dag_rooster.php">Dag rooster</a></li>
                <li><a href="les_aanmaken.php" class="active">Les aanmaken</a></li>
                <li><a href="lessen_bekijken.php">Les bewerken</a></li>
                <li><a href="mankement_melden.php">Mankement melden</a></li>
                <li><a href="kilometerstand_invoeren.php">Kilometerstand invoeren</a></li>
                <li><a href="view_mededeling.php">Mededeling</a></li>
                <li><a href="instructeur_ziekmelden.php">Ziekmelden</a></li>
                <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="form-container">
            <h2>Nieuwe Les Aanmaken</h2>
            <form action="verwerk_les.php" method="post">
                <label for="datum">Datum:</label>
                <input type="date" id="datum" name="datum" required min="<?= date('Y-m-d'); ?>">

                <label for="starttijd">Starttijd:</label>
                <input type="time" id="starttijd" name="starttijd" required>

                <label for="eindtijd">Eindtijd:</label>
                <input type="time" id="eindtijd" name="eindtijd" required>

                <label for="ophaallocatie">Ophaallocatie:</label>
                <input type="text" id="ophaallocatie" name="ophaallocatie" required>

                <label for="instructeur_opmerking">Opmerking (instructeur):</label>
                <input type="text" id="instructeur_opmerking" name="instructeur_opmerking" required>

                <label for="pakket">Pakket:</label>
                <input type="text" id="pakket" name="pakket" required>

                <label for="leerling_id">Leerling:</label>
                <select id="leerling_id" name="leerling_id" required>
                    <option value="">Selecteer een leerling</option>
                    <?php foreach ($leerlingen as $leerling): ?>
                        <option value="<?= $leerling['leerling_id'] ?>">
                            <?= htmlspecialchars($leerling['naam'] . ' ' . $leerling['achternaam']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Les Aanmaken">
            </form>
        </div>
    </main>
</div>
</body>
</html>
