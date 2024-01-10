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

function db_increment_anzahl_fehler($email, $link){
    $sql = "UPDATE benutzer SET anzahlfehler = anzahlfehler+ 1 WHERE email = '$email'";
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

function db_increment_anzahl_anmeldungen_procedure($id, $link){
    $sql = "CALL inkrementiere_anzahlanmeldungen('$id')";
    mysqli_query($link, $sql);
}



function db_get_anzahlanmeldungen($id, $link){
    $sql = "SELECT anzahlanmeldungen FROM benutzer WHERE id = '$id'";
    $result = mysqli_query($link, $sql);
    $int = mysqli_fetch_assoc($result);
    return $int['anzahlanmeldungen'];
}

function db_get_email($id, $link){
    $sql = "SELECT email FROM benutzer WHERE id = '$id'";
    $result = mysqli_query($link, $sql);
    $email = mysqli_fetch_assoc($result);
    return $email['email'];
}

function db_get_admin($id, $link) : bool{
    $sql = "SELECT admin FROM benutzer WHERE id = '$id'";
    $result = mysqli_query($link, $sql);
    $admin = mysqli_fetch_assoc($result);
    if($admin['admin'] == '1'){
        return true;
    }
    else{
        return false;
    }
}