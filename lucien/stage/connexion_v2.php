<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/stage/connexion.css">

    <title>Connexion</title>
  </head>
  <body>
        <div class="container">
            <div class="row">
                <form method="POST" action="valid.php" class="needs-validation" novalidate>
                    <div class="row en_tete">
                        <div class="col">

                        </div>
                        <div class="col">
                            <img class="mb-4 logo" src="https://www.rsma.gp/templates/rsma_guadeloupe/images/logo_rsma.png" alt="logo">
                            <h1 class="h3 mb-3 fw-normal">Connexion</h1>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="passe" required>
                                <label for="floatingPassword">Mot de passe</label>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <div class="row cb_b">
                        <div class="col-4">

                        </div>
                        <div class="col-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                                <label class="form-check-label" for="inlineCheckbox1">Rester connecter</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="w-40 btn btn-lg btn-primary btc" type="submit" name="btc" value="btc">Connexion</button>
                        </div>
                        <div class="col-4">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            <p class="mt-5 mb-3 text-muted"><a href="Nouveau_mp.html">Mot de passe oublié ?</a></p>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                  </form>                               
            </div>

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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>











