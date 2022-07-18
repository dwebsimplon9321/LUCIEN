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
      <h2 class="middle">Titre</h2>
        <hr>
  </div>
  <div id="booking" class="section">
    <div class="section-center">
      <div class="container">
        <div class="row">
          <div class="col">
          
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php
  include("includes/footer.php");

} else {
    # pas connecte / pas bon profil
    /* Ceci produira une erreur. Notez la sortie ci-dessus,
    * qui se trouve avant l'appel à la fonction header() */
    header('Location: https://'.$_SERVER["SERVER_NAME"].'/');
    exit;

}