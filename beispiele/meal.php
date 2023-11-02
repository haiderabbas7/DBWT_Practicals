<?php
/**
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
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
//gar keine filter angegeben
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float{
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
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
        <p><?php echo $meal['description']; ?></p>
        <div>Folgende Allergene sind in unserem Gericht enthalten:<ul>
            <?php
                foreach($allergens as $allergen){
                    echo "<li>{$allergen}</li>";
                }?>
            </ul>
        </div>
        <h1>Bewertungen (Insgesamt: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text">
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
                //geht über Array $showRatings und nimmt pro Eintrag die Felder 'text' und 'stars'
                foreach ($showRatings as $rating) {
                    echo    "<tr>
                                <td class='rating_text'>{$rating['text']}</td>
                                <td class='rating_author'>{$rating['author']}</td>
                                <td class='rating_stars'>{$rating['stars']}</td>
                            </tr>";
        }
            ?>
            </tbody>
        </table>
    </body>
</html>