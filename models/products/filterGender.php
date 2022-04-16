<?php

    require_once "../../config/connection.php";

    header("Content-Type: application/json");

    $vrednost = $_POST["val"];


    if($vrednost == "Male"){
        $upit = "SELECT * FROM proizvodi as p INNER JOIN pol as pl ON pl.id = p.idPol WHERE pl.pol = :vrednost";
        $pripremi = $conn -> prepare($upit);
        $pripremi -> bindParam(":vrednost", $vrednost);
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
    }

    if($vrednost == "Female"){
        $upit = "SELECT * FROM proizvodi as p INNER JOIN pol as pl ON pl.id = p.idPol WHERE pl.pol = :vrednost";
        $pripremi = $conn -> prepare($upit);
        $pripremi -> bindParam(":vrednost", $vrednost);
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
    }
?>