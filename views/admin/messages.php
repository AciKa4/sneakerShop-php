<?php 
include "models/form/getMessages.php";
?>
  <div class="container-xl-fluid  w-75 ml-4">
   <div class="table-responsive-lg  table-responsive-sm table-responsive-md ">  
   <?php if(count($poruke) == 0) {?>
         <h1 class="text-center py-5"> No message to display</h1>
    <?php
        } else{?>  
   <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">idUser</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Email</th>
        <th scope="col">Message</th>
        <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody> 
    <?php 
            foreach($poruke as $poruka): ?>
                <tr>
                <th scope="row"><?=$poruka -> idKorisnika?></th>
                <td><?=$poruka -> ime?></td>
                <td><?=$poruka -> prezime?></td>
                <td><?=$poruka -> email?></td>
                <td><?=$poruka -> opis?></td>
                <td><a href="models/form/deleteMessage.php?id=<?=$poruka -> id?>" class="delmess">Remove message
                </tr>
                <?php endforeach;  }?>
    </tbody>
    </table>

    </div>
   
   </div>