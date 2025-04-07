<?php
include 'reservering.php';
 
$reservering = new Reservering($myDb);
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $Reservering = $reservering->getReserveringById($id); 
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $naam = $_POST["naam"];
        $email = $_POST["email"];
        $telefoon = $_POST["telefoon"];
        $aankomst = $_POST["aankomst"];
        $vertrek = $_POST["vertrek"];
        $kamertype = $_POST["kamertype"];
       
        $reservering->updateReservering(naam:  $naam, email: $email, telefoon: $telefoon, aankomst: $aankomst, vertrek: $vertrek, kamertype: $kamertype, id: $id); 
        header("Location: view_reservering.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Bewerk Telefoon</title>
</head>
<body>
    <div class="container">
        <h2>Bewerk reservering</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label class="form-label">naam:</label>
                <input type="text" class="form-control" name="naam" value="<?php echo $Reservering['naam']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo $Reservering['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">telefoon:</label>
                <input type="text" class="form-control" name="telefoon" value="<?php echo $Reservering['telefoon']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">aankomst:</label>
                <input type="date" class="form-control" name="aankomst" value="<?php echo $Reservering['aankomst']; ?>" required>
            </div>
        
            <div class="mb-3">
                <label class="form-label">vertrek:</label>
                <input type="date" class="form-control" name="vertrek" value="<?php echo $Reservering['vertrek']; ?>" required>
            </div>
            <div class="mb-3">
    <label for="kamertype">Kamer Type:</label>
            <select id="kamertype" name="kamertype" required>
                <option value="">-- Kies een type --</option><?php echo $Reservering['kamertype']; ?>
                <option value="standaard">Standaard Kamer</option>
                <option value="luxe">Luxe Kamer</option>
                <option value="suite">Suite</option>

            </select>
    </div>
            
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
</body>
</html>
