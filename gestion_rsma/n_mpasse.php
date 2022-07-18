
<?php
// Initialisation de la session.
// Si vous utilisez un autre nom
// session_name("autrenom")
session_start();

// Détruit toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, on détruit la session.
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
  <!-- Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mot de passe oublié</title>


    <!-- Theme-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </head>
  <style>
                                * {
                                font-family: poppins, sans-serif;
                            background-color: rgb(211, 211, 211);
                                }
                                .btn.btn-primary.btn-lg.btn-block {
                                    margin-top: 7px;
                                    margin-left: 215px;
                                    
                                }
                                .text-center.mt-2 {
                                    margin-left: 190px;
                                    margin-top: 20px !important;
                                }
                                .img-fluid{
                                    margin-top: -155px;
                                    max-width: 100%;
                                }
                            </style>

    <section class="vh-100">

             <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/pages/reset-password-v2.svg" class="img-fluid" alt="xPhone image">
                </div>

                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <img class="mb-4 logo" src="https://www.rsma.gp/templates/rsma_guadeloupe/images/logo_rsma.png" alt="logo">
                <h2 class="h2 mb-3 fw-bold mb-1">Mot De Passe Oublié ? 🔒</h2>
                  <p class="card-text mb-2">Entrez votre email, vous ne l'avez pas reçu ? Vérifier vos spams</p>
                  <form class="auth-forgot-password-form mt-2" method="POST" action="valid.php">
                    <div class="mb-1">
                      <input type="email" class="form-control form-control-lg" placeholder="nom@example.com" name="email" required/>
                    </div>
                    <p class="text-center mt-2"><a href="https://gestion.coatch-web.fr/index.php"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>Retour à la page connexion </a></p>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="btc" value="btv">Valider</button>
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
    </section>
    <footer>
    
            <div class="copyright">
              <p><small>Copyright 2019. All Rights Reserved.</small></p>
            </div>
  </footer>
    <!-- END: Content-->
  </body>
  <!-- END: Body-->
</html>
