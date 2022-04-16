<?php
   require_once "../../config/connection.php";

    header("Content-Type: application/json");

    $cena = $_POST["cena"];

    $cena = intval($cena);

    $upit = "SELECT * FROM proizvodi WHERE cena BETWEEN 0 AND :cena";
    $pripremi = $conn -> prepare($upit);
    $pripremi -> bindParam(":cena", $cena);

    try{
        $uspeh = $pripremi -> execute();
        if($uspeh){
            http_response_code(200);
            $proizvodi = $pripremi -> fetchAll();
            echo json_encode($proizvodi);
    }

    }catch(PDOException $e){
        var_dump($e -> getMessage());
    }


?>