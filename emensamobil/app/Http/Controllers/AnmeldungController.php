<?php

namespace App\Http\Controllers;

use App\Models\gericht;
use App\Models\gericht_hat_allergen;
use App\Models\benutzer;
use App\Models\kategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AnmeldungController extends Controller
{
    public function anmeldung(){
        return view('anmeldung');
    }

    public function anmeldung_verifizieren(Request $request){
        DB::beginTransaction();
        $email = $request->input('anmeldung_email');
        $passwort = sha1(benutzer::getSalt() . $request->input('anmeldung_passwort'));
        $con = benutzer::searchForUser($email, $passwort);
        if($con){
            $_SESSION['login_fehler'] = false;
            $_SESSION['login_ok'] = true;
            $_SESSION['user_name'] = benutzer::getUsername($email, $passwort);
            $user_id = benutzer::getId($email, $passwort);
            $_SESSION['user_id'] = $user_id;
            benutzer::incrementAnzahlAnmeldungenProcedure($user_id);
            benutzer::setLetzteAnmeldung($user_id);

            $target = "/";
        }
        else{
            $_SESSION['login_fehler'] = true;
            $_SESSION['login_ok'] = false;
            benutzer::setLetzterFehler($email);
            $target = "/anmeldung";
        }
        DB::commit();
        header("Location: " . $target);
        exit();
    }

    public function abmeldung(Request $request){
        unset($_SESSION['user_name']);
        unset($_SESSION['user_id']);
        $_SESSION['login_ok'] = false;
        $_SESSION['login_fehler'] = false;
        header("Location: /");
        exit();
    }

    public function profil(){
        if(!isset($_SESSION['login_ok']) || $_SESSION['login_ok'] == false){
            header("Location: /anmeldung");
        }
        else{
            DB::beginTransaction();
            $email = benutzer::getEmail($_SESSION['user_id']);
            $anzahlanmeldungen = benutzer::getAnzahlanmeldungen($_SESSION['user_id']);
            $admin = benutzer::getAdmin($_SESSION['user_id']);

            DB::commit();
            return view("profil", [
                'email' => $email,
                'anzahlanmeldungen' => $anzahlanmeldungen,
                'admin' => $admin
            ]);
        }
        exit();
    }
}
