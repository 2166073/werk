<?php
include_once('les.php');
include_once('db.php');

$les = new Les($myDb);


// if (isset($_GET["les_id"])) {
    // $les_id = $_GET["les_id"];
        $les_id = 4;

    $Les = $les->getLesById($les_id); 
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $datum = $_POST["datum"];
        $ophaallocatie = $_POST["ophaallocatie"];
        $leerling_opmerking = $_POST["leerling_opmerking"];
        $instructeur_opmerking= $_POST["instructeur_opmerking"];

        $les->updateLes( $datum, $ophaallocatie, $leerling_opmerking, $instructeur_opmerking, $les_id); 
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
    <title>Bewerk les</title>
</head>
<body>
    <div class="container">
        <h2>Bewerk les</h2>
        <form method="POST">
            <input type="hidden" name="les_id" value="<?php echo $les_id; ?>">
            <div class="mb-3">
                <label class="form-label">datum:</label>
                <input type="text" class="form-control" name="merk" value="<?php echo $Les['datum']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ophaallocatie:</label>
                <input type="text" class="form-control" name="ophaallocatie" value="<?php echo $Les['ophaallocatie']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">leerling_opmerking:</label>
                <input type="text" class="form-control"  name="leerling_opmerking" value="<?php echo $Les['leerling_opmerking']; ?>" required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">instructeur_opmerking:</label>
                <input type="text" class="form-control" name="instructeur_opmerking" value="<?php echo $Les['instructeur_opmerking']; ?>" required>
            </div>


            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
</body>
</html>