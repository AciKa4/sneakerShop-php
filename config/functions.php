<?php

function queryFunc($upit){
    global $conn;
    return $conn->query($upit)->fetchAll();
}

function thumbSlika($filePath,$resizedPath){

        $extension = pathinfo($filePath,PATHINFO_EXTENSION);

        $dimensions = getimagesize($filePath);
       
        list($width,$height) = $dimensions;
       
        $newWidth = 150;
        $newHeight = $height * $newWidth / $width;
       
        $image = imagecreatetruecolor($newWidth,$newHeight);
       
        switch ($extension) {
            case 'jpg':
                $uploadedImage = imagecreatefromjpeg($filePath);
                break;
            case 'jpeg':
                $uploadedImage = imagecreatefromjpeg($filePath);
                break;
            case 'png':
                $uploadedImage = imagecreatefrompng($filePath);
                break;
        }
       
        imagecopyresampled($image,$uploadedImage,0,0,0,0,$newWidth,$newHeight,$width,$height);
       
        $resizedImagePath = $resizedPath;
        $namePic = time()."_"."resizedImage.".$extension;
       
        switch ($extension) {
            case 'jpg':
                imagejpeg($image,$resizedImagePath.$namePic);
                break;
            case 'jpeg':
                imagejpeg($image,$resizedImagePath.$namePic);
                break;
            case 'png':
                imagepng($image,$resizedImagePath.$namePic);
                break;
        }

    return $namePic;
}

function errorsInTxt($greske){

    $adresa = $_SERVER['REMOTE_ADDR'];
    $datum = date("m-d-Y, h:i:s");

    if(is_array($greske)){

        foreach($greske as $greska){
            $message = $greska."\t".$adresa."\t".$datum."\n";
        }
    }
    else{
        $message = $greske."\t".$adresa."\t".$datum."\n";
    }

    $txtFajl = fopen(ERROR_LOG, 'ab');
    fwrite($txtFajl, $message);
    fclose($txtFajl);
}

function recordEntry(){

    $vreme = time();
    $adresa = $_SERVER['REMOTE_ADDR'];
    $posecenaStranica = "";
    $nizGresaka = [];

    $trajanjeDana = 24*60*60;

    date_default_timezone_set('Europe/Belgrade');


    if(isset($_GET["page"])){
        switch ($_GET["page"]){
            case "home":
                $posecenaStranica = "Home";
                break;
            case "login":
                $posecenaStranica = "Login";
                break;
            case "registration":
                $posecenaStranica = "Registracija";
                break;
            case "store":
                $posecenaStranica = "Prodavnica";
                break;
            case "cart":
                $posecenaStranica = "Korpa";
                break;
            case "contact":
                $posecenaStranica = "Kontakt";
                break;
            case "author":
                $posecenaStranica = "Autor";
                break;
            case "admin":
                $posecenaStranica = "Admin";
                break;
        }
    }

    $pristupStranicama = file(PAGE_ENTRY);
    $niz = count($pristupStranicama);
    $txtFajl =fopen(PAGE_ENTRY, 'w');

    for($i=0; $i < $niz; $i++){
        $elementiIzFajla = explode("\t", $pristupStranicama[$i]);
        $stranica = $elementiIzFajla[0];
        $vremePristupa = $elementiIzFajla[1];
        $korisnik = $elementiIzFajla[2];
        $korisnik = trim($korisnik);
        $vremeKojeJePreostalo = $vreme - $vremePristupa;
        if($vremeKojeJePreostalo <= $trajanjeDana){
            fwrite($txtFajl, $stranica."\t".$vremePristupa."\t".$korisnik."\n");
        }
    }

    fclose($txtFajl);

    if(count($nizGresaka) == 0){
        $upisPristupaStranicama = $posecenaStranica."\t".$vreme."\t".$adresa."\n";
        $otvoriFajl = fopen(PAGE_ENTRY, 'ab');
        fwrite($otvoriFajl, $upisPristupaStranicama);
        fclose($otvoriFajl);
    }
}

function loginUsers($korisnik){
   
    $vreme = time();
    $txtFajl = fopen(LOGIN_USERS, 'ab');

    fwrite($txtFajl, $korisnik -> id."\t".$vreme."\n");
    fclose($txtFajl);
        
}

function getUser($id){
    global $conn;
    $query = "SELECT * FROM korisnici WHERE id = ?";
    $exec = $conn->prepare($query);
    $exec->execute([$id]);

    $retr = $exec->fetch();
    return $retr;
}

?>