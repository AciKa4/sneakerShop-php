<?php

$upit = "SELECT * FROM proizvodi";
$izvrsi = $conn -> query($upit);
$proizvodi = $izvrsi -> fetchAll();

?>