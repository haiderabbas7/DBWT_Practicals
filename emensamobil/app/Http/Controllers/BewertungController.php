<?php

namespace App\Http\Controllers;

use App\Models\bewertung;
use App\Models\gericht;
use App\Models\gericht_hat_allergen;
use App\Models\benutzer;
use App\Models\kategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BewertungController extends Controller
{
    public function bewertung(Request $request){
        //die ID aus der URL
        $id = $request->query('id');

        //Fall nicht eingelogged
        if(!isset($_SESSION['login_ok']) || $_SESSION['login_ok'] == false){
            //damit man nach dem redirect zurückkommt zu profil
            session(['url.intended' => "/bewertung?id=$id"]);
            return redirect('/anmeldung');
        }
        else{
            $gerichtname = gericht::getName($id);
            $bildname = gericht::getBildname($id);
            return view("bewertung", [
                'id' => $id,
                'gerichtname' => $gerichtname,
                'bildname' => $bildname
            ]);
        }
    }

    public function bewertung_verifizieren(Request $request){
        //die ID aus der URL
        $id = $request->query('id');

        //Fall nicht eingelogged
        if(!isset($_SESSION['login_ok']) || $_SESSION['login_ok'] == false){
            //damit man nach dem redirect zurückkommt zu profil
            session(['url.intended' => "/bewertung?id=$id"]);
            return redirect('/anmeldung');
        }

        $bemerkung = $request->input('bemerkung');
        $sterne_bewertung = $request->input('sterne_bewertung');

        //Fall fehlerhafte Eingabe => redirect zurück zum gleichen bewertungsformular und setz Fehler
        if(strlen($bemerkung) < 5){
            $_SESSION['bewertung_fehler'] = true;
            return redirect("/bewertung?id=$id");
        }
        //Fall korrekte Eingabe => In DB eintragen und zurück auf Startseite
        else{
            $_SESSION['bewertung_fehler'] = false;
            bewertung::createBewertung($_SESSION['user_id'], $id, $bemerkung, $sterne_bewertung);
            return redirect("/");
        }
    }

    public function bewertungen(){
        $bewertungen = bewertung::getLastThirtyBewertungen();
        $gerichtnamen = array();
        $benutzernamen = array();
        $bildernamen = array();
        foreach ($bewertungen as $bewertung){
            $gerichtnamen[] = gericht::getName($bewertung->zu_gericht_id);
            $benutzernamen[] = benutzer::getName($bewertung->eingetragen_von_benutzer_id);
            $bildernamen[] = gericht::getBildname($bewertung->zu_gericht_id);
        }

        return view('bewertungen', [
            'bewertungen' => $bewertungen,
            'gerichtnamen' => $gerichtnamen,
            'benutzernamen' => $benutzernamen,
            'bildernamen' => $bildernamen
        ]);
    }

    public function meinebewertungen(){
        //Fall nicht eingelogged
        if(!isset($_SESSION['login_ok']) || $_SESSION['login_ok'] == false){
            //damit man nach dem redirect zurückkommt
            session(['url.intended' => "/meinebewertungen"]);
            return redirect('/anmeldung');
        }
        else{
            $bewertungen = bewertung::getOwnBewertungen($_SESSION['user_id']);
            $gerichtnamen = array();
            $benutzernamen = array();
            $bildernamen = array();
            foreach ($bewertungen as $bewertung){
                $gerichtnamen[] = gericht::getName($bewertung->zu_gericht_id);
                $benutzernamen[] = benutzer::getName($bewertung->eingetragen_von_benutzer_id);
                $bildernamen[] = gericht::getBildname($bewertung->zu_gericht_id);
            }

            return view('meinebewertungen', [
                'bewertungen' => $bewertungen,
                'gerichtnamen' => $gerichtnamen,
                'benutzernamen' => $benutzernamen,
                'bildernamen' => $bildernamen
            ]);
        }
    }

    public function bewertung_loeschen(Request $request){
        bewertung::deleteBewertung($request->query('id'));
        return redirect('/meinebewertungen?id=' . $_SESSION['user_id']);
    }
}
