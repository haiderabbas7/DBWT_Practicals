<?php
/**
- Praktikum DBWT. Autoren:
- Yannik, Sinthern, 3570151
- Haider, Abbas, 3567272
*/
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text'; // Texteingabe bei filter
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';

$show_description = 1; // standardmäßig die Beschreibung anzeigen

// Überprüfen, ob der GET-Parameter show_description existiert und den Wert 0 hat
if (isset($_GET[GET_PARAM_SHOW_DESCRIPTION]) && ($_GET[GET_PARAM_SHOW_DESCRIPTION] == 0)) {
    $show_description = 0; // Wenn show_description = 0 ist, die Beschreibung nicht anzeigen
}

// Statische Texte in verschiedenen Sprachen
$language_de = [
        "Gericht" => "Gericht",
        "Bewertung" => "Bewertung",
        "Autor" => "Autor",
        "Begründung" => "Begründung",
        "Suchen" => "Suchen",
        "Sterne" => "Sterne",
        "Preis_intern" => "interner Preis",
        "Preis_extern" => "externer Preis"
];
$language_en = [
        "Gericht" => "Meal",
        "Bewertung" => "Rating",
        "Autor" => "Author",
        "Begründung" => "Reason",
        "Suchen" => "Search",
        "Sterne" => "Stars",
        "Preis_intern" => "internal Price",
        "Preis_extern" => "external Price"
];
// Sprache standardmäßig auf Deutsch setzen
$language_used = $language_de; // Änderung: Standardmäßig auf Deutsch setzen

if (isset($_GET['sprache']) && $_GET['sprache'] == 'en') {
    $language_used = $language_en; // Änderung: Bei Auswahl von "en" auf Englisch umschalten
}
* Praktikum DBWT. Autoren:
* Yannik, Sinthern, 3570151
* Haider, Abbas, 3567272
*/
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

<<<<<<< HEAD
$showRatings = [];
//falls beim Filter für den Suchbegriff-Namen 'search_text' etwas eingegeben wurde
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])){
    //$searchTerm ist der Filterbegriff
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (stripos($rating['text'], $searchTerm) !== false) {
            $showRatings[] = $rating;
        }
    }
//falls beim Filter für den Suchbegriff-Namen 'search_min_stars' etwas eingegeben wurde
=======
$showRatings = []; // leeres Array erstellen, das später die gefilterten Bewertungen speichern wird
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {     // wenn ein Suchbegriff in der URL übergeben wurde
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT]; // wird dieser in $searchTerm gespeichert
    foreach ($ratings as $rating) {             // durch $ratings iterieren
        if (stripos($rating['text'], $searchTerm) !== false) { // Falls $searchTerm im text der bewertung vorkommt
            $showRatings[] = $rating;                          // wird diese Bewertung dem Array hinzugefügt
        }
    }
>>>>>>> yannik
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
<<<<<<< HEAD
//gar keine filter angegeben
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float{
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
=======
} else { // Falls die Eingabe leer ist wird nicht gefiltert
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings); // count gibt Anzahl der Elemente im Array zurück
>>>>>>> yannik
    }
    return $sum;
}

<<<<<<< HEAD
=======
// Überprüfen, ob der GET-Parameter "whatrating" existiert und TOP-Bewertungen anzeigen soll
if (isset($_GET['whatrating']) && $_GET['whatrating'] == 'top') {
    // Logik, um TOP-Bewertungen anzuzeigen (zum Beispiel nur Bewertungen mit 4 oder 5 Sternen)
    // array_filter itertiert über ratings und fügt die Elemente zu showRatings hinzu, die
    // die Bedingung >= 4 erfüllen
    function isHighRating($rating) : bool {
        return $rating['stars'] >= 4;
    }
    $showRatings = array_filter($ratings, 'isHighRating');
}

// Überprüfen, ob der GET-Parameter "whatrating" existiert und FLOPP-Bewertungen anzeigen soll
if (isset($_GET['whatrating']) && $_GET['whatrating'] == 'flop') {
    // Logik, um FLOPP-Bewertungen anzuzeigen (zum Beispiel nur Bewertungen mit 1 oder 2 Sternen)
    // array_filter itertiert über ratings und fügt die Elemente zu showRatings hinzu, die
    // die Bedingung <= 2 erfüllen
    function isLowRating($rating) : bool {
        return $rating['stars'] <= 2;
    }
    $showRatings = array_filter($ratings, 'isLowRating');
}

>>>>>>> yannik
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <!-- Sprache im title wechseln -->
        <title><?php
            echo $language_used['Gericht'] . ": " . $meal['name']; ?>
        </title>
        <style>
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
    <!-- Schaltflächen zum wechseln der Sprache
     für "lang" entweder "de" oder "en" geschickt -->
    <a href="meal.php?sprache=de">de</a> <!-- Änderung: Link für Deutsch -->
    <a href="meal.php?sprache=en">en</a> <!-- Änderung: Link für Englisch -->

        <!-- Sprache im header wechseln -->
        <h1><?php
            echo $language_used['Gericht'] . ": " . $meal['name']; ?>
        </h1>

        <p><?php if ($show_description) {
                echo $meal['description'];
            } ?></p>

        <!-- Allergene, die im Gericht enthalten sind ausgeben -->
        <div>Folgende Allergene sind in unserem Gericht enthalten:
            <ul>
                <?php
                // $allergen => value, dann greife ich mit value direkt auf den zahlenwert des allergens zu
                foreach ($meal['allergens'] as $allergen => $value) { // (array as value)
                    echo "<li>$allergens[$value]</li>";
                }
                ?>
            </ul>
        </div>


        <?php
            /* left und right operand werden addiert, hier left + 0
             * mit scale bestimmt man Anzahl der Nachkommastellen
             * bcadd = binary calculator add
             */
            echo $language_used['Preis_intern'] . ": " . bcadd($meal["price_intern"], '0', 2) . "€";
            echo "<br>";
            echo $language_used['Preis_extern'] . ": " . bcadd($meal["price_extern"], '0', 2) . "€";
        ?>

        <!-- Sprache wechseln im header zu den Bewertungen -->
        <h1><?php
            echo $language_used['Bewertung'] . " (Insgesamt: " . calcMeanStars($ratings); ?>)
        </h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text"
                   value="<?php if (isset($_GET[GET_PARAM_SEARCH_TEXT])) {
                        echo $_GET[GET_PARAM_SEARCH_TEXT];  // Wenn search_text gesetzt ist
                    } else {                                // weiterhin das gesetzte Wort übergeben
                        echo "";                            // Ansonsten leeres Wort nutzen
                    } ?>">
            <input type="submit" value="<?php echo $language_used['Suchen'] ?>">
        </form>

        <!-- TOP/FLOPP Bewertungen anzeigen -->
        <form method="get" action="meal.php">
            <input type="submit" name="whatrating" value="top"> <!-- Schaltfläche für TOP Bewertungen -->
            <input type="submit" name="whatrating" value="flop"> <!-- Schaltfläche für FLOPP Bewertungen -->
        </form>

    <!-- tr := "table row (Tabellenzeile)", Zeile kann th und td Elemente enthalten
     th := "table header (Tabellenüberschrift)"
     td := "table data (Tabellendaten)" -->
    <table class="rating">
            <!-- thead definiert kopfzeile von tabelle -->
            <thead>
            <tr>
                <td><?php echo $language_used['Begründung']?></td>
                <td><?php echo $language_used['Autor']?></td>
                <td><?php echo $language_used['Sterne']?></td>
            </tr>
            </thead>
            <!-- tbody enthält hauptdateninhalt der tabelle -->
            <tbody>
            <?php
        foreach ($showRatings as $rating) { // (array as value), iteriert durch alle ratings in showRatings
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_text'>{$rating['author']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    </body>
</html>