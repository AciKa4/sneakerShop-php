<?php
include "models/entryStatistics.php";
?>
<h2 class="my-4 text-center"> Number of visitors in last 24h : <p><?=$brElemenata?></p> </h2>

<h2 class="my-4 text-center"> Visited pages in percentage </h2>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Home</th>
      <th scope="col">Store</th>
      <th scope="col">Contact</th>
      <th scope="col">Author</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?=round($home*100/$brElemenata,2)?> %</td>
      <td><?=round($prodavnica*100/$brElemenata,2)?> %</td>
      <td><?=round($kontakt*100/$brElemenata,2)?> %</td>
      <td><?=round($autor*100/$brElemenata,2)?> %</td>
    </tr>
  </tbody>
</table>

<table class="table mt-5 text-center">
  <thead>
    <tr>
      <th scope="col">Admin</th>
      <th scope="col">Login</th>
      <th scope="col">Registration</th>
      <th scope="col">Cart</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td><?=round($admin*100/$brElemenata,2)?> %</td>
      <td><?=round($login*100/$brElemenata,2)?> %</td>
      <td><?=round($registracija*100/$brElemenata,2)?> %</td>
      <td><?=round($korpa*100/$brElemenata,2)?> %</td>
    </tr>
  </tbody>
</table>