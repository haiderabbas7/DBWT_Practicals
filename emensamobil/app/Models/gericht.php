<?php

namespace app\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class gericht extends Model
{
    public static function selectAllGerichte(){
        $sql = "SELECT id, name, beschreibung FROM gericht ORDER BY name";
        $result = DB::select($sql);

        return $result ?: null;
    }

    public static function selectFive(){
        $sql = "SELECT id, name, preisintern, preisextern FROM gericht ORDER BY name LIMIT 5";
        $result = DB::select($sql);

        return $result ?: null;
    }

    public static function getBildname($id){
        $sql = "SELECT bildname FROM gericht WHERE id = ?";
        $result = DB::select($sql, [$id]);
        return $result;
    }
}
