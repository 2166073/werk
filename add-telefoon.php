<?php

include 'telefoon.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
        $telefoon = new telefoon($myDb);
        $telefoon->addTelefoon($_POST['merk'], $_POST['model'], $_POST['opslag'], $_POST['prijs']);
        header("Location: view-telefoon.php");
    } catch (Exception $e) {
        echo 'Error' . $e->getMessage();
        }
}


 

 
 
    ?>
 

<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<html lang="en">
<head> 
   
</head>
<body>
<div class="d-flex flex-column align-items-center">
    <h1>Telefoon toevoegen</h1>
    <form method="POST">
    <div class="mb-3">
        <input type="text" name="merk" placeholder="merk" required>
    </div>
    <div class="mb-3">
        <input type="text" name="model" placeholder="model" required>
    </div>
    <div class="mb-3">
        <input type="text" name="opslag" placeholder="opslag" required>
    </div>
    <div class="mb-3">
        <input type="text" name="prijs" placeholder="prijs" required>
    </div>
        <input type="submit" class="btn btn-primary">
    </form>
    </div>

</body>

 
   

 

</html>