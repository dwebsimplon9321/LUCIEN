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
<main>
  <div class="titre">
    <hr>
        <h2 class="middle">Ajouter nouveau jour férié pour l'année <?php echo date("Y");  ?></h2>
          <hr>
    </div>
  <div id="booking" class="">
    <div class="section-center">
      <div class="container">
        <div class="row">
          <div class="col">
            <p>Ajouter <strong>UNIQUEMENT</strong> les jours supplémentaires de la Guadeloupe.</p>
            <p>Exemple :  </p>
            <form method="POST" action="https://<?php echo $_SERVER["SERVER_NAME"]; ?>/valid.php" class="needs-validation" novalidate> 
              <div class="mb-3">
                    <label for="jour" class="form-label">Le label du jour férié</label>
                    <input type="text" class="form-control" id="jour" placeholder="indiquer le label du jour férié" name="label" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Choisir la date du jour férié</label>
                    <input type="date" class="form-control" id="date" placeholder="Choisir une date" name="date" required>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary" type="submit" name="btc" value="adj">Ajouter</button>
              </div>

                
            </form>    
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="titre">
    <hr>
        <h2 class="middle">Liste des jours fériés local</h2>
          <hr>
    </div>
  <div class="container">
        <div class="row">
            <div class="col">
            <?php    
              $rows = $app->liste_ferie();
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Année</th>
                  <th scope="col">Label</th>
                  <th scope="col">Date</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($rows as $row)
                  {
                ?>
                <tr>
                  <td><?php echo $row["id"];  ?></td>
                  <td><?php $annee = new DateTime($row["nouvelleDate"]); echo $annee->format('Y');  ?></td>
                  <td><?php echo $row["label"]  ?></td>
                  <td><?php $date = new DateTime($row["nouvelleDate"]); echo $date->format('d-m-Y'); ?></td>
                  <td><a href="#" title="" class="btn btn-danger btn-sm">Supprimer </a> </td>
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
<style>
/* ====================== JOURS FERIES ====================== */


 .container  table {
	background: var(--color-white);
	width: 100%;
	border-radius: var(--card-border-radius);
	padding: var(--card-padding);
	text-align: center;
	box-shadow: var(--box-shadow);
	transition: all 300ms ease;
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

/* ====================== FIN JOURS FERIES ====================== */

</style>

<?php
  include("includes/footer.php");

} else {
    # pas connecte / pas bon profil
    /* Ceci produira une erreur. Notez la sortie ci-dessus,
    * qui se trouve avant l'appel à la fonction header() */
    header('Location: https://'.$_SERVER["SERVER_NAME"].'/');
    exit;

}
