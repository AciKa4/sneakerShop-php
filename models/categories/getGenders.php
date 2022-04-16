<?php
$upitPol = "SELECT * FROM pol";
$izvrsiPol = $conn -> query($upitPol);
$izvrsiPol = $izvrsiPol -> fetchAll();
?>