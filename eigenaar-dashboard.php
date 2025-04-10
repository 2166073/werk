<?php
include_once '../db.php';
include_once  '../instructeur/instructeur.php';
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

        header("Location: view_instructeur.php");
    } catch (Exception $e) {
        echo 'Fout bij toevoegen: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Eigenaar Dashboard</title>
    <link rel="stylesheet" href="../css/instructeur-dashboard.css">
    <link rel="stylesheet" href="../css/eigenaar-dashboard.css">
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
        <h1>Welkom op het Eigenaar Dashboard</h1>
        <p>Kies een optie uit het menu of voeg nieuwe gegevens toe.</p>
    </main>
</div>
</body>
</html>