<?php
/**
 * Praktikum DBWT. Autoren:
 * Yannik, Sinthern, 3570151
 * Haider, Abbas, 3567272
 */

include 'm2_5a_standardparameter.php';
    $c = 0;
    if(!empty($_GET['operator_eins'])) {
        if(!empty($_GET['choice']) && $_GET['choice'] == 'Addieren')
            $c = addieren($_GET['operator_eins'], $_GET['operator_zwei']);
        else if(!empty($_GET['choice']) && $_GET['choice'] == 'Multiplizieren'){
            $c = ($_GET['operator_eins'] * $_GET['operator_zwei']);
        }
    }
?>
<html lang="de">
<head>
    <title>Werbeseite</title>
</head>
<body>
    <form method="get">
        <label for="operator_eins">Geben Sie den ersten Operator ein.</label><br>
        <input id="operator_eins" type="text" name="operator_eins" placeholder="$a" required><br><br>
        <label for="operator_zwei">Geben Sie den zweiten Operator ein. (LEER = 0)<br></label>
        <input id="operator_zwei" type="text" name="operator_zwei" placeholder="$b" ><br><br>
        <input type="submit" name="choice" value="Addieren">
        <input type="submit" name="choice" value="Multiplizieren">
    </form>
    <p>Das Ergebnis lautet: <?php echo $c?></p>
</body>
</html>