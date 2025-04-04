<?php
include_once('telefoon.php');
 
$telefoon = new Telefoon($myDb);
if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    $Telefoon = $telefoon->getTelefoonById($ID); 
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $merk = $_POST["merk"];
        $model = $_POST["model"];
        $opslag = $_POST["opslag"];
        $prijs = $_POST["prijs"];
       
        $telefoon->updateTelefoon( $merk, $model, $opslag, $prijs, $ID); 
        header("Location: view-telefoon.php");
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
        <h2>Bewerk Telefoon</h2>
        <form method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="mb-3">
                <label class="form-label">merk:</label>
                <input type="text" class="form-control" name="merk" value="<?php echo $Telefoon['merk']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">model:</label>
                <input type="text" class="form-control" name="model" value="<?php echo $Telefoon['model']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">opslag:</label>
                <input type="text" class="form-control" name="opslag" value="<?php echo $Telefoon['opslag']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">prijs:</label>
                <input type="text" class="form-control" name="prijs" value="<?php echo $Telefoon['prijs']; ?>" required>
            </div>
        
            
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
</body>
</html>
