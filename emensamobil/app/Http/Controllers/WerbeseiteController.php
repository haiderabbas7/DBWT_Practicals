<?php

namespace App\Http\Controllers;

use App\Models\bewertung;
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

        $hervorgehobene_bewertungen = bewertung::getHervorgehobeneBewertungen();
        $gerichtnamen = array();
        $benutzernamen = array();
        $bildernamen_bewertung = array();

        foreach ($gerichte_sql as $gericht){
            $current_id = $gericht->id;
            $used_allergens[] = gericht_hat_allergen::selectUsedAllergen($current_id);
            $bildernamen[] = gericht::getBildname($current_id);
        }

        foreach ($hervorgehobene_bewertungen as $bewertung){
            $gerichtnamen[] = gericht::getName($bewertung->zu_gericht_id);
            $benutzernamen[] = benutzer::getName($bewertung->eingetragen_von_benutzer_id);
            $bildernamen_bewertung[] = gericht::getBildname($bewertung->zu_gericht_id);
        }

        return view('index', [
            'gerichte_sql' => $gerichte_sql,
            'used_allergens' => $used_allergens,
            'bildernamen' => $bildernamen,
            'hervorgehobene_bewertungen' => $hervorgehobene_bewertungen,
            'gerichtnamen' => $gerichtnamen,
            'benutzernamen' => $benutzernamen,
            'bildernamen_bewertung' => $bildernamen_bewertung,
        ]);
    }
}
