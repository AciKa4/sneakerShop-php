<?php
$upit = "SELECT * FROM brend";
$izvrsi = $conn -> query($upit);
$izvrsiBrend = $izvrsi -> fetchAll();
?>