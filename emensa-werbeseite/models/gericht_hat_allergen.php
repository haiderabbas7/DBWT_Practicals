<?php
function db_allergen_select_used_allergen($current_id){
    try {
        $link = connectdb();

        $sql = "SELECT * FROM gericht_hat_allergen WHERE gericht_id = '$current_id'";

        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }
}

