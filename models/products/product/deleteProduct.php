<?php
 require_once "../../../config/connection.php";

$id = $_GET["idProizvoda"];

$upit = "DELETE FROM proizvodi WHERE id = :id";

$izvrsi = $conn -> prepare($upit);
$izvrsi -> bindParam(":id", $id);

try{
 $izvrsi -> execute();
 header("Location: ../../../index.php?page=store");
}

catch(Exception $e) {
 var_dump($e->getMessage());
}