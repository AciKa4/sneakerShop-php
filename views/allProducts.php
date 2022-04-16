
<?php 
include "models/products/pages.php";  
?>

<div class="col-lg-6">
            <div class="row mb-5" id="products">
            <?php foreach($proizvodi as $p): ?>
                <div class="col-5 col-md-3 mb-3 pt-2 product">
                    <img src="assets/img/thumbnails/<?=$p -> thumbSlika?>" alt="<?=$p -> naziv?>" class="img-fluid frontpic">
                    <p class="border-bottom pb-3"><?=$p -> naziv?></p>
                    <div class="pt-2 pb-3 ">
                        <span class="red">$<?=$p -> cena?> </span><br>
                        <span><del>$<?=$p -> staracena?> </del></span> <br>
                        <div class="cart text-center"> 
                            <a class="seeMore" href="<?=$_SERVER['PHP_SELF']?>?page=store&idProizvoda=<?=$p -> id?>" data-id="<?=$p -> id?>">See More</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-7 mt-5 ml-5 mx-auto page text-center">

        <?php 
        for($i=1; $i<=$brStrana; $i++){

        if($strana == $i){
            echo "<a class='pg active py-3' href='".$_SERVER['PHP_SELF']."?page=store&strana=$i'>$i</a>";
        }
        else {
            echo "<a class='pg active py-3' href='".$_SERVER['PHP_SELF']."?page=store&strana=$i'>$i</a>";
            }
        }?>
        </div>
    </div>
</div>