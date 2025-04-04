<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservering Overzicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .alert {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <button class="btn btn-primary" onclick="window.print()">Print Reservering</button>
    <a href="home.php" class="btn btn-primary">Logout</a><br>
    <a href="aadreservering.php" class="btn btn-primary">Add reservering</a>
</head>
<body>

<?php
include 'reservering.php';


$reservering = new Reservering($myDb);


$reserveringStmt = $reservering->selectAllReservering();


$reserveringData = $reserveringStmt->fetchAll(PDO::FETCH_ASSOC);


$reserveringCount = count($reserveringData);


$totalRooms = 10;  
$availableRooms = $totalRooms - $reserveringCount;  

if ($reserveringCount >= 8) {
    echo "<div class='alert'>Er zijn nog $availableRooms kamer(s) beschikbaar.</div>";
}

echo "<h1>Reservering overzicht</h1>";
echo "<table>";
echo "<tr><th>Naam</th><th>Email</th><th>Telefoon</th><th>Aankomst</th><th>Vertrek</th><th>Kamertype</th><th>Acties</th></tr>";

foreach ($reserveringData as $row) {
    echo "<tr>";
    echo "<td>" . $row['naam'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['telefoon'] . "</td>";
    echo "<td>" . $row['aankomst'] . "</td>";
    echo "<td>" . $row['vertrek'] . "</td>";
    echo "<td>" . $row['kamertype'] . "</td>";
    echo "<td><a href='edit-reservering.php?id=" . $row['id'] . "'>Bewerk</a> | <a href='delete-reservering.php?id=" . $row['id'] . "'>Verwijder</a></td>";
    echo "</tr>";
}

echo "</table>";

?>

</body>
</html>
