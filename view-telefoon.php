
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
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
   </style>
</head>
 
 
 
<?php
include 'telefoon.php';
 
$telefoon = new telefoon($myDb);
 
$telefoon = $telefoon->selectAlltelefoon();
 
 
echo "<h1>telefoon overzicht</h1>";
echo "<table border='1'>";
echo "<tr><th>merk</th><th>model</th><th>opslag</th><th>prijs</th></tr>";
 
foreach ($telefoon as $row) {
    echo "<tr>";
    echo "<td>".$row['merk']."</td>";
    echo "<td>".$row['model']."</td>";
    echo "<td>".$row['opslag']."</td>";
    echo "<td>".$row['prijs']."</td>";
    
 
    echo "<td><a href='edit-telefoon.php?ID=".$row['ID']."'>edit</a> | <a href='delete-telefoon.php?ID=".$row['ID']."'>delete</a></td>";
    echo "</tr>";
}
echo "</table>";
 
 
 
 
?>