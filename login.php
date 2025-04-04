<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $stmt = $myDb->execute("SELECT * FROM users WHERE username = ?", [$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: view_reservering.php'); 
            exit;
        } else {
            echo "<p style='color:red'>Ongeldige inloggegevens!</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-center">
    <div class="container mt-5">
        <h1>Login</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Gebruikersnaam" class="form-control mb-3" required>
            <input type="password" name="password" placeholder="Wachtwoord" class="form-control mb-3" required>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
        <p class="mt-3">Nog geen account? <a href="accountmaken.php">Maak er één aan</a></p>
    </div>
</body>
</html>
