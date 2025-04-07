<?php
include 'db.php';

if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $herhaalWachtwoord = $_POST['herhaal_wachtwoord'];
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $geboortedatum = $_POST['geboortedatum'];
    $adres = $_POST['adres'];

    if ($wachtwoord !== $herhaalWachtwoord) {
        echo "Wachtwoorden komen niet overeen!";
        exit();
    }

    $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);

    try {
        // Gebruiker toevoegen
        $sql1 = "INSERT INTO gebruiker (email, wachtwoord, rol) VALUES (?, ?, 'leerling')";
        $myDb->execute($sql1, [$email, $hashedWachtwoord]);

        $gebruiker_id = $myDb->lastInsertId();

        // Leerling toevoegen
        $sql2 = "INSERT INTO leerling (gebruiker_id, naam, achternaam, geboortedatum, adres) VALUES (?, ?, ?, ?, ?)";
        $myDb->execute($sql2, [$gebruiker_id, $naam, $achternaam, $geboortedatum, $adres]);

        header("Location: login.php?success");
        exit();
    } catch (PDOException $e) {
        echo "Registratie mislukt: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leerling Registratie</title>
    <link rel="stylesheet" href="rentcar.css">
</head>
<body>

<div class="wrapper">
<form method="POST">
    <h1>Leerling Account Aanmaken</h1>

    <div class="input-box">
        <input type="email" name="email" placeholder="E-mailadres" required>
    </div>

    <div class="input-box">
        <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
    </div>

    <div class="input-box">
        <input type="password" name="herhaal_wachtwoord" placeholder="Herhaal Wachtwoord" required>
    </div>

    <div class="input-box">
        <input type="text" name="naam" placeholder="Voornaam" required>
    </div>

    <div class="input-box">
        <input type="text" name="achternaam" placeholder="Achternaam" required>
    </div>

    <div class="input-box">
        <input type="date" name="geboortedatum" required>
    </div>

    <div class="input-box">
        <textarea name="adres" placeholder="Adres" required></textarea>
    </div>

    <input type="submit" class="btn" value="Registreren" name="submit">
</form>
</div>

</body>
</html>
