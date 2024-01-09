<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class benutzer extends Model
{
    public static function getSalt(): string
    {
        return 'georghoever';
    }

    public static function searchForUser($email, $password): bool
    {
        $sql = "SELECT name FROM benutzer WHERE email = ? AND passwort = ?";
        $result = DB::select($sql, [$email, $password]);

        return !empty($result);
    }

    public static function getUsername($email, $password)
    {
        $sql = "SELECT name FROM benutzer WHERE email = ? AND passwort = ?";
        $result = DB::select($sql, [$email, $password]);

        return $result ? $result[0]->name : null;
    }

    public static function getId($email, $password)
    {
        $sql = "SELECT id FROM benutzer WHERE email = ? AND passwort = ?";
        $result = DB::select($sql, [$email, $password]);

        return $result ? $result[0]->id : null;
    }

    public static function incrementAnzahlAnmeldungen($id): void
    {
        $sql = "UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1 WHERE id = ?";
        DB::update($sql, [$id]);
    }

    public static function setLetzteAnmeldung($id): void
    {
        $sql = "UPDATE benutzer SET letzteanmeldung = NOW() WHERE id = ?";
        DB::update($sql, [$id]);
    }

    public static function setLetzterFehler($email): void
    {
        $sql = "UPDATE benutzer SET letzterfehler = NOW() WHERE email = ?";
        DB::update($sql, [$email]);
    }

    public static function incrementAnzahlAnmeldungenProcedure($id): void
    {
        $sql = "CALL inkrementiere_anzahlanmeldungen(?)";
        DB::update($sql, [$id]);
    }

    public static function getAnzahlanmeldungen($id){
        $sql = "SELECT anzahlanmeldungen FROM benutzer WHERE id = ?";
        $result = DB::select($sql, [$id]);
        return $result ? $result[0]->anzahlanmeldungen : null;
    }

    public static function getEmail($id){
        $sql = "SELECT email FROM benutzer WHERE id = ?";
        $result = DB::select($sql, [$id]);
        return $result ? $result[0]->email : null;
    }

    public static function getAdmin($id){
        $sql = "SELECT admin FROM benutzer WHERE id = ?";
        $result = DB::select($sql, [$id]);
        if($result[0]->admin == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getName($id){
        $sql = "SELECT name FROM benutzer WHERE id = ?";
        /*$result = DB::select($sql, [$id]);
        return $result ? $result[0]->name : null;*/
        return DB::select($sql, [$id]);
    }
}

