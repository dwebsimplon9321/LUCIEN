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
<style>
    /* ====================== FICHE PERSO ====================== */

main .fiche {
	margin-top: 2rem;

}

main .fiche  h2 {
	margin-bottom: 0.8em;
}

main .fiche .section-centerr {
	background: var(--color-white);
	border-radius: var(--card-border-radius);
	padding: var(--card-padding);
	text-align: center;
	box-shadow: var(--box-shadow);
	transition: all 300ms ease;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 70px;
}

main .fiche .section-centerr:hover {
	box-shadow: none;
}


.section-centerr {
border-collapse: unset;
}
.container {
    padding-top: 20px;
    padding-bottom: 10px;
}
div.col-2 {
    padding-top: 20px;
}
.btn {
    border-radius: 6px;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
    border-bottom-left-radius: 6px;
}

hr:not([size]) {
  border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}

/* ====================== FIN FICHE PERSO ====================== */
    </style>
<main>
    <div class="fiche">
  <div class="titre">
  <hr>
      <h2 class="middle">Ajouter une fiche personnel</h2>
        <hr>
  </div>
  <main>
  <div id="booking" class="section">
    <div class="section-centerr">
      <div class="container">
        <div class="row">
          <div class="col">
          <form method="POST" action="https://<?php echo $_SERVER["SERVER_NAME"]; ?>/valid.php" class="needs-validation" novalidate> 
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="LUCIEN" name="nom" required>
                                    <label for="floatingInput">Nom</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Rosario" name="prenom" required>
                                    <label for="floatingInput">Prénom</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email1" required>
                                    <label for="floatingInput">Email RSMA</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email2" required>
                                    <label for="floatingInput">Email intradef</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                            </div>
                            <div class="col-2">
                                <button class="w-40 btn btn-lg btn-primary btc" type="submit" name="btc" value="bta">Ajouter</button>
                            </div>
                        </div>

                </form>    
                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function () {
                    'use strict'

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.querySelectorAll('.needs-validation')

                    // Loop over them and prevent submission
                    Array.prototype.slice.call(forms)
                        .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                        })
                    })()
                </script>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </main>

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