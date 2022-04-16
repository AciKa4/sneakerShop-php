<?php
   require_once "../../config/connection.php";

    header("Content-Type: application/json");

    $vrednost = $_POST["val"];

   if($vrednost == "desc"){
        $upit = "SELECT * FROM proizvodi ORDER BY cena DESC";
        $pripremi = $conn -> query($upit);
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

   else if($vrednost == "asc"){
        $upit = "SELECT * FROM proizvodi ORDER BY cena";
        $pripremi = $conn -> query($upit);
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

   else if($vrednost == "descbyName"){
    $upit = "SELECT * FROM proizvodi ORDER BY naziv";
    $pripremi = $conn -> query($upit);
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