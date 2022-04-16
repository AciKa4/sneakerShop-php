<?php
    require_once "../../../config/connection.php";

 if($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(404);
    exit;
}

    header("Content-type: application/json");

    function proveri(&$greske, $key){
        if(empty($_POST[$key])){
            array_push($greske, $key . " is required!");
    }
    }
    function promenljiva($key){
        return $_POST[$key];
    }

    function proveriSlike(&$greske, $key){
        $tip = strtolower(pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION));

        if($tip != "jpg" && $tip != "jpeg" && $tip != "png"){
            $greske[] = $key . " is not in good format!";
        }
    }

    $greske = [];

    proveri($greske, "ime");
    proveri($greske, "cena");
    proveri($greske, "staracena");
    proveri($greske, "brandProizvoda");
    proveri($greske, "pol");
    proveri($greske, "kolicina");

    if(!isset($_FILES['glavnaSlika'])){
        $greske[] = "Main picture is required!";
    }


    if(count($greske)){
        http_response_code(400);
        echo json_encode($greske);
        exit;
    }

    function proveriRegEx(&$greske, $regEx, $key){
        if(!preg_match($regEx, $_POST[$key])){
            array_push($greske, $key. " is not in good format.");
        }
    }

    $regIme ="/^[\w\d\s]+$/";
    $regCena = "/^[0-9]+\.?[0-9]*$/";
    $regZaj = "/^[0-9]{1,}$/";


    proveriRegEx($greske, $regIme, "ime");
    proveriRegEx($greske, $regCena, "cena");
    proveriRegEx($greske, $regCena, "staracena");
    proveriRegEx($greske, $regZaj, "kolicina");


    proveriSlike($greske, "glavnaSlika");

    if(count($greske)){
        http_response_code(400);
        echo json_encode($greske);
        exit;
    }

    $ime = promenljiva("ime");
    $cena = promenljiva("cena");
    $staracena = promenljiva("staracena");
    $pol = promenljiva("pol");
    $kolicina = promenljiva("kolicina");
    $brandProizvoda = promenljiva("brandProizvoda");


    $glavnaSlika = $_FILES['glavnaSlika'];

    $fileName = pathinfo($_FILES['glavnaSlika']['name'], PATHINFO_FILENAME);
    $fileNameEx = pathinfo($_FILES['glavnaSlika']['name'], PATHINFO_EXTENSION);
    $tmpName = $_FILES['glavnaSlika']['tmp_name'];
    $fileSize = $_FILES['glavnaSlika']['size'];
    $fileType = $_FILES['glavnaSlika']['type'];
    $fileError = $_FILES['glavnaSlika']['error'];

    $nazivSlike = $fileName. "." . $fileNameEx;
    $uploadDir = "../../../assets/img/";
    
    $filePath = $uploadDir . $nazivSlike;
    $rezultat = move_uploaded_file($tmpName, $filePath);
    

    if(!$rezultat){
        echo json_encode("Error uploading file!");
        exit;
    }
    else{

        $resizedPath = "../../../assets/img/thumbnails/";
        
        $thumbSlika = thumbSlika($filePath,$resizedPath);

        $datum = date("Y-m-d H:i:s");

        $upitGlavni = "INSERT INTO proizvodi VALUES(NULL, :ime, :cena, :staracena, :datum,:glavnaSlika, :thumbSlika, :idPol, :idBrend, :kolicina)";

        $izvrsiGlavno = $conn -> prepare($upitGlavni);
        $izvrsiGlavno -> bindParam(":ime", $ime);
        $izvrsiGlavno -> bindParam(":cena", $opis);
        $izvrsiGlavno -> bindParam(":cena", $cena);
        $izvrsiGlavno -> bindParam(":staracena", $staracena);
        $izvrsiGlavno -> bindParam(":datum", $datum);
        $izvrsiGlavno -> bindParam(":glavnaSlika", $nazivSlike);
        $izvrsiGlavno -> bindParam(":thumbSlika", $thumbSlika);
        $izvrsiGlavno -> bindParam(":idPol", $pol);
        $izvrsiGlavno -> bindParam(":idBrend", $brandProizvoda);
        $izvrsiGlavno -> bindParam(":kolicina", $kolicina);

        try{
            $izvrsiGlavno -> execute();
            echo json_encode("Successfully added item");
        }
        catch(Exception $e) {
            var_dump($e->getMessage());
            upisGresakaUTxtFajl("you did not added item.");
        }
    }

?>