<?php
include_once 'db.php';
include_once 'instructeur.php';

$instructeur = new Instructeur($myDb);

if (isset($_GET['instructeur_id'])) {
    $instructeur_id = $_GET['instructeur_id'];
    $data = $instructeur->getInstructeurById($instructeur_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $opmerking = $_POST['opmerking'];
        // oude waarden behouden voor update (readonly data)
        $gebruiker_id = $data['gebruiker_id'];
        $naam = $data['naam'];
        $telefoonnummer = $data['telefoonnummer'];
        $beschikbaarheid = $data['beschikbaarheid'];

        $instructeur->updateInstructeur(
            $instructeur_id,
            $gebruiker_id,
            $naam,
            $telefoonnummer,
            $beschikbaarheid,
            $opmerking
        );

        header("Location: view_instructeur.php");
        exit;
    } catch (PDOException $e) {
        echo "Fout bij updaten: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Opmerking Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Opmerking aanpassen voor <?= htmlspecialchars($data['naam']) ?></h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Naam:</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($data['naam']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefoonnummer:</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($data['telefoonnummer']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Beschikbaarheid:</label>
            <textarea class="form-control" readonly><?= htmlspecialchars($data['beschikbaarheid']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Opmerking:</label>
            <textarea name="opmerking" class="form-control"><?= htmlspecialchars($data['opmerking']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
</body>
</html>
