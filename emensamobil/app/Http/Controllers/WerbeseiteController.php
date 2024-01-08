<?php

namespace App\Http\Controllers;

use App\Models\gericht;
use App\Models\benutzer;
use App\Models\gericht_hat_allergen;
use Illuminate\Http\Request;

class WerbeseiteController extends Controller
{
    public function werbeseite(Request $request){
        $gerichte_sql = gericht::selectFive();
        $used_allergens = array();
        $bildernamen = array();

        foreach ($gerichte_sql as $gericht){
            $current_id = $gericht->id;
            $used_allergens[] = gericht_hat_allergen::selectUsedAllergen($current_id);
            $bildernamen[] = gericht::getBildname($current_id);
        }
        return view('index', [
            'gerichte_sql' => $gerichte_sql,
            'used_allergens' => $used_allergens,
            'bildernamen' => $bildernamen
        ]);
    }
}
