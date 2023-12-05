<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');

/* Datei: controllers/WerbeseiteControllerController.php */
class WerbeseiteControllerController{
    public function index(RequestData $request) {
        return view('index', ['rd' => $request ]);
    }
}