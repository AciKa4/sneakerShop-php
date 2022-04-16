<?php
  include_once "config/functions.php";
  include_once "models/getMenu.php";
?>

<div class="container-xl-lg " id="hed">
    <div class="container">
      <div class="row">
          <div class="col-7" id="navigacija">
              <ul id="nav" class="row navisp justify-content-end">
                <?php 
                  foreach($menu as $meni):
                ?>
                  <li class="nav-link"><a href="index.php?page=<?=$meni -> putanja?>" class="nav-item"><?=$meni -> text?></a></li>
                  <?php endforeach;

                  if(isset($_SESSION['admin'])):
                ?>
                <li class="nav-link"><a href="index.php?page=admin" class="nav-item">Admin</a></li>
                <?php endif; ?>
              </ul>
            </div>
            <div class="col-5" id="navigacija">
              <ul id="nav" class="row navisp justify-content-end">          
                <?php 
                    if(!isset($_SESSION['korisnik'])){
                ?>
                  <li class="nav-link"><a href="index.php?page=login" class="nav-item">Login</a></li>
                  <li class="nav-link"><a href="index.php?page=registration" class="nav-item">Register</a></li>
                  <?php }
                  else{
                    ?>
                    <li class="nav-link"><a href="index.php?page=cart"><i class='fa fa-shopping-cart'></i></a></li>
                    <li class="nav-link"><a href="models/logout/logout.php" class="nav-item">Logout</a></li>
              <?php } ?>
              </ul>
            </div>


            <div class="text-center hamb col-10">
            <i class="fa fa-bars"></i>
            <ul id="nav" class="navisp justify-content-center meniResp nav">
                <?php 
                  foreach($menu as $meni):
                ?>
                  <li class="nav-link"><a href="index.php?page=<?=$meni -> putanja?>" class="nav-item"><?=$meni -> text?></a></li>
                  <?php endforeach; ?>

                  <?php 
                    if(!isset($_SESSION['korisnik'])){
                ?>
                  <li class="nav-link"><a href="index.php?page=login" class="nav-item">Login</a></li>
                  <li class="nav-link"><a href="index.php?page=registration" class="nav-item">Register</a></li>
                  <?php }
                  else{
                  if(isset($_SESSION['admin'])):
                ?>
                <li class="nav-link"><a href="index.php?page=admin" class="nav-item">Admin</a></li>
                <?php endif; ?>
                  <li class="nav-link"><a href="index.php?page=cart"><i class='fa fa-shopping-cart'></i></a></li>
                  <li class="nav-link"><a href="models/logout/logout.php" class="nav-item">Logout</a></li>
                 <?php 
                  } ?>
              </ul>
            </div>
        </div>
    </div>
</div>
