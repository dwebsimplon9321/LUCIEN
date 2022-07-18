<?php 
# autoloader
include("autoloader.php");

$id = $_SESSION['id'] !== '' ? $_SESSION['id'] : '';

# instanciation classe
$app = new Application($db);
$rows = $app->liste_absence($id);

//print_r($rows);

?>

<!-- TITRE -->
<div class="titre">
<hr>
    <h2 class="middle"> Récapitulatif des demandes </h2>
      <hr>
</div>
<!-- fin TITRE -->



<!-- TABLEAU RECAP-->
<div class="demande">
  <div class="middleb">
    <button type="button" class="btn btn-primary btn-lg dm">Demandes Récentes : <br><h6>Cliquez ici pour voir +</h6></br></button>
</div>
  <table> 
    <thead>
      <tr>
        <th>Congés :</th>
        <th>Demandé le :</th>
        <th>Etats :</th>
</tr>
</thead>
<tbody>
    <?php 
        foreach($rows as $row)
        {
 ?>
    <tr>
        <td><?= $row["type"];   ?></td>
        <td><?php $date = new DateTime($row["date_demande"]); echo $date->format('d-m-Y'); ?></td>
        <td class="warning"><?= $row["etat"];  ?></td>
    </tr>
 
 <?php

        } // end foreach
    ?>
  <tr>
    <td>Vacance</td>
    <td>01/04/22</td>
    <td class="warning">En Attente</td>
  </tr>
  <tr>
    <td>Permission</td>
    <td>24/02/22</td>
    <td class="danger">Refuser</td>
  </tr>
  <tr>
    <td>Paternité</td>
    <td>31/12/21</td>
    <td class="valid">Accepter</td>
  </tr>
  <tr>
    <td>Urgence(Familial)</td>
    <td>29/08/21</td>
    <td class="valid">Accepter</td>
  </tr>
    <tr>
            <td>Vacance</td>
            <td>15/04/21</td>
            <td class="danger">Refuser</td>
          </tr>
          <tr>
            <td>Vacance</td>
            <td>15/04/21</td>
            <td class="danger">Refuser</td>
          </tr>

</tbody>
</table>