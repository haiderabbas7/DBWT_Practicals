<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class benutzer extends Model
{
    //protected $table = 'benutzer'; // Specify the table name if it's different from the model name in plural form
    //protected $primaryKey = 'id'; // Specify the primary key if it's different from 'id'

    public static function benutzer_getSalt(): string
    {
        return 'georghoever';
    }

    public static function benutzer_searchForUser($email, $password): bool
    {
        $sql = "SELECT name FROM benutzer WHERE email = ? AND passwort = ?";
        $result = DB::select($sql, [$email, $password]);

        return !empty($result);
    }

    public static function benutzer_getUsername($email, $password)
    {
        $sql = "SELECT name FROM benutzer WHERE email = ? AND passwort = ?";
        $result = DB::select($sql, [$email, $password]);

        return $result ? $result[0]->name : null;
    }

    public static function benutzer_getId($email, $password)
    {
        $sql = "SELECT id FROM benutzer WHERE email = ? AND passwort = ?";
        $result = DB::select($sql, [$email, $password]);

        return $result ? $result[0]->id : null;
    }

    public static function benutzer_incrementAnzahlAnmeldungen($id)
    {
        $sql = "UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1 WHERE id = ?";
        DB::update($sql, [$id]);
    }

    public static function benutzer_setLetzteAnmeldung($id)
    {
        $sql = "UPDATE benutzer SET letzteanmeldung = NOW() WHERE id = ?";
        DB::update($sql, [$id]);
    }

    public static function benutzer_setLetzterFehler($email)
    {
        $sql = "UPDATE benutzer SET letzterfehler = NOW() WHERE email = ?";
        DB::update($sql, [$email]);
    }

    //VIELLEICHT FEHLER BEI DIESER METHODE
    public static function incrementAnzahlAnmeldungenProcedure($id)
    {
        $sql = "CALL inkrementiere_anzahlanmeldungen(?)";
        DB::select($sql, [$id]);
    }
}

