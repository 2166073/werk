<?php
include 'Data/data.php';
 
$boek = new Boek($myDb);
if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    $boek = $boek->getBoekingById($ID); 
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $naam = $_POST["naam"];
        $achternaam = $_POST["achternaam"];
        $email = $_POST["email"];
        $telefoonnummer = $_POST["telefoonnummer"];
        $aankomst = $_POST["aankomst"];
        $vertrek = $_POST["vertrek"];
        
       
        $boek->updateBoeking(naam:  $naam, achternaam: $achternaam, email: $email, telefoonnummer: $telefoonnummer, aankomst: $aankomst, vertrek: $vertrek, ID: $ID); 
        header("Location: view-boekingen.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/edit-boek.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Bewerk reservering</title>
</head>
<body>
    <div class="container">
        <h2>Bewerk reservering</h2>
        <form method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="mb-3">
            <label>Naam:</label>
                <input type="text" name="naam" placeholder="Uw naam" required>

                <label>Achternaam:</label>
                <input type="text" name="achternaam" placeholder="Uw achternaam" required>

                <label>Email:</label>
                <input type="email" name="email" placeholder="Uw email" required>

                <label>Telefoonnummer:</label>
                <input type="text" name="telefoonnummer" placeholder="Uw telefoonnummer" required>

                <label>Aankomstdatum:</label>
                <input type="date" name="aankomst" required>

                <label>Vertrekdatum:</label>
                <input type="date" name="vertrek" required>

            </select>
    </div>
            
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
</body>
</html>
