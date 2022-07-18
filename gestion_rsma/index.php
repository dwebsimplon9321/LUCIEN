
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
<!doctype html>
<html lang="fr">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/connexion.css">

                <title>Connexion</title>
</head>

<body>
    
                        <section class="vh-100">
             <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
                </div>

                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <img class="mb-4 logo" src="https://www.rsma.gp/templates/rsma_guadeloupe/images/logo_rsma.png" alt="logo">
                <h1 class="h2 mb-3 fw-bold mb-1">Connexion 🔓</h1>
                    <form method="POST" action="valid.php" class="needs-validation" novalidate>
                        <!-- @Email -->
                        <div class="form-outline mb-4">
                            <input type="email" id="floatingInput" class="form-control form-control-lg" placeholder="nom@example.com" name="email" required/>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-outline mb-4">
                            <input type="password" id="form1Example23" class="form-control form-control-lg" placeholder="motdepasse" name="passe" required/>
                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Validation -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked>
                                <label class="form-check-label" for="form1Example3"> Rester Connecter </label>
                            </div>
                            <a href="n_mpasse.php">Mot de Passe Oublié ?</a>
                        </div>

                        <!-- Envoyer -->
                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="btc" value="btc">Connexion</button>

                    </form>
                    <script>
                        (function() {
                            'use strict'
                            var forms = document.querySelectorAll('.needs-validation')
                            Array.prototype.slice.call(forms)
                                .forEach(function(form) {
                                    form.addEventListener('submit', function(event) {
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>