<?php
 session_start();
  require_once "config/connection.php";

  include_once "views/fixed/head.php";
  include_once "views/fixed/meni.php";
 

  if(isset($_GET['page'])){
    switch($_GET['page'])
    {
      case 'home':
        include "views/home.php";
        break;
      case 'login': 
        include "views/login.php";
        break;
      case 'registration': 
        include "views/registration.php";
        break;
      case 'store': 
        include "views/store.php";
        break;
      case 'admin': 
        include "views/admin.php";
        break;
      case 'cart': 
        include "views/cart.php";
        break;
      case 'contact': 
        include "views/contact.php";
        break;
      case 'author': 
        include "views/author.php";
        break;
        
    }
  } 
  else {
    include "views/home.php";
  }

  include "views/fixed/footer.php";
?>