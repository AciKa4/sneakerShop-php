<?php

    require_once "../../config/connection.php";

    header("Content-Type: application/json");

    $id = $_POST["id"];

    $upit = "SELECT * FROM proizvodi WHERE idBrend = :id";
    $pripremi = $conn -> prepare($upit);
    $pripremi -> bindParam(":id", $id);
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