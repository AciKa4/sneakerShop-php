<?php

$upitBr = "SELECT COUNT(*) as broj FROM proizvodi";
$brIzvrsi = $conn -> query($upitBr);
$brukupno = $brIzvrsi -> fetch();
$brukupno = intval($brukupno -> broj);
$poStr = 8;
$brStrana = ceil($brukupno/$poStr);

    if(!isset($_GET['strana'])){
        $strana = 1;
    }
    else{
        $strana = $_GET['strana'];
    }
    
$rezStrana = ($strana-1)*$poStr;
$upitPoStr = "SELECT * FROM proizvodi LIMIT :rezStrana, :poStr";
$izvrsipostr = $conn -> prepare($upitPoStr);
$izvrsipostr -> bindParam(":rezStrana",$rezStrana,PDO::PARAM_INT);
$izvrsipostr -> bindParam(":poStr",$poStr,PDO::PARAM_INT);
$izvrsipostr ->execute();
$proizvodi = $izvrsipostr -> fetchAll();
?>