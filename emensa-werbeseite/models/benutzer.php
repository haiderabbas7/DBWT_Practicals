<?php

function get_salt() : string{
    return 'georghoever';
}

function db_search_for_user($email, $password, $link) : bool{
    $sql = "SELECT name FROM benutzer WHERE email = '$email' AND passwort = '$password'";
    $result = mysqli_query($link, $sql);
    $user_name = mysqli_fetch_assoc($result);

    if($user_name){
        return true;
    }
    else{
        return false;
    }
}

function db_get_username($email, $password, $link){
    $sql = "SELECT name FROM benutzer WHERE email = '$email' AND passwort = '$password'";
    $result = mysqli_query($link, $sql);
    $user_name = mysqli_fetch_assoc($result);
    return $user_name['name'];
}

function db_get_id($email, $password, $link){
    $sql = "SELECT id FROM benutzer WHERE email = '$email' AND passwort = '$password'";
    $result = mysqli_query($link, $sql);
    $user_name = mysqli_fetch_assoc($result);
    return $user_name['id'];
}

function db_increment_anzahl_anmeldungen($id, $link){
    $sql = "UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1 WHERE id = '$id'";
    mysqli_query($link, $sql);
}

function db_set_letzteanmeldung($id, $link){
    $sql = "UPDATE benutzer SET letzteanmeldung = NOW() WHERE id = '$id'";
    mysqli_query($link, $sql);
}

function db_set_letzterfehler($email, $link){
    $sql = "UPDATE benutzer SET letzterfehler = NOW() WHERE email = '$email'";
    mysqli_query($link, $sql);
}