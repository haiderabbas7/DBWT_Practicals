<?php
/**
 * Praktikum DBWT. Autoren:
 * Yannik, Sinthern, 3570151
 * Haider, Abbas, 3567272
 */
function addieren($a, $b = 0) : int|float{
    if($b == ""){
        $b = 0;
    }
    return ($a + $b);
}
