<?php
require_once('C:\Users\Haider\PhpstormProjects\E-Mensa-Werbeseite\emensa-werbeseite\models\benutzer.php');
echo sha1(get_salt() . 'admin');