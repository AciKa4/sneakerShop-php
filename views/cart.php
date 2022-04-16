<?php
     if(!isset($_SESSION['korisnik'])) {
        http_response_code(404);
        header('Location: index.php?page=home');
        exit();
    }
?>

<div class="col-12 text-center cartDiv">
       
</div>