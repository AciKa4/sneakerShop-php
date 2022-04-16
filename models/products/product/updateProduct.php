<?php
 require_once "../../../config/connection.php";

 if($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(404);
    exit;
 }


 header("Content-type: application/json");

function proveri(&$greske, $key){
   if(!isset($_POST[$key])){
      array_push($greske, $key . " is required!");
   }
}

function promenljiva($key){
   return $_POST[$key];
}
  
function proveriSlike(&$greske, $key){
   $tip = strtolower(pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION));

   if($tip != "jpg" && $tip != "jpeg" && $tip != "png"){
      $greske[] = $key . " is not in good format!";
   }
}

$greske = [];
 proveri($greske, "ime");
 proveri($greske, "cena");
 proveri($greske, "staracena");
 proveri($greske, "brandProizvoda");
 proveri($greske, "pol");
 proveri($greske, "kolicina");


if(count($greske)){
   errorsInTxt($greske);
   http_response_code(400);
   echo json_encode($greske);
   exit;
}
  
function proveriRegEx(&$greske, $regEx, $key){
   if(!preg_match($regEx, $_POST[$key])){
      array_push($greske, $key. " is not in good format.");
   }
}

$regIme ="/^[\w\d\s]+$/";
$regCena = "/^[0-9]+\.?[0-9]*$/";
$regZaj = "/^[0-9]{1,}$/";


proveriRegEx($greske, $regIme, "ime");
proveriRegEx($greske, $regCena, "cena");
proveriRegEx($greske, $regCena, "staracena");
proveriRegEx($greske, $regZaj, "kolicina");

if(count($greske)){
   errorsInTxt($greske);
   http_response_code(400);
   echo json_encode($greske);
   exit;
}
  

$ime = promenljiva("ime");
$cena = promenljiva("cena");
$staracena = promenljiva("staracena");
$pol = promenljiva("pol");
$kolicina = promenljiva("kolicina");
$brandProizvoda = promenljiva("brandProizvoda");
$id = promenljiva("id");


$upitGlavni = "UPDATE proizvodi SET naziv = :ime, cena = :cena, staracena = :staracena,idPol = :pol, idBrend = :idBrend, kolicina = :kolicina WHERE id = :id";

$izvrsiGlavno = $conn -> prepare($upitGlavni);
$izvrsiGlavno -> bindParam(":ime", $ime);
$izvrsiGlavno -> bindParam(":cena", $cena);
$izvrsiGlavno -> bindParam(":staracena", $staracena);
$izvrsiGlavno -> bindParam(":idBrend", $brandProizvoda);
$izvrsiGlavno -> bindParam(":pol", $pol);
$izvrsiGlavno -> bindParam(":kolicina", $kolicina);
$izvrsiGlavno -> bindParam(":id", $id);


try{
   $izvrsiGlavno -> execute();
}
catch(Exception $e) {
   var_dump($e->getMessage());
}
  

if(isset($_FILES['glavnaSlika'])){

   $fileName = pathinfo($_FILES['glavnaSlika']['name'], PATHINFO_FILENAME);
   $fileNameEx = pathinfo($_FILES['glavnaSlika']['name'], PATHINFO_EXTENSION);
   $tmpName = $_FILES['glavnaSlika']['tmp_name'];
   $fileSize = $_FILES['glavnaSlika']['size'];
   $fileType = $_FILES['glavnaSlika']['type'];
   $fileError = $_FILES['glavnaSlika']['error'];

   proveriSlike($greske, "glavnaSlika");

   if(count($greske)){
      http_response_code(400);
      echo json_encode($greske);
   exit;
   }

   $nazivSlike = $fileName. "." . $fileNameEx;
   $uploadDir = "../../../assets/img/";
   $filePath = $uploadDir . $nazivSlike;
   $rezultat = move_uploaded_file($tmpName, $filePath);

   if(!$rezultat){
      echo json_encode("Error uploading file!");
      exit;
   }
   $upitGlavnaSlika = "UPDATE proizvodi SET glavnaSlika = :slika WHERE id = :id";
   $izvrsiGlavnaSlika = $conn -> prepare($upitGlavnaSlika);
   $izvrsiGlavnaSlika -> bindParam(":slika", $nazivSlike);
   $izvrsiGlavnaSlika -> bindParam(":id", $id);
   try{
      $izvrsiGlavnaSlika -> execute();
   }
   catch(Exception $e) {
      var_dump($e->getMessage());
   }

}

echo json_encode("Successfully updated!");


?>