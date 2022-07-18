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
        <h2 class="middle"> Liste du personnel civil</h2>
        <hr>
      </div>

      <div class="container">
        <div class="row">
            <div class="col">
            <?php    
              $rows = $app->personnels();
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">NOM</th>
                  <th scope="col">Prénom</th>
                  <th scope="col">Téléphone</th>
                  <th scope="col">Status</th>
                  <th scope="col">Ancienneté</th>
                  <th scope="col">Actions</th>
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
                  <td><?php echo $row["telephone"];   ?></td>
                  <td><?php echo $row["status"];   ?></td>
                  <td><?php echo $row["anciennete"];   ?></td>
                  <td><a href="https://<?php echo $_SERVER['SERVER_NAME'] ; ?>/gestion/fiche_personnel.php?id=<?php echo $row["id"]; ?>" title="Modifier la fiche " class="btn btn-primary btn-sm">Modifier </a> <a href="#" title="Supprimer la fiche" class="btn btn-danger btn-sm">Supprimer </a>
                  <a href="https://<?php echo $_SERVER['SERVER_NAME'] ; ?>/gestion/fiche_personnel.php?id=<?php echo $row["id"]; ?>" title="Supprimer la fiche" class="btn btn-success btn-sm">Afficher plus </a></td>
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
<style>
/* ====================== PROFILS ====================== */


 .container  table {
	background: var(--color-white);
	width: 100%;
	border-radius: var(--card-border-radius);
	padding: var(--card-padding);
	text-align: center;
	box-shadow: var(--box-shadow);
	transition: all 300ms ease;
  margin-top: 70px;
}

 .container table:hover {
	box-shadow: none;
}

 table tbody td{
	height: 2.8rem;
	border-bottom: 1px solid var(--color-light);
	color: var(--color-dark-variant);
}

 table tbody tr:last-child td {
	border: none;
}


table {
border-collapse: unset;
}

hr:not([size]) {
  border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}

/* ====================== FIN PROFILS ====================== */

</style>