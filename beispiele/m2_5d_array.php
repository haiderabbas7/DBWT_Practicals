<?php
/**
 * Praktikum DBWT. Autoren:
 * Yannik, Sinthern, 3570151
 * Haider, Abbas, 3567272
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];


function noWinner($famousMeals) : void{
    for($i = 2000; $i < 2024; $i++){
        //Reset der Bedingung
        $condition = false;

        //Durchlaufen aller Einträge und Setzen der Bedingung, falls gefunden
        foreach($famousMeals as $meal){
            if(gettype($meal['winner']) == 'integer'){
                if($i == $meal['winner']){
                    $condition = true;
                    break;
                }
            }
            else if(in_array($i, $meal['winner'])){
                $condition = true;
                break;
            }
        }

        //Ausgabe des Datums falls Bedingung gesetzt wurde
        if(!$condition){
            if($i == 2023){
                echo $i;
            }
            else {
                echo $i . ", ";
            }
        }
    }
}
?>
<html lang="de">
<head>
    <title>Werbeseite</title>
    <style>
        li{
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
<div>
    <ol>
        <?php
            foreach($famousMeals as $meal){
                //Rückwärts-Zusammensetzen des Strings $jahre durch Fallunterscheidung int-array
                $jahre = "";
                if(gettype($meal['winner']) == 'integer'){
                    $jahre = $meal['winner'];
                }
                else {
                    for ($i = count($meal['winner']) - 1; $i >= 0; $i--) {
                        if ($i == 0) {
                            $jahre .= $meal['winner'][$i];
                        }
                        else{
                            $jahre .= $meal['winner'][$i] . ", ";
                        }
                    }
                }

                //Ausgabe der Daten als Listenelemente
                echo "<li>" . $meal['name'] . "<br>" . $jahre . "</li>";
            }
        ?>
    </ol>
</div>
<h3>In den Jahren <?php noWinner($famousMeals)?> gab es keine Gewinner.</h3>
</body>
</html>