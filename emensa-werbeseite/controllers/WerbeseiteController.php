<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht_hat_allergen.php');

/* Datei: controllers/WerbeseiteController.php */
class WerbeseiteController
{
    public function index(RequestData $request) {
        $gerichte_sql = db_gericht_limit_5();
        $used_allergens = array();
        foreach ($gerichte_sql as $gericht){
            $current_id = $gericht['id'];
            $used_allergens[] = db_allergen_select_used_allergen($current_id);
        }
        return view('index',
            ['rd' => $request,
             'gerichte_sql' => $gerichte_sql,
             'used_allergens' => $used_allergens]);
    }
}