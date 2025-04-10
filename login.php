<?php
include 'db.php';
include 'Auth.php';
include 'navbar.php'; 

$error = "";

try {
    $db = new DB();
    $auth = new Auth($db);
//
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $wachtwoord = $_POST['wachtwoord'] ?? '';

        $loginResult = $auth->login($email, $wachtwoord);

        if ($loginResult) {
            switch ($loginResult) {
                case 'eigenaar':
                    header('Location: eigenaar/eigenaar-dashboard.php');
                    break;
                case 'leerling':
                    header('Location: leerling/leerling-dashboard.php');
                    break;
                case 'instructeur':
                    header('Location: instructeur/instructeur-dashboard.php');
                    break;
                default:
                    $error = 'Onbekende rol: ' . htmlspecialchars($loginResult);
            }
        } else {
            $error = ' Incorrect e-mailadres of wachtwoord.';
        }
    }
} catch (Exception $e) {
    $error = ' Fout: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css"> 
</head>
<body>

    <form method="POST" action="login.php" autocomplete="off">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <label>E-mail:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Wachtwoord:</label><br>
        <input type="password" name="wachtwoord" required><br><br>

        <button type="submit" name="submit">Inloggen</button>

        <p>Nog geen account? <a href="leerling/registreren.php">Registreer hier</a></p>
    </form>
</body>
</html>
