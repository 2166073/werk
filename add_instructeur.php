<?php
include_once '../db.php';
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
            $_POST['telefoon'],
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
    <title>Instructeur Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Nieuwe Instructeur Aanmaken</h1>
    <form method="POST">
        <div class="mb-3">
            <input type="text" name="naam" class="form-control" placeholder="Naam" required>
        </div>
        <div class="mb-3">
            <input type="text" name="telefoon" class="form-control" placeholder="Telefoon" required>
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
</body>
</html>