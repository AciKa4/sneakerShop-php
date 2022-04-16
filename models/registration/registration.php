<?php
include "../../config/connection.php";
session_start();

    if($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(404);
    exit;
    }

    header("Content-type: application/json");

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $lozinka = $_POST['sifra'];
    $lozinkaPonovo = $_POST['potvrdiSifru'];

    $regexIme = "/^[A-Z][a-z]{1,13}$/";
    $regexPrezime = "/^([A-Z][a-z]{1,30}\s?)+$/";
    $regexEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
    $regexLozinka = "/^.{4,50}$/";

    $greske = [];

    if(!preg_match($regexIme, $ime)){
    $greske[] = "First name not entered correctly!";
    }
    if(!preg_match($regexPrezime, $prezime)){
    $greske[] = "Last name not entered correctly!";
    }
    if(!preg_match($regexEmail, $email)){
    $greske[] = "Email not entered correctly!";
    }
    if(!preg_match($regexLozinka, $lozinka)){
    $greske[] = "Password not entered correctly!";
    }
    if($lozinka != $lozinkaPonovo){
    $greske[] = "Password is not the same";
    }


    $upit = "SELECT * from korisnici where email = :email";
    $izvrsi = $conn -> prepare($upit);
    $izvrsi -> bindParam(":email", $email);
    $izvrseno = $izvrsi -> execute();
    $resenje = $izvrsi -> fetch();

    if($resenje != []){
    array_push($greske, "Email already exists!");
    }

    if(count($greske)) {
        http_response_code(400);
        echo json_encode($greske);
    }
    else {
        $upit = "INSERT INTO korisnici VALUES (NULL,:ime, :prezime, :email, :password, :aktivan, :datum, :idUloge)";

        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":ime", $ime);
        $priprema->bindParam(":prezime", $prezime);
        $priprema->bindParam(":email", $email);
        $lozinka = md5($lozinka);
        $priprema->bindParam(":password", $lozinka);
        $datum = date("Y-m-d H:i:s");
        $priprema->bindParam(":datum", $datum);
        $isActive = 1;
        $priprema->bindParam(":aktivan", $isActive);

        define("KORISNIK_ULOGA", 2);

        $ulogaId = KORISNIK_ULOGA;

        $priprema->bindParam(":idUloge", $ulogaId);
        
        try {
            $isUneto = $priprema->execute();
            if($isUneto){
                http_response_code(200);
                echo json_encode("You have successfully registered!");
            }
        }
        catch(PDOException $ex) {
            $greske[] = "Email already exists!";

        }
    }
?>