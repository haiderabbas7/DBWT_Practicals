<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
//Folgender Code ist dazu da, alle Dateien im Models ordner zu includieren, anstatt dass man pro datei immer ne extra zeile wie oben schreiben muss
$directory = $_SERVER['DOCUMENT_ROOT'] . '/../models/';
$files = glob($directory . '*.php');

foreach ($files as $file) {
    require_once $file;
}

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function debug(RequestData $request) {
        return view('debug');
    }
}