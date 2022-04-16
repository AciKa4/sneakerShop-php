<?php
    include "../../config/connection.php";

    $id = $_GET["id"];

    $upit = "DELETE FROM poruka WHERE id = :id";

    $izvrsi = $conn -> prepare($upit);
    $izvrsi -> bindParam(":id", $id);

    try{
        $izvrsi -> execute();
        header("Location: ../../index.php?page=admin&ind=messages");
    }

    catch(Exception $e) {
        var_dump($e->getMessage());
    }