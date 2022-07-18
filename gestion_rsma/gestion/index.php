<?php 
session_start();

if(!isset($_SESSION["prof"]) == "perc")
{
    # pas connecte
    /* Ceci produira une erreur. Notez la sortie ci-dessus,
    * qui se trouve avant l'appel à la fonction header() */
    header('Location: https://'.$_SERVER["SERVER_NAME"].'/');
    exit;

} else {
  include("includes/header.php");

?>
    
    

    <!-- Custom Style -->
    <style>
      #more {display: none;}
    </style>
        <link rel="stylesheet"  media="screen" type="text/css" href="/css/index.css" />
     

  <!-- DEMANDE ET RECAP-->


<main>
<div class="titre">
<hr>
    <h2 class="middle"> Formulaire d'Absence</h2>
      <hr>
</div>

<div class="container my-5">
  <button type="button" class="btn btn-primary btn-lg" onclick="show_hide()">Ajout d'absence</button>
  <div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
        <div class="booking-form" id="form2" style="display: contents;">

						<form id="formulaire" method="post" action="https://<?php echo $_SERVER["SERVER_NAME"]; ?>/valid.php" style="display: none;">
							<div class="row">
              <div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Raisons :</span>
										<select name="choix" class="form-control">
                    
                      <option selected hidden>Cliquez ici</option>
											<option value="900">Auto d'Absence</option>
											<option value="901">Permissions</option>
											<option value="902">Arret Maladie</option>
                      <option value="903">Missions</option>
                      <option value="904">Stage</option>
                      <option value="905">ARTT</option>
                      <option value="906">Exceptionnel</option>
                      <option value="907">QL</option>
                      <option value="908">1/2 MATIN ARTT</option>
                      <option value="909">1/2 APRES-MIDI ARTT</option>
                      <option value="910">1/2 MATIN PERM</option>
                      <option value="911">1/2 APRES-MIDI PERM</option>
                      <option value="912">ACCIDENT TRAVAIL</option>
                      <option value="913">RECUPERATION</option>


										</select>
										<span class="select-arrow" ></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Début :</span>
										<input class="form-control" type="datetime-local" name="date_dbt" value="date_debut" required>
									</div>
								</div>
                <div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Fin :</span>
										<input class="form-control" type="datetime-local" name="date_fn" value="date_fin" required>
									</div>
								</div>
							</div>

              <div class="form-group shadow-textarea, col-md-6">
              <span class="form-label">Commentaire :</span>
              <textarea class="form-control" name="com" rows="3" placeholder="Ecrivez ici.." maxlength="160"></textarea>
              </div>
              <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
              <span class="form-label">Rappel Alerte</span>
              
            </div>
              <div class="row">
								<div class="col-sm-2">
									<div class="form-btn">
                  <input type="hidden" name="personnel_id" value="<?php echo $_SESSION['id'];  ?>">
                  <button class="btn btn-primary" type="submit" name="btc" value="Ok">Envoyer</button>
										
									</div>
								</div>
								<div class="col-sm">
									<div class="form-btn">
                    
                    <button class="btn btn-danger" type="reset" value="Reset">Annuler</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
      </div>
    </div>
</div>
</div>
<style>
hr:not([size]) {
  border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}
 </style>

<div class="recap">
  <?php include("includes/recap.php");   ?>
</div>

<div class="bkcalendar">
  <?php  include("includes/calendrier.php");  ?>
</div>


</div>
</main>

<?php 
}  # session
include("includes/footer.php");

?>