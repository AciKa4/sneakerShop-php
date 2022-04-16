
<?php 
include "models/categories/getGenders.php";
include "models/categories/getBrands.php";
?>

<div class="mt-5 col-lg-4">
    <div class="row">
        <div class="col-lg-7 d-lg-block mx-auto">
            <div class="row">
                <div class="col-11">
                    <p class="filterRas vidljiv prikazFiltera">Brand</p>
                    <form class="markaDva">
                         <?php 
                            foreach($izvrsiBrend as $brend):
                        ?>
                        <input type="radio" name="chbPol" value="<?=$brend -> id?>" class="brend"/><label class="ml-2"> <?=$brend -> naziv?></label> <br>
                        <?php endforeach; ?>
                        </lab></lab></lab></lab>
                    </form>
                </div>
                <div class="col-11">
                    <p class="filterRas vidljiv prikazFiltera">Price </p>
                    <form oninput="">
                        <input type="range" min="0" max="250" value="0" id="klizac" class="mt-2 mb-3">
                        <output id="vrednost">0.00 $</output>
                    </form>
                </div>
                <div class="col-11">
                    <p class="filterRas vidljiv prikazFiltera">Gender </p>
                    <form>  
                        <?php foreach($izvrsiPol as $pol): ?>
                            <input type="radio" name="chbPol" value="<?=$pol -> pol?>" class="sortirajPoPolu"/><label class="ml-2"> <?=$pol -> pol?></label> <br>
                         <?php endforeach; ?>
                    </form>
                </div>   
            </div>
        </div>
    </div>
</div>