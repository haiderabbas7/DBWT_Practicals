<?php
/**
 * Praktikum DBWT. Autoren:
 * Yannik, Sinthern, 3570151
 * Haider, Abbas, 3567272
 */

$link = mysqli_connect(
    "localhost",
    "root",
    "1234", //PW bei mir ist 1234
    "emensawerbeseite",
    3307); //hab bei mir Port 3307, bei dir safe 3306

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}




$sql = "SELECT name AS Gerichtname, erfasst_am FROM gericht ORDER BY Gerichtname DESC;";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}


echo "<table border='1'><tr><th>Gerichtname</th><th>erfasst_am</th></tr>";
while($row = mysqli_fetch_assoc($result)){
    echo "<tr><td>". $row['Gerichtname'] . "</td><td>" . $row['erfasst_am'] . "</tr>";
}
echo "</table>";

mysqli_free_result($result);
mysqli_close($link);