<?php
include_once 'db.php';
include 'instructeur.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // 1. Gebruiker toevoegen
        $email = $_POST['email'];
        $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_BCRYPT);

        $sqlGebruiker = "INSERT INTO gebruiker (email, wachtwoord, rol) VALUES (?, ?, 'instructeur')";
        $myDb->execute($sqlGebruiker, [$email, $wachtwoord]);

        $gebruiker_id = $myDb->lastInsertId();

        // 2. Instructeur toevoegen
        $instructeur = new Instructeur($myDb);
        $instructeur->addInstructeur(
            $gebruiker_id,
            $_POST['naam'],
            $_POST['telefoonnummer'],
            $_POST['beschikbaarheid'],
            $_POST['email']
        );

        header("Location: eigenaar-dashboard.php");
    } catch (Exception $e) {
        echo 'Fout bij toevoegen: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructeur Toevoegen - DriveSmart</title>
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
        <div class="container mt-4">
            <h1>Nieuwe Instructeur Aanmaken</h1>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="naam" class="form-control" placeholder="Naam" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="telefoonnummer" class="form-control" placeholder="Telefoonnummer" required>
                </div>
                <div class="mb-3">
                    <textarea name="beschikbaarheid" class="form-control" placeholder="Beschikbaarheid" required></textarea>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="E-mailadres" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="wachtwoord" class="form-control" placeholder="Wachtwoord" required>
                </div>
                <button type="submit" class="btn btn-primary">Toevoegen</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>