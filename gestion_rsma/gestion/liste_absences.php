<?php 
session_start();

if($_SESSION["prof"] === "adrh" || $_SESSION["prof"] === "supa")
{
    # chargement page
    include("includes/header.php");

    # autoloader
    include("includes/autoloader.php");

    # instanciation classe
    $app = new Application($db);
    ?>
<div class="dashboard">
    <main>
      <div class="titre">
        <hr>
        <h2 class="middle"> Liste des absences</h2>
        <hr>
      </div>
      
      <!-- TITRE -->
      <div class="titre">
        <hr>
        <h2 class="middle"> Titre</h2>
        <hr>
      </div>

      <!-- fin TITRE -->
      <div class="container">
        <div class="row">
          <div class="col">
            <nav class="nav">
            <a class="nav-link active" aria-current="page" href="/gestion/">Accueil</a>
            <a class="nav-link click" href="/gestion/liste_absences.php">Liste des demandes d'absences</a>
          </nav>
          </div>
        </div>
      </div>






      <div class="container">
        <div class="row">
            <div class="col">
            <?php    
              $rows = $app->absences();

              print_r($rows);
            ?>
            <table class="table" style="text-align: center;">
              <thead>
                <tr>
                  <th scope="col">NOM</th>
                  <th scope="col">Prénom</th>
                  <th scope="col">Date de la demande</th>
                  <th scope="col">Type de demande</th>
                  <th scope="col">Début</th>
                  <th scope="col">Fin</th>
                  <th scope="col">Nombre de jours</th>
                  <th scope="col">Etat de la demande</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($rows as $row)
                  {
                ?>
                <tr>
                  <td><?php echo $row["nom"];   ?></td>
                  <td><?php echo $row["prenom"];   ?></td>
                  <td><?php $date = new DateTime($row["date_demande"]); echo $date->format('d-m-Y'); ?></td>
                  <td><span style="background-color: <?php echo $row["couleur"]; ?> ; color:black; width: auto; display: block; padding: 10px; font-weight: bolder;"><?php echo $row["type"];   ?></span></td>
                  <td><?php $date = new DateTime($row["date_debut"]); echo $date->format('d-m-Y'); ?></td>
                  <td><?php $date = new DateTime($row["date_fin"]); echo $date->format('d-m-Y'); ?></td>
                  <td><?php echo $row["nbr_jours"];   ?></td>
                  <td><?php echo $row["etat"];   ?></td>
                  <td><a href="#" title="Valider la demande" class="btn btn-primary btn-sm">A valider </a> </td>
                </tr>
                <?php
                  }

                ?>
              </tbody>
            </table>    
            </div>
        </div>

      </div>


    </main>

  </div>
  <style> 
hr:not([size]) {
  border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}</style>
<?php 
    include("includes/footer.php");

} else {
    # pas connecte / pas bon profil

    /* Ceci produira une erreur. Notez la sortie ci-dessus,
    * qui se trouve avant l'appel à la fonction header() */
    header('Location: https://'.$_SERVER["SERVER_NAME"].'/');
    exit;
}
?>
