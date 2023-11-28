<?php
/**
 * Praktikum DBWT. Autoren:
 * Yannik, Sinthern, 3570151
 * Haider, Abbas, 3567272
 */

$gefunden = false;
$button = false;

// en.txt im read only Modus öffnen
$file = fopen('en.txt', 'r');

// Solange man noch nicht am Ende des files angekommen ist
while (!feof($file)) {
    // über fgets wird eine line aus der .txt in $line gespeichert
    $line = fgets($file);

    // wenn search_text gesetzt ist
    if (isset($_GET['search_text'])) {
        // Überprüft ob search_text in der line enthalten ist
        if (str_contains($line, $_GET['search_text'])) {
            // explode erstellt ein array, [0] ist Element vor ";", [1] das Element dahinter
            $found = explode(";", $line);

            echo "Die Übersetzung für " . $found[0] . " ist " . $found[1];
            $gefunden = true;
        }
    }
}
if (isset($_GET['search_text'])) {
    if (!$gefunden) {
        echo "Das gesuchte Wort " . $_GET['search_text'] . " ist nicht enthalten ";
    }
}
fclose($file);
?>

<html lang="de">
<form method="get">
    <label for="search_text"> Eingabe:</label>
    <input id="search_text" type="text" name="search_text">
</form>
</html>