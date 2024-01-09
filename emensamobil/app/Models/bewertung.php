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
}
