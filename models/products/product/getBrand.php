<?php
$brendid = $p ->idBrend;
$upitBrend = "SELECT * FROM brend WHERE $brendid = id";
$izvrsiBrend = $conn -> query($upitBrend);
$brend = $izvrsiBrend -> fetch();
?>