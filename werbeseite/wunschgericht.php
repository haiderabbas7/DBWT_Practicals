<?php
/**
 * Praktikum DBWT. Autoren:
 * Yannik, Sinthern, 3570151
 * Haider, Abbas, 3567272
 *
 *
 * IDEE:
 * erstmal daten von der Werbeseite empfangen, i guess mit POST
 * dann den ersteller Eintrag mit INSERT schreiben
 * dann die automatisch vergebene ID des neuen Eintrags mit SELECT bekommen
 * und damit dann den neuen Wunschgericht Eintrag mit INSERT erstellen
 */

$link=mysqli_connect("localhost", // Host der Datenbank
    "root",                       // Benutzername zur Anmeldung
    "1234",                       // Passwort
    "emensawerbeseite",           // Auswahl der Datenbanken (bzw. des Schemas)
    3307                              // optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: " . mysqli_connect_error();
    exit();
}

$link->set_charset("utf8");

$temp_name = $_POST['wunschgericht_name'];
if($temp_name == ""){
    $temp_name = "anonym";
}
$temp_email = $_POST['wunschgericht_email'];
$sql_insert_ersteller = "INSERT INTO ersteller (name, email) VALUES ('$temp_name', '$temp_email')";


if (!mysqli_query($link, $sql_insert_ersteller)) {
    echo "Fehler beim Hinzufügen des Eintrags: " . mysqli_error($link);
}

$sql_select_ersteller = "SELECT ersteller_id FROM ersteller WHERE name = '$temp_name'";
$result = mysqli_query($link, $sql_select_ersteller);

if (!$result) {
    echo "Fehler beim Selecten des Eintrags: " . mysqli_error($link);
} else {
    // Fetch the result row as an associative array
    $row = mysqli_fetch_assoc($result);

    // Access the value using the column name
    $ersteller_id = $row['ersteller_id'];

    // Now $ersteller_id contains the value from the SELECT query
}


$temp_titel = $_POST['wunschgericht_titel'];
$temp_beschreibung = $_POST['wunschgericht_beschreibung'];
$sql_insert_wunschgericht = "INSERT INTO wunschgericht (eingetragen_von_ersteller_id, name, erstellungsdatum, beschreibung) VALUES ('$ersteller_id', '$temp_titel', CURRENT_DATE, '$temp_beschreibung')";
if (!mysqli_query($link, $sql_insert_wunschgericht)) {
    echo "Fehler beim Hinzufügen des Eintrags: " . mysqli_error($link);
}


//zeigt die werbeseite am ende, sonst würde die wunschgericht.p
header("Location: werbeseite.php");
exit();