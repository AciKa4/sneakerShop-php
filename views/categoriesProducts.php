<div class="container p-5">
    <div class="row centriranje">
        <div class="ml-3 col-lg-12 col-12 pt-2 mx-auto">
            <form>
            <select id="sortiranje">
                <option value="0">Sort</option>
                    <option value="desc">High to low price</option>
                    <option value="asc">Low to high price</option>
                    <option value="descbyName">Sort by name</option>   
                </select>
            </form>
        </div>
     </div>
</div>

<div class="container-fluid">
<div class="row">
 <?php 
    include "views/sortCategories.php";
    include "views/allProducts.php"; 
 ?>
</div>
</div>