
$(document).ready(function(){
  
let lokacija = location.href;

mobileNav();
$("#klizac").change(sortirajCenu);
$("#sortiranje").change(sortiranje);
$(".sortirajPoPolu").click(sortiranjePol);
$(".brend").change(brend);

// registracija 
if(lokacija.indexOf("index.php?page=registration") != -1){
    document.getElementById("submitRegister").addEventListener("click", proveraRegistracije);
    document.getElementById("ok").addEventListener("click", function(){
        document.getElementById("popup").style.display = "none";
        window.location.replace("index.php");
    });
    
}

//contact
if(lokacija.indexOf("index.php?page=contact") != -1){
    $("#form-submit").click(proveriFormu);
}

//proizvod
if(lokacija.indexOf("index.php?page=store&idProizvoda") != -1) {
    $(".addToCart").click(addToCart);
    $('.btnza').click(function(){
        $('.updateforma').show();
    });
     $(".donebtn").click(proveraUpdate);
}

//admin panel
if(lokacija.indexOf("index.php?page=admin") != -1){
    $('.donebtn').click(proveraInsert); 
}

//cart
if(lokacija.indexOf("index.php?page=cart") != -1) {
    let products = anyInCart();
    check(products);
}

// login
if(lokacija.indexOf("index.php?page=login") != -1){
    document.getElementById("submit").addEventListener("click", proveraLogina);
    document.getElementById("ok").addEventListener("click", function(){
        document.getElementById("popup").style.display = "none";
        window.location.replace("index.php");
    });
}

});

// responsive navigacija, strelica i skrol
function mobileNav(){  
    $(".meniResp li").hide();
    $('.hamb').click(function(){
     $(".meniResp li").stop().slideToggle('slow');
    });
}

// provera registracije i login-a
function proveraRegistracije(){
    var ime, prezime, sifra, email, potvrdiSifru;
    var ispravno = true;
     
    ime = document.getElementById("firstName").value;
    prezime = document.getElementById("lastName").value;
    sifra = document.getElementById("regPass").value;
    potvrdiSifru = document.getElementById("confPass").value;
    email = document.getElementById("regEmail").value;
    var reIme, rePrezime, reEmail, reSifra;

    reIme = /^[A-Z][a-z]{1,13}$/;
    rePrezime = /^([A-Z][a-z]{1,30}\s?)+$/;
    reEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    reSifra = /^.{4,50}$/;

    if(ime == ""){
        document.getElementById("imeGreska").innerHTML = "First name is required!";    
        ispravno = false;
    }
    else if(!reIme.test(ime)){
        document.getElementById("imeGreska").innerHTML = "First name not entered correctly!";
        document.getElementById("obavestenje").style.display = "block";
        ispravno = false;
    }
    else {
        document.getElementById("imeGreska").innerHTML = "";
    }
    if(prezime == ""){
        document.getElementById("prezimeGreska").innerHTML = "Last name is required!";
        ispravno = false;
    }
    else if(!rePrezime.test(prezime)){
        document.getElementById("obavestenje").style.display = "block";
        document.getElementById("prezimeGreska").innerHTML = "Last name not entered correctly!";
        ispravno = false;
    }
    else {
        document.getElementById("prezimeGreska").innerHTML = "";
    }
    if(email == ""){
        document.getElementById("emailGreska").innerHTML = "Email is required!";
        ispravno = false;
    }
    else if(!reEmail.test(email)){
        document.getElementById("emailGreska").innerHTML = "Email not entered correctly";
        ispravno = false;
    }
    else {
        document.getElementById("emailGreska").innerHTML = "";
    }
    if(sifra == ""){
        document.getElementById("sifraGreska").innerHTML = "Password is required!";
        ispravno = false;
    }
    else if(!reSifra.test(sifra)){
        document.getElementById("sifraGreska").innerHTML = "Password must have atleast 4 characters!";
        ispravno = false;
    }
    else {
        document.getElementById("sifraGreska").innerHTML = "";
    }
    if(potvrdiSifru == ""){
        document.getElementById("sifraPotvrdiGreska").innerHTML = "Password confirmation is required!";
        ispravno = false;
    }
    else if(potvrdiSifru != sifra){
        document.getElementById("sifraPotvrdiGreska").innerHTML = "Password is not the same!";
        ispravno = false;
    }
    else {
        document.getElementById("sifraPotvrdiGreska").innerHTML = "";
    }
    if(ispravno){
        $.ajax({
        url: "models/registration/registration.php",
        method: "POST",
        data: {
            ime : ime,
            prezime : prezime,
            email : email,
            sifra: sifra,
            potvrdiSifru: potvrdiSifru
        },
        success: function(data){
            document.getElementById("textModal").innerHTML = data;
             document.getElementById("popup").style.display = "block";
            document.getElementById("obavestenje").style.display = "none";
           
        },
        error: function(xhr){
            if(xhr.status == 400) {
            console.log(xhr.responseJSON);
            document.getElementById("emailGreska").innerHTML = xhr.responseJSON;
        }
        }
    });
    } 
}

function proveraLogina(){
    var ispravno = true;
    var email = document.getElementById("regEmail").value;
    var sifra = document.getElementById("regPass").value;
    var reEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;

    if(email == ""){
        document.getElementById("emailGreska").innerHTML = "Email is required!";
        ispravno = false;
    }
    else if(!reEmail.test(email)){
        document.getElementById("emailGreska").innerHTML = "Email not entered correctly";
        ispravno = false;
        }
    else {
        document.getElementById("emailGreska").innerHTML = "";
    }
    if(sifra == ""){
        document.getElementById("sifraGreska").innerHTML = "Password is required!";
        ispravno = false;
    }
    else {
        document.getElementById("sifraGreska").innerHTML = "";
    }
    if(ispravno){
        $.ajax({
        url: "models/login/login.php",
        method: "POST",
        data: {
        email : email,
        sifra : sifra
        },
        success: function(data){
            document.getElementById("textModal").innerHTML = "You are logged in!";
            document.getElementById("popup").style.display = "block";
            document.getElementById("poruka").style.display= "none";
        },
        error: function(xhr){
            if(xhr.status == 400) {
            console.log(xhr.responseJSON);
            document.getElementById("poruka").innerHTML = xhr.responseJSON;
            }
        }
    });
    }
}

//cena  klizac
function sortirajCenu(){
    let cena = $("#klizac").val()
    $("#vrednost").html(cena+".00 $");
    $('.page').hide();
    
    $.ajax({
        url: "models/products/priceRange.php",
        method:"post",
        data:{
            cena: cena
        },
        success: function(result){
            prikazProizvoda(result);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}

//cena high to low i low to high i po nazivu
function sortiranje(){
    let val = $("#sortiranje").val();
    $('.page').hide();

    $.ajax({
        url: "models/products/sort.php",
        method:"post",
        data:{
            val: val
        },
        success: function(result){
            prikazProizvoda(result);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}

// filtriraj po polu
function sortiranjePol(){
    let val = $(this).val();

    $.ajax({
        url: "models/products/filterGender.php",
        method:"post",
        data:{
            val: val
        },
        success: function(result){
            prikazProizvoda(result);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}



// prikazivanje proizvoda
function prikazProizvoda(result){
    let html = "";

    if(result.length == 0){
        html = "<p>No such products.</p>";
    }

    for(var i=0; i < result.length; i++){
        html+=`<div class="col-5 col-md-3 mb-3 pt-2 product">
        <img src="assets/img/thumbnails/${result[i].thumbSlika}" alt="${result[i].naziv}" class="img-fluid frontpic">
        <p class="border-bottom pb-3">${result[i].naziv}</p>
        <div class="pt-2 pb-3 ">
            <span class="red">$${result[i].cena}</span><br>
            <span><del>$${result[i].staracena} </del></span> <br>
            <div class="cart text-center"> 
                <a class="seeMore" href="index.php?page=store&idProizvoda=${result[i].id}" data-id="${result[i].id}">See More</a>
            </div>
        </div>
    </div>`
    }

    $("#products").html(html);
}

//brend
function brend(){
    let val = $(this).val();
    $('.page').hide();
   

    $.ajax({
        url: "models/products/filterBrand.php",
        method:"post",
        data:{
            id: val
        },
        success: function(result){
            prikazProizvoda(result);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}


// cart funckionalnost  
function addToCart(){

    var id = $(this).data('id');
    var products = anyInCart();

    if(!products){
        let products = [];
        products[0]={
           id:id,
           quantity:1
    };
    alert("Your item has been added to the cart!");  
    setItemToLS("products",products);  
    }

    else{
        if(!inLocalStorage(products, id)) {
            addToLocalStorage(id);
            alert("Your item has been added to the cart!");  
        }
        else{
            alert("Already in cart!");
        }
    }   
}

//funk proverava da li je prazan localstorage za proizvode 
function anyInCart(){
    return JSON.parse(localStorage.getItem("products"));
}
 
//provera da li se proizvod vec nalazi u localstorage-u  
function inLocalStorage(products, id) {
    return products.find(p => p.id == id);
}

//dodavanje proizvoda u localstorage  
function addToLocalStorage(id) {
    let products = anyInCart();
    products.push({
    id : id,
    quantity : 1
    });
    setItemToLS("products",products);
}

//funkcija za postavljanje localstorage-a  
function setItemToLS(key,value){
    localStorage.setItem(key,JSON.stringify(value));
}

//funkcija za dohvatanje localstorage-a
function getItemFromLS(value){
    return JSON.parse(localStorage.getItem(value));
}


function ispisiKorpu(){
    let products = getItemFromLS("products");
    $.ajax({
        url: "models/products/allProductsCart.php",
        method: "GET",
        success: function(data){
            data = data.filter(el => {
                for(let product of products)
                {
                    if(el.id == product.id) {
                        return true;
                    }
                }
            });
            
            ispisiProizvodeUKorpu(data);
            $(".plus").click(povecajKolicinu);
            $(".minus").click(smanjiKolicinu);
          
        },
        error: function(xhr, err, status){
        console.log(status);
        }
    })
}

function ispisiProizvodeUKorpu(data){

        let ispis = "";
        ispis= `
        <div id="orderTable">
            <table class="tableAlign">
                <thead>
                <tr>
                <td>Product Name</td>
                <td>Image</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Available </td>
                <td>Sum</td>
                <td>Remove</td>
               
                </tr>
                </thead>`;
            
        for(let obj of data){

            ispis+=`<tbody>
            <tr>
            <td><h5>${obj.naziv}</h5></td>
            <td>
                <img src="assets/img/${obj.glavnaSlika}" alt="${obj.naziv}" class="img-fluid">
            </td>
            <td class="price">$${obj.cena}</td>
            <td class="quantity">
                <div class="d-flex flex- justify-contentbetween ml-2 mr-2">
                <a href="#" class="plus"><i class="fa fa-plus mr1 pt-1 pl-3" aria-hidden="true"></i></a>
                <input type="text" class="kolicinaUzeto w-75 text-center mx-auto" name="kol" value="1" disabled />
                <a href="#" class="minus"><i class="fa fa-minus ml-1 pt-1 pr-3" aria-hidden="true"></i></a>
                </div>
            </td>
            <td>
                <p class="mt-3 kolicina">${obj.kolicina}</p>
            </td>
            <td>
                <span>$</span>
                <input type="text" class="ukupnaCena w-50 text-center" name="ukupnaCena" value="${obj.cena}" disabled data-cena="${obj.cena}" data-id="${obj.id}""/>
            </td>
            <td>
                <button onclick ="removeItem(${obj.id})" class="btn btn-outline-danger btnRemove">Remove</button>
                
            </td>
        </tr>
        </tbody>`;
        }
        ispis+=` </table>
                        </div>
                    <div class="container">
                            <div class="row d-flex justify-content-end" id="controls">
                                    <button id="purchase" onclick ="buy()" class="btn btn-info m-2">Purchase</button>
                                    <button id="removeAll" onclick="removeAll()" class="btn btn-danger m-2">Remove All</button>
                            </div>
                        </div>`;

        $(".cartDiv").html(ispis);
}

function showEmptyCart() {
    $(".cartDiv").html("<div class='mx-auto d-flex w-75'><img class=' w-50 mx-auto' src='assets/img/emptycart.png' alt='Your cart is empty'></div><h1 class='py-3'>Your cart is empty</h1>")
}

//provera za korpu, ukoliko je prazna ispisuje poruku, ukoliko nije pravi se tabela proizvoda
function check(productsInCart){
    if(productsInCart){
        if(productsInCart.length){
            ispisiKorpu();
        }
        else
            showEmptyCart();
    }
    else
        showEmptyCart();  
}

//isprazniti korpu
function removeAll(){
    localStorage.removeItem("products");
    showEmptyCart();
}   

// izbrisati odredjeni proizvod iz korpe
function removeItem(id){
        let products = anyInCart();

        products = products.filter(x => x.id != id);
       setItemToLS("products",products); 
        check(products);
}

// prilikom kupovine se prazni korpa i izbacuje poruka o uspesnoj kupovini proizvoda
function buy(){




    var products = getItemFromLS("products");

    var kolicina = $(".kolicinaUzeto");
    var kolicinaNiz = [];

    for(var i=0; i < kolicina.length; i++){
        var vrednost = parseInt(kolicina[i].value);
        kolicinaNiz.push(vrednost);
    }
   

    var cena = $(".ukupnaCena");
    var cenaNiz = [];

    for(var i=0; i < cena.length; i++){
        var vrednost = parseInt(cena[i].value);
        cenaNiz.push(vrednost);
    }

    $.ajax({
        url: "models/cart/insertOrder.php",
        method: "POST",
        data: {
            "products" : products,
            "kolicinaNiz": kolicinaNiz,
            "cenaNiz": cenaNiz
        },
        success: function(data){
                alert("Your order has been placed.");
                localStorage.removeItem("products");
                showEmptyCart();
            },
        error: function(xhr, err, status){
            if(xhr.status == 400){
            console.log(xhr.responseJSON);
            }
        }
        });

    
}

//prazna korpa
function showEmptyCart() {
    $(".cartDiv").html("<div class='mx-auto d-flex w-75'><img class=' w-50 mx-auto' src='assets/img/emptycart.png' alt='Your cart is empty'></div><h1 class='py-3'>Your cart is empty</h1>")
}

function povecajKolicinu(e){
    e.preventDefault();

    var cartProducts = getItemFromLS("products");

    var productId =($(this).parent().parent().next().next().find(".ukupnaCena").data("id"));

    var vrednost  = $(this).next().val();
    vrednost++;

    $(this).next().attr("value",vrednost);

    var cenaProizvoda = Number($(this).parent().parent().next().next().find(".ukupnaCena").val());
    var pocetnaCena =Number($(this).parent().parent().next().next().find(".ukupnaCena").data("cena"));

  
    var cena;

    if(vrednost == 0)
        cena = 0;
    else{
        var cena = cenaProizvoda + pocetnaCena;
    }

    if(cena == 0){
        cena = pocetnaCena;
    }    

    var kolicina  = $(this).parent().parent().next().find('.kolicina').text();
    
    if(kolicina < vrednost){
        alert("Not enough in stock!");
        $("#purchase").attr('disabled','disabled');
    }
    $(this).parent().parent().next().next().find(".ukupnaCena").attr("value",cena);
  
      
    for(let i in cartProducts) {
        if(productId == cartProducts[i].id) 
        cartProducts[i].quantity = vrednost;
        break;
    }
    setItemToLS("products",cartProducts); 
}

function smanjiKolicinu(e){
    e.preventDefault();


    var cartProducts = getItemFromLS("products");
    var productId =($(this).parent().parent().next().next().find(".ukupnaCena").data("id"));

    var vrednost = $(this).prev().val();

    if(vrednost > 1){
     vrednost--;
    }

    $(this).prev().attr("value",vrednost);

    var cenaProizvoda = Number($(this).parent().parent().next().next().find(".ukupnaCena").val());
    var pocetnaCena =Number($(this).parent().parent().next().next().find(".ukupnaCena").data("cena"));
    
    var cena = cenaProizvoda - pocetnaCena;

    if(cena < 0)
        cena = 0;
    if(vrednost == 1){
        cena = pocetnaCena;
    }

    var kolicina  = $(this).parent().parent().next().find('.kolicina').text();
    
    if(vrednost <= kolicina){
        $("#purchase").removeAttr('disabled');
    }

    $(this).parent().parent().next().next().find(".ukupnaCena").attr("value",cena);

    for(let i in cartProducts) {
        if(productId == cartProducts[i].id) 
        cartProducts[i].quantity = vrednost;
        break;
    }
    setItemToLS("products",cartProducts); 
}

//prover update-a
function proveraUpdate(){
    var ime, cena, brandProizvoda, pol, kolicina, id, glavnaSlika,staracena;
    var ispravno = true;
    var data = new FormData();

    function dohvatanjePolja(glavnoPolje,polje){
         return $(glavnoPolje).parent().parent().parent().find(polje).val();
    };

    ime = dohvatanjePolja(this, ".imeProizvodaUp");
    cena = dohvatanjePolja(this, ".cenaProizvodaUp");
    kolicina = dohvatanjePolja(this, ".kolicinaUp");
    staracena = dohvatanjePolja(this, ".staracenaProizvodaUp");
    brandProizvoda = dohvatanjePolja(this, ".brandProizvoda");
    pol = dohvatanjePolja(this, ".polProizvodaUp");
    id = dohvatanjePolja(this, ".idProizvodaUp");

    var glavnaSlika = document.forms['formaupdate']['glavnaSlika'].files[0];

    function daLiJePrazno(key, klasa){
        if(key == "" || key == "0"){
            ispravno = false;
            $(klasa).addClass("crveno");
        }
        else {
            $(klasa).removeClass("crveno");
        }
    }

    daLiJePrazno(brandProizvoda, ".brandProizvoda");
    daLiJePrazno(pol, ".polProizvodaUp");

    var regIme, regCena, regZaj;
    regIme = /^[\w\d\s]+$/;
    regCena = /^[0-9]+\.?[0-9]*$/;
    regZaj = /^[0-9]{1,}$/;

    function proveriReg(reg, key, klasa){
        if(!reg.test(key)){
            ispravno = false;
            $(klasa).addClass("crveno");
        }
        else {
            $(klasa).removeClass("crveno");
        }
    }

    proveriReg(regIme, ime, ".imeProizvodaUp");
    proveriReg(regCena, cena, ".cenaProizvodaUp");
    proveriReg(regCena, staracena, ".staracenaProizvodaUp");
    proveriReg(regZaj, kolicina, ".kolicinaUp");

    if(ispravno){
        if(glavnaSlika != undefined){
            data.append("glavnaSlika", glavnaSlika);
        }
        

        data.append("ime", ime);
        data.append("cena", cena);
        data.append("staracena",staracena);
        data.append("brandProizvoda", brandProizvoda);
        data.append("kolicina", kolicina);
        data.append("pol", pol);
        data.append("id", id);

        $.ajax({
        url: "models/products/product/updateProduct.php",
        method: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function(data){
            alert(data);
            location.reload();
            },
        error: function(xhr, err, status){
            if(xhr.status == 400){
            console.log(xhr.responseJSON);
            }
        }
        });
    }
}

//prove inserta 
function proveraInsert(){

    var ime, cena, brandProizvoda, pol, kolicina, id, glavnaSlika,staracena;
    var ispravno = true;
    var data = new FormData();
    var glavnaSlika = document.forms['formainsert']['glavnaSlika'].files[0];

    function dohvatanjePolja(glavnoPolje,polje){
         return $(glavnoPolje).parent().parent().parent().find(polje).val();
    };

    ime = dohvatanjePolja(this, ".imeProizvodaUp");
    cena = dohvatanjePolja(this, ".cenaProizvodaUp");
    kolicina = dohvatanjePolja(this, ".kolicinaUp");
    staracena = dohvatanjePolja(this, ".staracenaProizvodaUp");
    brandProizvoda = dohvatanjePolja(this, ".brandProizvoda");
    pol = dohvatanjePolja(this, ".polProizvodaUp");
    id = dohvatanjePolja(this, ".idProizvodaUp");


function proveriSliku(key, id){
    if(key == undefined){
        document.getElementById(id).classList.add("crveno");
        ispravno = false;
    }
    else {
        document.getElementById(id).classList.remove("crveno");
    }
}


    proveriSliku(glavnaSlika, "glavnaSlika");

    function daLiJePrazno(key, id){
        if(key == "" || key == "0"){
            ispravno = false;
            document.getElementById(id).classList.add("crveno");
        }
        else {
            document.getElementById(id).classList.remove("crveno");
        }
    }

    daLiJePrazno(brandProizvoda, "brandProizvoda");
    daLiJePrazno(pol, "polProizvodaUp");
       
    
    var regIme, regCena, regZaj;
    regIme = /^[\w\d\s]+$/;
    regCena = /^[0-9]+\.?[0-9]*$/;
    regZaj = /^[0-9]{1,}$/;

    function proveriReg(reg, key, klasa){
        if(!reg.test(key)){
            ispravno = false;
            $(klasa).addClass("crveno");
        }
        else {
            $(klasa).removeClass("crveno");
        }
    }

    proveriReg(regIme, ime, ".imeProizvodaUp");
    proveriReg(regCena, cena, ".cenaProizvodaUp");
    proveriReg(regCena, staracena, ".staracenaProizvodaUp");
    proveriReg(regZaj, kolicina, ".kolicinaUp");

    if(ispravno){
        if(glavnaSlika != undefined){
            data.append("glavnaSlika", glavnaSlika);
        }
     

        data.append("ime", ime);
        data.append("cena", cena);
        data.append("staracena",staracena);
        data.append("brandProizvoda", brandProizvoda);
        data.append("kolicina", kolicina);
        data.append("pol", pol);
        data.append("id", id);
        data.append("glavnaSlika", glavnaSlika);

        
        $.ajax({
            url: "models/products/product/addProduct.php",
            method: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(uspeh){
                alert(uspeh);
                location.reload();
                },
            error: function(xhr, err, status){
                if(xhr.status == 400){
                console.log(xhr.responseJSON);
                }
            }
            });
        

    }
}

// toggle sidebar
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

// slanje poruke
function proveriFormu(){
    var email = $("#email");
    var firstname = $("#firstname");
    var lastname = $("#lastname");
    var valid = $("#forma");
    var ispravno = true;
    
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    var nameRegex =  /^[A-ZČĆŽŠĐ][a-zčćžš]{2,15}$/
    
        //text
        var tekstPolje =$("#message");
        var tekstValid = 0;
    
        if(tekstPolje.val() == ''){
            tekstPolje.css({
            'border':'1px solid  #e60000'
            });
            tekstPolje.val("");
            tekstPolje.attr('placeholder','You can not send empty message');
            tekstValid = 0;
        }
        else {
            tekstPolje.css({
            'border':'1px solid  #fff'
            });
            tekstValid = 1;
        }
    
        //email 
        if(email.val() == ''){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','Email adress can not be empty');
            ispravno = false;
        }
        else if(!emailRegex.test(email.val())){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','e.g. aleksandar14@gmail.com');
            ispravno = false;
        }
        else {
            email.css({
            'border':'1px solid  #fff'
            });
        }
        //firstname 
        if(firstname.val() == ''){
            firstname.css({
            'border':'1px solid  #e60000'
            });
            firstname.val("");
            firstname.attr('placeholder','First name can not be empty');
            ispravno = false;
        }
    
        else if(!nameRegex.test(firstname.val())){
            firstname.css({
            'border':'1px solid  #e60000'
            });
            firstname.val("");
            firstname.attr('placeholder','Please provide a valid first name, must be between 2-12 characters');
            ispravno = false;
        }
        else {
        firstname.css({
            'border':'1px solid  #fff'
            });
        }
    
        //lastname 
        if(lastname.val() == ''){
            lastname.css({
            'border':'1px solid  #e60000'
            });
            lastname.val("");
            lastname.attr('placeholder','Last name can not be empty');
            ispravno = false;
        }
    
        else if(!nameRegex.test(lastname.val())){
            lastname.css({
            'border':'1px solid  #e60000'
            });
            lastname.val("");
            lastname.attr('placeholder','Please provide a valid last name, must be between 2-12 characters');
            ispravno = false;
        }
        else {
            lastname.css({
            'border':'1px solid  #fff'
            });
        }
     // Ukoliko nema gresaka, ispisuje poruku da je uspesno poslata poruka 
        if(ispravno && tekstValid == 1){
            var imevr = firstname.val();
            var prezimevr = lastname.val();
            var emailvr = email.val();
            var porukavr = tekstPolje.val();
            var id =  $("#id").val();
    
            $.ajax({
            url: "models/form/insertMessage.php",
            method: "post",
            data: {
            FirstName: imevr,
            LastName: prezimevr,
            Email: emailvr,
            Message: porukavr,
            id : id
            },
            success: function(data){
                alert(data);
                location.reload();
            },
            error: function(xhr, status, err){
                if(xhr.status == 400){
                    alert(xhr.responseJSON);
                }
            }
            });
           
        }
        else{
            valid.hide();
        }
}
