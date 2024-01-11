<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class bewertung extends Model
{
    public static function createBewertung($eingetragen_von_benutzer_id, $zu_gericht_id,
        $bemerkung, $sterne_bewertung){
            $sql = "INSERT INTO `bewertung` (eingetragen_von_benutzer_id, zu_gericht_id, bemerkung, sterne_bewertung, bewertungszeitpunkt)
            VALUES (?, ?, ?, ?, NOW())";

            DB::insert($sql, [
                $eingetragen_von_benutzer_id,
                $zu_gericht_id,
                $bemerkung,
                $sterne_bewertung
            ]);
    }

    public static function getLastThirtyBewertungen(){
        $sql = "SELECT * FROM bewertung ORDER BY bewertungszeitpunkt DESC LIMIT 30";
        return DB::select($sql);
    }

    public static function getOwnBewertungen($id){
        $sql = "SELECT * FROM bewertung WHERE eingetragen_von_benutzer_id = ? ORDER BY bewertungszeitpunkt DESC";
        return DB::select($sql,[$id]);
    }

    public static function deleteBewertung($bewertung_id){
        $sql = "DELETE FROM bewertung WHERE id = ?";
        DB::delete($sql, [$bewertung_id]);
    }

    public static function getHervorhebung($bewertung_id){
        $sql = "SELECT hervorgehoben FROM bewertung WHERE id = ?";
        return DB::select($sql, [$bewertung_id]);
    }

    public static function setBewertungHervorheben($bewertung_id, $status){
        $sql = "UPDATE bewertung SET hervorgehoben = ? WHERE id = ?";
        DB::update($sql, [$status, $bewertung_id]);
    }

    public static function getHervorgehobeneBewertungen(){
        $sql = "SELECT * FROM bewertung WHERE hervorgehoben = 1 ORDER BY bewertungszeitpunkt DESC ";
        return DB::select($sql);
    }
}
