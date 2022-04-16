<?php
session_start();

if($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(404);
exit;
}

header("Content-type: application/json");

$email = $_POST['email'];
$lozinka = $_POST['sifra'];
$regexEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
$greske = [];

if(!preg_match($regexEmail, $email)){
    $greske[] = "Email not in good format";
}

if(count($greske) == 0){  
    include "../../config/connection.php";
    $upit = "SELECT id, email, idUloge,ime FROM korisnici WHERE email = :email AND password = :lozinka AND aktivan = 1";
    $priprema = $conn->prepare($upit);
    $priprema->bindParam(":email", $email);

    $lozinka = md5($lozinka);
    $priprema->bindParam(":lozinka", $lozinka);

    $priprema->execute();

    if($priprema->rowCount() == 1){
        http_response_code(200);
        echo json_encode("uspelo");
        $korisnik = $priprema->fetch();

        if($korisnik -> idUloge == 1){
            $_SESSION['admin'] = $korisnik;
            $_SESSION['korisnik'] = $korisnik;
            loginUsers($korisnik);
        }
        else if($korisnik -> idUloge == 2) {
            $_SESSION['korisnik'] = $korisnik;
            loginUsers($korisnik);
        }
    }
    else {
        http_response_code(400);
        echo json_encode("Wrong password or email. Please try again.");
        errorsInTxt("Wrong password or email. Please try again.");
    }
}
else {
    http_response_code(400);
    echo json_encode($greske);
}
?>


