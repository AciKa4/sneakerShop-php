<?php

if(isset($_GET['idProizvoda'])){
    include "views/product.php";
}
else {
    include "views/categoriesProducts.php";
}
?>