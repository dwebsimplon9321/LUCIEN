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
    <link rel="stylesheet"  media="screen" type="text/css" href="/css/index.css" />
  <!-- DEMANDE ET RECAP-->
  <div id="ember274" class="ember-view">  <div id="ember350" class="ember-view"><div class="bg-heading-list in-blue">
<div class="bg-heading">
  <div id="ember351" class="ember-view"><div class="quick-apply-timeoff">
<div class="timeoff-clock-icon">
  <i class="icon-timeoff"></i>
</div>
<div class="relative">
  <div class="size-16 mb15">Time Off (Quick Apply)</div>
      <div>
        <i class="icon-checkbox vertical-align"></i>
        <span class="vertical-align-middle" data-test-id="leave-applied">Time Off has been applied!</span>
      </div>
          <div class="mt10">
      <button class="btn btn-link" data-test-id="apply-another-day" data-ember-action="" data-ember-action-401="401">Apply for Another Date</button>
    </div>
</div>
</div>

<!----></div>
</div>
<div class="bg-heading-body">
  <div id="ember352" class="ember-view"><div class="semi-bold size-16 mb20">
Time Off Balances
</div>
<div class="time-consumed-wrap">
  <div class="time-consumed-chart">
      <div data-test-id="leave-balance-type" id="ember404" class="mb15 ember-view">  <div class="timeoff-type ellipsis" title="Sick">
  <span style="background-color: #ED9A9B" id="ember405" class="leave-type-circle ember-view">
</span>
  Sick <!---->
</div>
<!---->  <div id="ember406" class="ember-view"><div id="ember407" class="progress-small vertical-align progress ember-view">  <div ariavaluemax="12" ariavaluemin="0" ariavaluenow="9" id="ember408" class="progress-bar progress-bar-default ember-view" style="width: 75%; background-color: rgb(237, 154, 155);">    <span class="sr-only">75%</span>

</div>

</div>  <div class="timeoff-consumed-container">
      <span class="timeoff-number" data-test-id="available-leave">9</span>
      <span class="text-muted pr5" data-test-id="available-text">Available</span>
          <span class="timeoff-number pl10 vertical-separator-common " data-test-id="consumed-leave">3</span>
    <span class="text-muted">Consumed</span>
<!---->  </div>
</div>
</div>
      <div data-test-id="leave-balance-type" id="ember410" class="mb15 ember-view">  <div class="timeoff-type ellipsis" title="Earned">
  <span style="background-color: #FEDF88" id="ember411" class="leave-type-circle ember-view">
</span>
  Earned <!---->
</div>
<!---->  <div id="ember412" class="ember-view"><div id="ember413" class="progress-small vertical-align progress ember-view">  <div ariavaluemax="36" ariavaluemin="0" ariavaluenow="22.5" id="ember414" class="progress-bar progress-bar-default ember-view" style="width: 62.5%; background-color: rgb(254, 223, 136);">    <span class="sr-only">63%</span>

</div>

</div>  <div class="timeoff-consumed-container">
      <span class="timeoff-number" data-test-id="available-leave">22.5</span>
      <span class="text-muted pr5" data-test-id="available-text">Available</span>
          <span class="timeoff-number pl10 vertical-separator-common " data-test-id="consumed-leave">13.5</span>
    <span class="text-muted">Consumed</span>
<!---->  </div>


</div>
</div>
    </div>
  </div>
</div>
</div>
</div>
</div>
  </div>


<main>
<div class="titre">
<hr>
    <h2 class="middle"> Formulaire d'Absence</h2>
      <hr>
</div>
<div class="container my-5">
  <button type="button" class="btn btn-primary btn-lg" onclick="show_hide()">Ajout d'absence</button>
</div>
<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
        <div class="booking-form" id="form2" style="display: contents;">

						<form id="formulaire" method="post" action="https://<?php echo $_SERVER["SERVER_NAME"]; ?>/validTempo.php" style="display: none;">
							<div class="row">
              <div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Raisons :</span>
										<select name="choix" class="form-control">
                    
                      <option selected hidden>Cliquez ici</option>
											<option>Malade</option>
											<option>Paternité</option>
											<option>Accident</option>

										</select>
										<span class="select-arrow" ></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Début :</span>
										<input class="form-control" type="date" name="date1"required>
									</div>
								</div>
                <div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Fin :</span>
										<input class="form-control" type="date" name="date2" required>
									</div>
								</div>
							</div>

              <div class="form-group shadow-textarea, col-md-6">
              <span class="form-label">Commentaire :</span>
              <textarea class="form-control" name="com" rows="3" placeholder="Ecrivez ici.." required maxlength="160"></textarea>
              </div>
              <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
              <span class="form-label">Rappel Alerte</span>
              
            </div>
              <div class="row">
								<div class="col-sm-2">
									<div class="form-btn">
                  <input type="hidden" name="personnel_id" value="<?php echo $_SESSION['id']  ?>">
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
<!-- TITRE -->
<div class="titre">
<hr>
    <h2 class="middle"> Récapitulatif des demandes </h2>
      <hr>
</div>
<!-- fin TITRE -->



<!-- TABLEAU RECAP-->
<div class="demande">
  <h2>Demandes Récentes :</h2>
  <div class="middle">
    <button type="button" class="btn btn-primary btn-lg" onclick="">Cliquez ici pour voir +</button>
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

</tbody>
</table>
</div>
<div class="bkcalendar">
  <?php include("includes/calendrier.php");  ?>
             

</div>
</main>

<?php 
}  # session
include("includes/footer.php"); 

?>