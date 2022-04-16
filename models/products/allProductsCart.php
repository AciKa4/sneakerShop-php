<?php
require_once "../../config/connection.php";
$upit = "SELECT * FROM proizvodi";
$izvrsi = $conn -> query($upit);
$proizvodi = $izvrsi -> fetchAll();
header("Content-type: application/json");
echo json_encode($proizvodi);
?>