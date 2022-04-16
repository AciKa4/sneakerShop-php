<?php 

 require_once "config/connection.php";

?>

<div class="container-xl-fluid  w-75 ml-4">
<div class="table-responsive-lg  table-responsive-sm table-responsive-md "> 
    <h2 class="text-center mt-4"> Users in last 24h:</h2>
   <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">idUser</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">email</th>
        </tr>
    </thead>
    <tbody> 
    <?php
        $file = file(LOGIN_USERS);
        $ids = [];
        
        foreach($file as $row){

            $day = 60*60*24;
            $values = explode("\t",$row);
            $idUser = $values[0];
            $timeUser = trim($values[1]);

            if(!in_array($idUser,$ids) && time() - $timeUser <= $day){
                array_push($ids,$idUser);
            }
        }
        

        foreach($ids as $id):
            $user = getUser($id);
            if($user):
    ?>
                <tr>
                <th scope="row"><?= $user -> id?></th>
                <td><?= $user -> ime?></td>
                <td><?= $user -> prezime?></td>
                <td><?= $user -> email?></td>
                </tr>
          <?php endif; endforeach; ?>
    </tbody>
    </table>

    </div>
   
   </div>