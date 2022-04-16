<?php
$upit = "SELECT * FROM proizvodi WHERE id = :id";
$izvrsi = $conn -> prepare($upit);
$izvrsi -> bindParam(":id", $id);
$izvrsi -> execute();
$p = $izvrsi -> fetch();
?>