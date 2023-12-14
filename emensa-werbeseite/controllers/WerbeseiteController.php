<?php

//require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');

// Folgender Code ist dazu da, alle Dateien im Models Ordner zu inkludieren,
// anstatt dass man pro Datei immer eine extra Zeile wie oben schreiben muss
$directory = $_SERVER['DOCUMENT_ROOT'] . '/../models/';
$files = glob($directory . '*.php');

foreach ($files as $file) {
    require_once $file;
}


class WerbeseiteController
{

    public function index(RequestData $request) {
        //session_unset();
        //session_destroy();

        //$link = connectdb();
        //mysqli_begin_transaction($link);
        //var_dump(  db_get_id("admin@emensa.example", "72924ce2ad839c265c32405d57278fcc36d20112", $link));

        $logger = logger('main');
        $logger->info('Zugriff auf die Hauptseite');

        $gerichte_sql = db_gericht_limit_5();
        $used_allergens = array();
        $bildernamen = array();

        foreach ($gerichte_sql as $gericht){
            $current_id = $gericht['id'];
            $used_allergens[] = db_allergen_select_used_allergen($current_id);
            $bildernamen[] = db_get_bildname($current_id);
        }

        return view('index', [
            'rd' => $request,
            'gerichte_sql' => $gerichte_sql,
            'used_allergens' => $used_allergens,
            'bildernamen' => $bildernamen
        ]);
    }
}
