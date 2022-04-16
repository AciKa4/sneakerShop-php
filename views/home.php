<div class="container-xl-lg" id="banner"> 
    <img src="assets/img/banner.jpg" class="img-fluid bg-dark" />
  </div>
   <!--content-->
   <button class="up">
    <i class="fa fa-chevron-up"></i>
  </button>
  <div class="container-xl-lg p-5">
    <div class="container">
      <div>
        
        <h1 class="tekstnaslov">Best place to buy new sneakers</h1>
      </div>
      <div class="row ">
        <div class="col-xl-4 col-md-12">
            <div id="pic">   
            </div>
            <div>
              <h2 class="tekstnaslov">
                ASICS GEL-KAYANO 14
              </h2>
              <p class="tekst"><a href="<?=$_SERVER['PHP_SELF']?>?page=store" >Buy now</a></p>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
          <div id="pic1">   
          </div>
          <div>
              <h2 class="tekstnaslov">
                PUMA MIRAGE MOX
              </h2>
              <p class="tekst"><a href="<?=$_SERVER['PHP_SELF']?>?page=store" >Buy now</a></p>
          </div>
        </div>
        <div class="col-xl-4 col-md-12">
          <div id="pic2">   
          </div>
          <div>
              <h2 class="tekstnaslov">
                NIKE AIR MAX
              </h2>
              <p class="tekst"><a href="<?=$_SERVER['PHP_SELF']?>?page=store" >Buy now</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content 2 -->
  <div id="marke">
    <?php
    include "models/getBrands.php";
    foreach($marke as $marka):
      if($marka -> id % 2 == 1){
    ?>

    <div class="container-xl-lg bg-slika p-5"> 
                    <div class="container">
                      <div class="row pt-5">
                        <div class="col-xl-7 col-md-12 picpatike">
                          <img src="assets/img/<?=$marka -> slika?>" alt="<?=$marka -> naziv?>"/>
                        </div>
                        <div class="col-xl-5 col-md-12 tekstpatike pt-5">
                          <h1><?=$marka -> naziv?></h1>
                          <h2><?=$marka -> text?></h2>
                          <p><?=$marka -> opis?></p>
                          <div class="buylink">
                            <a href="<?=$_SERVER['PHP_SELF']?>?page=store">Buy now</a>
                          </div>
                        </div>
                      </div>
                    </div>
      </div>
    <?php 
      }
      else{
    ?>
          <div class="container-xl-lg bg-slika1 p-5 "> 
                        <div class="container">
                        <div class="row pt-5">
                            <div class="col-xl-5 col-md-12 tekstpatikewhite pt-5">
                            <h1><?=$marka -> naziv?></h1>
                            <h2><?=$marka -> text?></h2>
                            <p><?=$marka -> opis?></p>
                            <div class="buylink">
                                <a href="<?=$_SERVER['PHP_SELF']?>?page=store">Buy now</a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 picpatike text-right">
                        <img src="assets/img/<?=$marka -> slika?>" alt="<?=$marka -> naziv?>"/>
                        </div>
                    </div>
                    </div>
                    </div>
  <?php 
      }
  endforeach; 
      ?>
  </div>