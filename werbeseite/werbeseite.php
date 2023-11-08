<?php
/**
 * Praktikum DBWT. Autoren:
 * Yannik, Sinthern, 3570151
 * Haider, Abbas, 3567272
 */

// AUFGABE 8
include('gerichte.php');
echo "Test";
$schmutz = [
    1 => "rcpt.at",
    2 => "damnthespam.at",
    3 => "wegwerfmail.de",
    4 => "trashmail."
];

$eingabe = fopen("newsletter.txt", 'a');
if (!$eingabe) {
    die("Konnte nicht geöffnet werden");
}

$condition = true;
$status = "";
//Check Vorname
if(isset($_POST['vorname']) && $_POST['vorname'] != ""){
    if(!ctype_alpha($_POST['vorname'])){
        $status .= "FEHLER: Vorname darf nur Buchstaben enthalten. <br>";
        $condition = false;
    }

    $leerzeichenCheck = false;
    for($i = 0; $i < strlen($_POST['vorname']); $i++){
        if($_POST['vorname'][$i] != " "){
            $leerzeichenCheck = true;
            break;
        }
    }
    if(!$leerzeichenCheck){
        $status .= "FEHLER: Vorname enthält unzulässige Zeichen. <br>";
        $condition = false;
    }
}
else{
    $status .= "FEHLER: Bitte geben Sie einen Vornamen ein. <br>";
    $condition = false;
}

//Check Datenschutz
if(!(isset($_POST['datenschutz']) &&  $_POST['datenschutz'] == "akzeptiert")){
    $status .= "FEHLER: Bitte akzeptieren Sie die Datenschutzbestimmungen. <br>";
    $condition = false;
}

//Check E-Mail
if(isset($_POST['email']) && $_POST['email'] != ""){
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $status .= "FEHLER: Bitte geben sie eine korrekte E-Mail Adresse an. <br>";
        $condition = false;
    }
    foreach ($schmutz as $trashmail){
        if(strpos($_POST['email'], $trashmail)){
            $status .= "FEHLER: Trash-Mail identifiziert. Bitte nutzen Sie eine andere E-Mail Adresse. <br>";
            $condition = false;
            break;
        }
    }
}
else{
    $status .= "FEHLER: Bitte geben sie eine E-Mail Adresse an. <br>";
    $condition = false;
}

if($condition && isset($_POST['abgeschickt'])){
    fwrite($eingabe, $_POST['vorname'] . " | " . $_POST['email'] . " | " . $_POST['newsletter-sprache']  . "\n");
    $status = "Alle Daten erfolgreich erfasst!";
}


// AUFGABE 9

// JEDEN BESUCH SPEICHERN
// accesslog.txt öffnen, writing only
$file = fopen('./accesslog.txt', 'a');
// Aktuelle Zeit in timestamp speichern
$timestamp = time();
$datum = date("d.m.Y- H:i", $timestamp);
fwrite($file, "Date: " . $datum . " ");
fwrite($file, "User-Agent: " . $_SERVER["HTTP_USER_AGENT"] . " ");
fwrite($file, "IP: " . $_SERVER['REMOTE_ADDR'] . "\n");
fclose($file);

// ANZAHL BESUCHE ZÄHLEN
// accesslog.txt öffnen, reading only
$file = fopen('accesslog.txt', 'r');
// es kommt immer visits+1 raus, wenn man bei 0 anfängt
// nochmal nachgucken warum immer eins zu viel gezählt wird lulw
$count_visits = -1;
// Solange man noch nicht am Ende des files angekommen ist
while (!feof($file)) {
    $line = fgets($file);
    $count_visits++;
}

// ANZAHL GERICHTE ZÄHLEN
$count_meals = 0;
foreach($gerichte as $gericht){
    $count_meals++;
}

// ANZAHL NEWSLETTER ANMELDUNGEN ZÄHLEN
$file2 = fopen('./newsletter.txt', 'r');
$count_registrations = -1;
while (!feof($file2)) {
    $line = fgets($file2);
    $count_registrations++;
}

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <style>
        * { /*wird erstmal übergeordnet auf alles angewendet*/
            margin: 0; /*default-werte für margin und padding ist immer 0, muss daher immer selber gesetzt werden*/
            padding: 0;
            box-sizing: border-box; /*padding und border werden bei elementen nach innen berechnet*/
            font-family: sans-serif;
        }
        body {
            margin-left: 75px; /*abstand äußerste box bis ende links der website*/
            margin-right: 75px; /*abstand äußerste box bis ende rechts der website*/
            margin-top: 10px; /*abstand äußerste box bis ende der website nach oben hin*/
            border: darkgray 3px solid; /*aussehen äußerster border*/
            width: auto; /*breite des bodys, auto berechnet sich durch rest aus margin-left/right*/
            height: fit-content; /*height nutzt den verfügbaren platz, aber nicht mehr als max-content*/
        }
        a { /*steuert navzeile an an und verändert schrift*/
            font-size: 18px;
            color: #6BD2CE;
        }
        h1 { /*steuert alle h1 überschriften an*/
            font-size: 32px;
            font-weight: bold;
        }
        header { /*steuert menüzeile und bild links daneben an*/
            display: flex; /*positieren elemente in zeilen oder spalten*/
            flex-direction: row; /*hier in zeile positionieren*/
            border-bottom: #D9D9D9 3px solid; /*border nach unten*/
            margin-top: 50px; /*abstand bis zur oberen border*/
            padding-bottom: 10px; /*abstand bis zur unteren border*/
        }
        header > img { /*steuert bild oben links im header an*/
            width: 200px;
            height: 50px;
            border: darkgray 3px solid;
            margin-left: 10px;

        }
        nav { /*steuert navigationsleiste an*/
            margin-left: 10px;
            padding-top: 10px;
            border: darkgray 3px solid;
            width: 1000px; /*width wie main*/
            height: 50px;
        }
        nav ul { /*anordnung der liste in der navleiste*/
            display: flex;
            flex-direction: row;
            list-style-type: none;
        }
        nav ul li { /*abstand zwischen elementen der navleiste auf auto*/
            margin-left: auto;
            margin-right: auto;
        }
        main {
            width: 1000px; /*width wie nav leiste*/
            height: fit-content;
            margin-left: 220px;
            margin-top: 10px;
        }
        main > img {
            width: inherit; /*übernimmt width vom parent*/
            height: 400px;
            border: darkgray 3px solid;
            margin-bottom: 40px;
        }
        #boxaroundp { /*border um lorem ipsum text*/
            border: 1px solid black;
            margin-bottom: 60px;
        }
        #speisen {
            margin-bottom: 60px;
        }
        table, tr, th, td { /*tabelle zu "Köstlichkeiten, die Sie erwarten"*/
            width: 1000px; /*breite tabelle wie main*/
            font-size: 20px;
            border-collapse: collapse; /*damit nicht doppelt umrandet*/
            border: 1px solid black;
            text-align: center;
            margin-bottom: 60px;
        }
        #abschied { /* "Wir freuen uns auf Ihren Besuch!" zentrieren*/
            text-align: center;
        }
        #zahltext {
            display: flex;
            flex-direction: row; /*anordnung der elemente*/
            justify-content: space-around; /*gleichverteilung der 3 elemente*/
            padding-top: 30px; /*abstand von elementen zur überschrift*/
            margin-bottom: 60px;
        }
        #zahltext p { /*steuert die 3 elemente der zahlen an*/
            font-size: 20px;
            font-weight: bold;
        }
        .fieldform {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap; /*sorgt für zeilenumsprung*/
            border: hidden;
            margin-top: 15px;
            margin-bottom: 60px;
        }
        .fieldform div { /*damit zb "Ihr Name:" über der eingabe ist, nicht daneben*/
            display: flex; /*gilt für die oberen 3 elemente der eingabe*/
            flex-direction: column;
        }
        .form * { /*abstand zwischen den eingabefeldern*/
            padding-right: 20px;
        }
        #datenschutzdiv {
            display: flex;
            flex-direction: row;
            margin-top: 15px;
        }
        .wichtig { /*einrückung der unterpunkte bei "Das ist uns wichtig"*/
            margin-left: 200px;
        }
        #wichtigFürUns { /*abstand von den unterpunkten zu "Wir freuen uns..."*/
            margin-bottom: 80px;
        }
        footer { /*obere border bei footer*/
            border-top: #D9D9D9 3px solid;
        }
        footer ul {
            display: flex;
            flex-direction: row;
            list-style-type: none;
            width: fit-content;
            margin: 10px auto; /*oben/unten: 10px und links/rechts: auto*/
        }
        footer ul li {
            margin-right: 10px;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        footer ul li:not(li:last-child) { /*alle Listeneinträge bis auf das letzte haben ne border rechts*/
            border-right: lightgray 2px solid;
        }
    </style>
</head>
<body>
<header>
    <img src="georghoever.jpeg" alt="E-Mensa Logo">
    <nav>
        <ul>
            <li><a href="#ankündigung">Ankündigung</a></li>
            <li><a href="#speisen">Speisen</a></li>
            <li><a href="#zahlen">Zahlen</a></li>
            <li><a href="#kontakt">Kontakt</a></li>
            <li><a href="#wichtigFürUns">Wichtig für uns</a></li>
        </ul>
    </nav>
</header>
<main>
    <img src="mensabild.jpg" alt="Banner">
    <section id="ankündigung">
        <h1>Bald gibt es Essen auch online ;)</h1>
        <p id="boxaroundp">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores veritatis fugit ab magnam nesciunt autem necessitatibus, quia quo cupiditate, ad vel minus nam odit ex! Eum quidem commodi id autem!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, sed. Cupiditate blanditiis minus aperiam corrupti, veniam cumque adipisci quo esse exercitationem aspernatur praesentium fugiat commodi iste, aut nemo voluptas ullam.
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum quam distinctio pariatur soluta fugiat quae, nobis nesciunt, modi labore asperiores maiores minus iusto totam, cumque enim quibusdam accusantium eaque ducimus?
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam aperiam vel debitis ad expedita aliquam sit vero soluta in obcaecati quidem suscipit, quod doloribus eligendi! Dolores assumenda reprehenderit unde incidunt.
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis tempora eligendi aliquam architecto sunt sed, ratione quos doloremque deserunt omnis accusamus quisquam, corrupti ex dicta? Neque nam maiores esse explicabo!
        </p>
    </section>
    <section id="speisen">
        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <!-- tr := "table row (Tabellenzeile)", Zeile kann th und td Elemente enthalten
        th := "table header (Tabellenüberschrift)"
        td := "table data (Tabellendaten)" -->
        <table>
            <tr>
                <td></td>
                <td>Preis intern</td>
                <td>Preis extern</td>
                <td>Bild</td>
            </tr>
            <?php
            foreach($gerichte as $gericht){
                echo '<tr>' .
                    '<td>' . $gericht['name'] . '</td>' .
                    '<td>' . $gericht['preisIntern'] . '</td>' .
                    '<td>' . $gericht['preisExtern'] . '</td>' .
                    '<td> <img src="img/' . $gericht['name'] . '.png" alt="' . $gericht['name'] .'" width="200" height="200"></td>' .
                    '</tr>';
            }
            ?>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
        </table>
    </section>
    <section id="zahlen">
        <h1>E-Mensa in Zahlen</h1>
        <div id="zahltext">
        <p>
            <?php echo $count_visits . " Besuche"; ?>
        </p>
        <p>
            <?php echo $count_registrations . " Anmeldungen zum <br> Newsletter"; ?>
            y Anmeldungen zum <br> Newsletter</p>
        <p>
            <?php echo $count_meals . " Speisen" ?>
        </p>
        </div>
    </section>
    <section id="kontakt">
        <h1>Interesse geweckt? Wir informieren Sie!</h1>
        <form class="form" action="werbeseite.php" method="post">
            <fieldset class="fieldform">
                <div>
                    <label for="name">Ihr Name:</label>
                    <input type="text" id="name" name="vorname" placeholder="Vorname">
                </div>
                <div>
                    <label for="email">Ihr Email:</label>
                    <input type="text" id="email" name="email">
                </div>
                <div>
                    <label for="lang">Newsletter bitte in:</label>
                    <select id="lang" name="newsletter-sprache">
                        <option value="deutsch">Deutsch</option>
                        <option value="englisch">Englisch</option>
                    </select>
                </div>
                <div class="break"></div>
                <div id="datenschutzdiv">
                    <span><input type="checkbox" name="datenschutz" value="akzeptiert"> Den Datenschutzbestimmungen stimme ich zu</span>
                    <span><input type="submit" name="abgeschickt" value="Zum Newsletter anmelden"></span>
                </div>
            </fieldset>
            <?php
            if(isset($_POST['abgeschickt']) && $_POST['abgeschickt'] == "Zum Newsletter anmelden"){
                if($condition){
                    echo "<h3 style='color: green'>" . $status ."</h3>";
                }
                else{
                    echo "<h3 style='color: red'>" . $status ."</h3>";
                }
            }?>
        </form>
    </section>
    <section id="wichtigFürUns">
        <h1>Das ist uns wichtig</h1><br>
        <ul>
            <li class="wichtig">Beste frische saisonale Zutaten</li>
            <li class="wichtig">Ausgewogene abwechslungsreiche Gerichte</li>
            <li class="wichtig">Sauberkeit</li>
        </ul>
    </section>
    <section id="abschied">
        <h1>Wir freuen uns auf Ihren Besuch!</h1><br><br>
    </section>
</main>
<footer>
    <ul>
        <li><p> &copy; E-Mensa GmbH</p></li>
        <li><p> Haider Abbas und Yannik Sinthern</p></li>
        <li><a href="#impressum">Impressum</a></li>
    </ul>
</footer>
</body>
</html>