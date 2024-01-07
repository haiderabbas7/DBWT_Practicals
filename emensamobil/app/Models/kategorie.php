<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kategorie extends Model
{
    public static function kategorie_selectAll(){
        $sql = "SELECT * FROM kategorie";
        $result = DB::select($sql);
        return $result ? $result[0]->name : null;
    }
}
