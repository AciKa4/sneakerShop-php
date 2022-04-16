<h2 class="text-center py-3">Add product </h2>
 <div class="container-fluid update mt-5">
 <form action="" method="post" enctype="multipart/formdata" class=" w-50 mx-auto" name="formainsert">
    <div class="row d-flex justify-content-center">
        <label for="imeProizvoda" class="col-sm-2">Product name</label>
        <div class="col-sm-6 ">
            <input type="text" class="imeProizvodaUp formcontrol textcenter" name="imeProizvodaUp" value="" placeholder= "Insert name" required/>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <label for="cenaProizvoda" class="col-sm-2">Product price</label>
        <div class="col-sm-6">
            <input type="text" class="cenaProizvodaUp formcontrol textcenter" name="cenaProizvodaUp" value="" placeholder= "Insert new price" required/>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <label for="cenaProizvoda" class="col-sm-2">Old price</label>
        <div class="col-sm-6">
            <input type="text" class="staracenaProizvodaUp formcontrol textcenter" name="staracenaProizvodaUp" value="" placeholder= "Insert old price" required/>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <label for="kolicina" class="col-sm-2">Quantity</label>
        <div class="col-sm-6">
            <input type="text" class="kolicinaUp formcontrol textcenter" name="kolicinaUp" value="" placeholder="Insert quantity"required/>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <label for="brandProizvoda" class="col-sm-2">Brand</label>
        <div class="col-sm-6">
            <select class="brandProizvoda formcontrol text-center"   id="brandProizvoda" name="brandProizvoda" required>
            <option value="0" selected>Choose brand</option>
            <?php foreach($izvrsiBrend as $b) : ?>
            <option value="<?=$b -> id?>"><?=$b -> naziv ?></option>
            <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <label for="polProizvoda" class="col-sm-2">Gender</label>
    <div class="col-sm-6">
        <select class="polProizvodaUp w-25form-control textcenter" id="polProizvodaUp" name="polProizvodaUp" required>
        <option value="0" selected>Choose gender</option>
            <?php foreach($izvrsiPol as $p) : ?>
            <option value="<?=$p -> id?>"><?=$p -> pol?></option>
            <?php endforeach;?>
        </select>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <label for="glavnaSlika" class="col-sm-2">Main picture</label>
        <div class="col-sm-6">
        <input type="file" class="glavnaSlika textcenter"  id="glavnaSlika" name="glavnaSlika" />
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-sm-6">
        <input type="hidden" class="idProizvodaUp textcenter" name="idProizvodaUp" value="<?= $id ?>" required/>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-10 text-center mx-auto">
        <input type="button" class="donebtn" name="donebtn" value="Add product" />
        <i class="fa fa-info-circle ml-2" ariahidden="true" data-toggle="tooltip" dataplacement="top" title="Everything must be entered as initially shown"></i>
        </div>
    </div>
 </form>
 </div>