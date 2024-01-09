<?php

namespace app\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class gericht extends Model
{
    public static function selectAllGerichte(){
        $sql = "SELECT id, name, beschreibung FROM gericht ORDER BY name";
        return DB::select($sql);
    }

    public static function selectFive(){
        $sql = "SELECT id, name, preisintern, preisextern FROM gericht ORDER BY name LIMIT 5";
        return DB::select($sql);
    }

    public static function getBildname($id){
        $sql = "SELECT bildname FROM gericht WHERE id = ?";
        return DB::select($sql, [$id]);
    }

    public static function getName($id){
        $sql = "SELECT name FROM gericht WHERE id = ?";
        return DB::select($sql, [$id]);
    }
}
