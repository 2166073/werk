<?php
require 'Data/db.php'; // Haalt de databaseverbinding op

if(isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    $data = [
        'username' => $username,
        'password' => $password,
    ];


    $sql = "INSERT INTO login (username, password
    ) VALUES (:username, :password )"; 
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'password' => $password,
    ]);

    if ($stmt->rowCount() > 0) {
        header("Location:medewerkerdash.php?success");
    }

  }
 

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Login</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h1>Welkom in Hotel Luxe</h1>
        <p>Log in om uw reserveringen te bekijken</p>
        <form method="POST">
            <div class="input-box">
                <input type="text" name="username" placeholder="Gebruikersnaam" required>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Wachtwoord" required>
            </div>

            <!-- Dropdown menu voor Klanten/Medewerkers -->
            <div class="input-box">
                <label for="role">Selecteer rol:</label>
                <select name="role" id="role" required>
                    <option value=<a href="klantdash.php">Klant</option>
                    <option value=<a href="medewerkerdash.php">Medewerker</option>
                </select>
            </div>

            <div class="remember-forget">
                <label><input type="checkbox"> Onthoud mij </label>
                <a href="#">Wachtwoord vergeten?</a>
            </div>

            <input type="submit" class="btn" value="Login" name="submit">

            <div class="register-link">
                <p>Geen account? <a href="accountmaken.php">Registreer</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>
