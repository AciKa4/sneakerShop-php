<?php 

    $elementiTxtFajla = file(PAGE_ENTRY);
    $brElemenata = count($elementiTxtFajla);

    $kontakt = 0;
    $prodavnica = 0;
    $autor = 0;
    $admin = 0;
    $korpa = 0;
    $login = 0;
    $home = 0;
    $registracija = 0;

    for($i=0; $i < $brElemenata; $i++){
        $pojedinacniElementi = explode("\t", $elementiTxtFajla[$i]);
        $stranica = $pojedinacniElementi[0];
        switch($stranica){
            case "Kontakt":
                $kontakt++;
                break;
            case "Prodavnica":
                $prodavnica++;
                break;
            case "Admin":
                $admin++;
                break;
            case "Home":
                $home++;
                break;
            case "Korpa":
                $korpa++;
                break;
            case "Login":
                $login++;
                break;
            case "Autor":
                $autor++;
                break;
            case "Registracija":
                $registracija++;
                break;
        }
    }

?>
