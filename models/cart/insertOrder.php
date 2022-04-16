<?php

session_start();

$korisnik = $_SESSION['korisnik'];


include "../../config/connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $products = $_POST['products'];
    $kolicina = $_POST['kolicinaNiz'];
    $cena = $_POST['cenaNiz'];

    $ukupnaCena = array_sum($cena);
    

    $query = "INSERT INTO porudzbina(`idKorisnika`, `imeKupac`, `emailKupca`, `ukupnaCena`) VALUES (:idKorisnika, :ime, :email, :ukupnaCena)";

    $execution = $conn->prepare($query);
    $execution->bindParam(':idKorisnika', $korisnik -> id);
    $execution->bindParam(':ime', $korisnik -> ime);
    $execution->bindParam(':email', $korisnik -> email);
    $execution->bindParam(':ukupnaCena', $ukupnaCena);

    $result = $execuion->execute();



    if($result){
        $orderId = $conn->lastInsertId();
        foreach($products as $product){

            $query1 = "SELECT cena FROM proizvodi WHERE id = :id";
            $execution1 = $conn->prepare($query1);
            $execution1 ->bindParam(':id', $product['id']);
            $execution1->execute();
            $priceProduct = $execution1 -> fetch();

            $query2 = "INSERT INTO porudzbinadetalji(`id_porudzbine`, `id_proizvoda`, `cena_proizvoda`, `kolicina`) VALUES (:id_porudzbine, :id_proizvoda, :cena_proizvoda, :kolicina)";
            $execution2 = $conn->prepare($query);
            $execution2->bindParam(':id_porudzbine', $orderId);
            $execution2->bindParam(':id_proizvoda', $product['id']);
            $execution2->bindParam(':cena_proizvoda', $priceProduct);
            $execution2->bindParam(':kolicina',$product['quantity']);

            $result2 = $execution2->execute();
            if($result2){
                http_response_code(201);
            }
        }
    }
    else{
        http_response_code(500);
    }
}
?>