<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function debug(RequestData $request) {
        return view('debug');
    }
}