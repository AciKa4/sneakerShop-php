<?php

// Osnovna podesavanja
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/praktikum");

// Ostala podesavanja
define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");

define("ERROR_LOG", ABSOLUTE_PATH."/data/errorLog.txt");
define("LOGIN_USERS", ABSOLUTE_PATH."/data/loginUsers.txt");
define("PAGE_ENTRY", ABSOLUTE_PATH."/data/pageEntry.txt");

// Podesavanja za bazu
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv){
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=", $value);
        if($konfig[0]==$naziv){
            $vrednost = trim($konfig[1]); 
        }
    }
    return $vrednost;
}
