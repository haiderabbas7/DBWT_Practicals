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

$showRatings = []; // leeres Array erstellen, das später die gefilterten Bewertungen speichern wird
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {     // wenn ein Suchbegriff in der URL übergeben wurde
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT]; // wird dieser in $searchTerm gespeichert
    foreach ($ratings as $rating) {             // durch $ratings iterieren
        if (stripos($rating['text'], $searchTerm) !== false) { // Falls $searchTerm im text vorkommt
            $showRatings[] = $rating;                          // wird diese Bewertung dem Array hinzugefügt
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else { // Falls die Eingabe leer ist wird nicht gefiltert
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings); // count gibt Anzahl der Elemente im Array zurück
    }
    return $sum;
}

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
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

        <h1>Gericht: <?php echo $meal['name']; ?></h1>

        <p><?php if ($show_description) {
                echo $meal['description'];
            } ?></p>

        <!-- Allergene, die im Gericht enthalten sind ausgeben -->
        <div>Folgende Allergene sind in unserem Gericht enthalten:
            <ul>
                <?php
                foreach ($meal['allergens'] as $allergen => $value) { // (array as value)
                    echo "<li>$allergens[$value]</li>";
                }
                ?>
            </ul>
        </div>

        <h1>Bewertungen (Insgesamt: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php if (isset($_GET[GET_PARAM_SEARCH_TEXT])) {
                        echo $_GET[GET_PARAM_SEARCH_TEXT];           // Wenn search_text gesetzt ist
                    } else {                                         // weiterhin das gesetzte Wort übergeben
                        echo "";                                     // Ansonsten leeres Wort nutzen
                    } ?>">
            <input type="submit" value="Suchen">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td>Autor</td>
                <td>Sterne</td>
            </tr>
            </thead>
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