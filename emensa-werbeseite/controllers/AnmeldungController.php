<?php

//require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
//Folgender Code ist dazu da, alle Dateien im Models ordner zu includieren, anstatt dass man pro datei immer ne extra zeile wie oben schreiben muss
$directory = $_SERVER['DOCUMENT_ROOT'] . '/../models/';
$files = glob($directory . '*.php');

foreach ($files as $file) {
    require_once $file;
}

/* Datei: controllers/AnmeldungController.php */
class AnmeldungController
{
    public function anmeldung(RequestData $request){
        return view('anmeldung');
    }

    public function anmeldung_verifizieren(RequestData $request){
        $link = connectdb();
        mysqli_begin_transaction($link);

        $email = $request->query['anmeldung_email'];
        $password = sha1(get_salt() . $request->query['anmeldung_passwort']);

        $b = db_search_for_user($email, $password, $link);

        if($b){
            $_SESSION['login_fehler'] = false;
            $_SESSION['login_ok'] = true;
            $_SESSION['user_name'] = db_get_username($email, $password, $link);
            $user_id = db_get_id($email, $password, $link);
            db_increment_anzahl_anmeldungen($user_id, $link);
            db_set_letzteanmeldung($user_id, $link);
            $target = "/";
        }
        else{
            $_SESSION['login_fehler'] = true;
            $_SESSION['login_ok'] = false;
            db_set_letzterfehler($email, $link);
            $target = "/anmeldung";
        }
        mysqli_commit($link);
        mysqli_close($link);
        header("Location: " . $target);
        exit();
    }


    public function abmeldung(){
        unset($_SESSION['user_name']);
        $_SESSION['login_ok'] = false;
        $_SESSION['login_fehler'] = false;
        header("Location: /");
        exit();
    }
}