<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class gericht_hat_allergen extends Model
{
    public static function gericht_hat_allergen_selectUsedAllergen($id){
        $sql = "SELECT * FROM gericht_hat_allergen WHERE gericht_id = ?";
        $result = DB::select($sql, [$id]);
        return $result ? $result[0]->name : null;
    }
}
