<?php
    $id = $_GET["idProizvoda"];
    if(filter_var($id,FILTER_VALIDATE_INT) === false){
    die("No valid ID");
    }
    include "models/products/product/getProduct.php";
    include "models/products/product/getGender.php";
    include "models/products/product/getBrand.php";
?>



<div class="container-xl">
  <div class="row productone">
      <div class="levo col-xl-6 col-sm-12">
          <img src="assets/img/<?=$p -> glavnaSlika ?>" alt="<?=$p -> naziv?>" class="img-fluid">
      </div>
      <div class="desno col-xl-6  col-sm-12"> 
            <p class="border-bottom pb-3"><?=$p ->naziv?></p>
            <div class="pt-2 pb-3 ">
                <span > New price: $<?=$p -> cena?> </span><br>
                <span>Brand: <?=$brend ->naziv?> </span> <br>
                <?php if($p -> kolicina>0): ?>
                  <span class="text-success">In stock</span><br>
                <?php else: ?>
                  <span class="text-danger">Not in stock</span><br>
                <?php endif;?>
                <span >Gender: <?=$pol -> pol?> </span><br>
                <span>Old price: <del>$<?=$p -> staracena?> </del></span><br>
                <?php if(isset($_SESSION['korisnik'])): 
                      if($p -> kolicina > 0):
                  ?>
                  <div class="cart py-5 w-25 kupi"> 
                      <button class="addToCart buylink" href="#" data-id="<?=$p -> id?>">Add to Cart</button>
                  </div>
                  <?php else: ?>
                    <p class="py-1 font-weight-bold">Sorry, we don't have this item in stock. </p>
                    <?php endif; ?>
                  <?php else: ?>
                    <div class="text-danger py-1"> 
                     <p>Please login to add to cart. </p>
                  </div>
                  <div class="cart w-25 kupi"> 
                      <button class="addToCart buylink disabled" href="#" data-id="<?=$p -> id?>" disabled>Add to Cart</button>
                  </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['admin'])):?>
                <div class="row">
                  <div class="col-12 mt-3">
          <a href="models/products/product/deleteProduct.php?idProizvoda=<?=$id?>"><input type="button" value="Delete product" id="deletebtn" name="deletebtn" class="btn btn-outline-dark float-right mr-4"/></a>
          <input type="button" value="Update product" name="updatebtn" class="btnza btn btn-outline-dark float-right mr-2 updatebtn " />
                  </div>
                </div>
              <?php endif; ?>
      </div>
    </div>
  </div>
</div>


<div class="updateforma container-xl-lg ">
              <?php if(isset($_SESSION['admin'])): ?>
              <h2 class="text-center py-3">Add product </h2>
              <div class="container-fluid update mt-5">
              <form action="" method="post" enctype="multipart/formdata" class=" w-50 mx-auto" name="formaupdate">
                  <div class="row d-flex justify-content-center">
                      <label for="imeProizvoda" class="col-sm-2">Product name</label>
                      <div class="col-sm-6 ">
                          <input type="text" class="imeProizvodaUp formcontrol textcenter" name="imeProizvodaUp" value="<?=$p -> naziv?>" required/>
                      </div>
                  </div>
                  <div class="row d-flex justify-content-center mt-4">
                      <label for="cenaProizvoda" class="col-sm-2">Product price</label>
                      <div class="col-sm-6">
                          <input type="text" class="cenaProizvodaUp formcontrol textcenter" name="cenaProizvodaUp" value="<?=$p -> cena?>" required/>
                      </div>
                  </div>
                  <div class="row d-flex justify-content-center mt-4">
                      <label for="cenaProizvoda" class="col-sm-2">Old price</label>
                      <div class="col-sm-6">
                          <input type="text" class="staracenaProizvodaUp formcontrol textcenter" name="staracenaProizvodaUp" value="<?=$p -> staracena?>" required/>
                      </div>
                  </div>
                  <div class="row d-flex justify-content-center mt-4">
                      <label for="kolicina" class="col-sm-2">Quantity - Available</label>
                      <div class="col-sm-6">
                          <input type="text" class="kolicinaUp formcontrol textcenter" name="kolicinaUp" value="<?=$p -> kolicina?>" required/>
                      </div>
                  </div>
                  <div class="row d-flex justify-content-center mt-4">
                      <label for="brandProizvoda" class="col-sm-2"> Category - Brand</label>
                      <div class="col-sm-6">
                      <?php 
                        include "models/categories/getBrands.php";
                        include "models/categories/getGenders.php";
                      ?>
                          <select class="brandProizvoda formcontrol text-center" name="brandProizvoda" required>
                          <option value="<?=$brend -> id?>" selected> <?=$brend -> naziv?> </option>
                         <?php foreach($izvrsiBrend as $sb):
                            if($sb -> id != $brend ->id):
                          ?>
                           <option value="<?=$sb -> id?>"><?=$sb -> naziv?></option>
                           <?php endif; endforeach;?>
                          </select>
                      </div>
                  </div>
                  
                  <div class="row d-flex justify-content-center mt-4">
                      <label for="polProizvoda" class="col-sm-2">Gender</label>
                  <div class="col-sm-6">
                      <select class="polProizvodaUp w-25form-control textcenter"  name="polProizvodaUp" required>
                          <option value="<?=$pol -> id?>" selected><?=$pol -> pol?></option>
                          <?php foreach($izvrsiPol as $ip):
                            if($ip -> id != $pol -> id):
                          ?>
                           <option value="<?=$ip ->id?>"><?=$ip -> pol?></option>
                           <?php endif; endforeach;?>
                      </select>
                      </div>
                  </div>
                  <div class="row d-flex justify-content-center mt-4">
                      <label for="glavnaSlika" class="col-sm-2">Main picture</label>
                      <div class="col-sm-6">
                      <input type="file" class="glavnaSlika textcenter" name="glavnaSlika" />
                      </div>
                  </div>
                  <div class="row d-flex justify-content-center mt-4">
                      <div class="col-sm-6">
                      <input type="hidden" class="idProizvodaUp textcenter" name="idProizvodaUp" value="<?= $id ?>" required/>
                      </div>
                  </div>
                  <div class="row mt-5">
                      <div class="col-sm-10 text-center mx-auto">
                      <input type="button" class="donebtn" name="donebtn" value="Update product" />
                      <i class="fa fa-info-circle ml-2" ariahidden="true" data-toggle="tooltip" dataplacement="top" title="Everything must be entered as initially shown"></i>
                      </div>
                  </div>
              </form>
              </div>
            </div>
            <?php endif; ?>
              </div>