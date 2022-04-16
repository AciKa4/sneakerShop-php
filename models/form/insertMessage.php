<?php

session_start();
include "../../config/connection.php";
require_once "../../config/functions.php";

if($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(404);
    exit;
}
   
    header("Content-type: application/json");

    $greske = [];


    function check(&$greske, $key){
        if(empty($_POST[$key])){
        $greske[] = $key . " is required!";
        }
    }
    function promenljiva($key){
        return $_POST[$key];
    }
    function checkRegEx(&$greske, $regEx, $key){
        if(!preg_match($regEx, $_POST[$key])){
        array_push($greske, $key. " is not in good format.");
        }
    }

    check($greske, "FirstName");
    check($greske, "LastName");
    check($greske, "Email");
    check($greske, "Message");


    if(count($greske)){
        http_response_code(400);
        echo json_encode($greske);
        exit;
    }

    $regexImePrezime = "/^([A-Z][a-z]{1,50}\s?)+$/";
    $regexPoruka = "/^.{2,}$/";
    $regexEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";

    checkRegEx($greske, $regexImePrezime, "FirstName");
    checkRegEx($greske, $regexImePrezime, "LastName");
    checkRegEx($greske, $regexEmail, "Email");
    checkRegEx($greske, $regexPoruka, "Message");


    if(count($greske)){
        http_response_code(400);
        echo json_encode($greske);
        errorsInTxt($greske);
        exit;
    }
       

    $ime = promenljiva("FirstName");
    $prezime = promenljiva("LastName");
    $email = promenljiva("Email");
    $poruka = promenljiva("Message");
    $id = promenljiva('id');    

    $upit = "INSERT INTO poruka (idKorisnika, ime, prezime, email,opis) VALUES (:id,:ime,:prezime,:email,:opis)";

    $izvrsi  = $conn -> prepare($upit);
    $izvrsi -> bindParam(":id",$id);
    $izvrsi -> bindParam(":ime",$ime);
    $izvrsi -> bindParam(":prezime",$prezime);
    $izvrsi -> bindParam(":email",$email);
    $izvrsi -> bindParam(":opis",$poruka);

    $izvrseno = $izvrsi -> execute();

    if($izvrseno){
        echo json_encode("Your message has been send!");;
        http_response_code(200);
    }
  
?>