<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

session_start();

return array(
    '/'                         => "WerbeseiteController@index",
    '/debug'                    => 'HomeController@debug',

    '/anmeldung'                => 'AnmeldungController@anmeldung',

    '/anmeldung_verifizieren'   => 'AnmeldungController@anmeldung_verifizieren',

    '/abmeldung'                => 'AnmeldungController@abmeldung'
);