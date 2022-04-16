<?php 
    include "models/admin/allProducts.php";
?>
<div class="row d-flex align-items-center">
                <div class="col-12 mt-5 mb-5 mx-auto">
                    <table class="col-12 mx-auto"> 
                        <thead class="mt-3 mb-3 p-1 border border-dark col-12 obojiPozadinuPlavu">
                            <tr class="p-1">
                                <th class="p-2 border border-dark text-center">Picture</th>
                                <th class="p-2 border border-dark text-center">Name</th>
                                <th class="p-2 border border-dark text-center">Quantity</th>
                                <th class="p-2 border border-dark text-center">Price</th>
                                <th class="p-2 border border-dark text-center" colspan="2">Update/Delete</th>
                            </tr>
                        </thead>
                        <tbody class="mt-3 mb-3 p-1 border border-dark text-center col-12">

                        <?php foreach($proizvodi as $pk): ?>
                            <tr class="p-1 border-bottom border-dark">
                                <td class="p-2"><img src="assets/img/thumbnails/<?= $pk -> thumbSlika ?>" alt="<?= $pk -> naziv?>" class="img-fluid urediSlikeAdminPanela"/></td>
                                <td class="p-2"><?= $pk -> naziv?></td>
                                <td class="p-2"><?= $pk ->kolicina?></td>
                                <td class="p-2 "><?= $pk -> cena?>$</td>
                                <td class="p-2">
                                <a href="<?=$_SERVER['PHP_SELF']?>?page=store&idProizvoda=<?=$pk -> id?>"><input type="button" value="Update product" id="deletebtn" name="updatebtn" class="btnza btn btn-outline-dark float-right mr-2 updatebtn " /></a>
                                </td>
                                <td class="p-2">
                                    <a href="models/products/product/deleteProduct.php?idProizvoda=<?=$pk -> id?>"><input type="button" value="Delete product" id="deletebtn" name="deletebtn" class="btn btn-outline-dark float-right mr-4" /></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
</div>