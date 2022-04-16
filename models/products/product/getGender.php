<?php
$polid = $p ->idPol;
$upitPol = "SELECT * FROM pol WHERE $polid = id";
$izvrsiPol = $conn -> query($upitPol);
$pol = $izvrsiPol -> fetch();
?>