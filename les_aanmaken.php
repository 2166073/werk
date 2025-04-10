<?php
include 'db.php';
$db = new DB();
$leerling = $db->execute("SELECT leerling_id, naam, achternaam FROM leerling")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="instructeur-dashboard.css">
    <link rel="stylesheet" href="les_aanmaken.css">
    <title>Les aanmaken</title>
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
        <li><a href="les_aanmaken.php">Les aanmaken</a></li>
        <li><a href="mankement_melden.php">Mankement melden</a></li>
        <li><a href="kilometerstand_invoeren.php">Kilometerstand invoeren</a></li>
        <li><a href="view_mededeling.php">Mededeling</a></li>
        <li><a href="instructeur_ziekmelden.php">Ziekmelden</a></li>
        <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <h2>Nieuwe Les Aanmaken</h2>
        <form action="verwerk_les.php" method="post">
            Datum: <input type="date" name="datum" required><br>
            Ophaallocatie: <input type="text" name="ophaallocatie" required><br>
            opmerking: <input type="text" name="instructeur_opmerking" required><br>
            Pakket: <input type="text" name="pakket" required><br>

            Leerling:
            <select name="leerling_id" required>
                <option value="">Selecteer een leerling</option>
                <?php foreach ($leerling as $l): ?>
                    <option value="<?= $l['leerling_id'] ?>"><?= htmlspecialchars($l['naam'] . ' ' . $l['achternaam']) ?></option>
                <?php endforeach; ?>
            </select><br>

            <input type="submit" value="Les Aanmaken">
        </form>
    </main>
</div>
</body>
</html>