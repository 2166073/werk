<?php
include 'db.php';

if (isset($_POST["submit"])) {
    $username = $_POST['username'];  
    $Password = password_hash($_POST['Password'], PASSWORD_BCRYPT);

    
    $sql = "INSERT INTO users (username, Password) VALUES (?, ?)"; 

    
    $stmt = $myDb->execute($sql, [$username, $Password]);

    if ($stmt->rowCount() > 0) {
        header("Location: login.php?success");
        exit();
    } else {
        echo "Registratie mislukt!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="rentcar.css">
    
</head>
<body>

<div class="wrapper">
<form method="POST" >
<h1> Account Aanmaken</h1>

    <div class="input-box">
    <input type="text" name="username" placeholder="username" required>
    </div>

    <div class="input-box">
    <input type="password" name="Password" placeholder="Password" required> 
    </div>

    <div class="input-box">
<input type="password" name="herhaal_wachtwoord" placeholder="herhaal_wachtwoord" required> 
    </div>

<input type="submit" class="btn" value="submit" name="submit" onclick="printData()">


</form>
</div>


</body>
</html>