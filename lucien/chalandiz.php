<?php

session_start();

unset($_SESSION[""]);

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/chalandiz.css">

    <title>Chalandiz - inscription</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 gauche">
                <img src="#" alt="decoration">
            </div>
            <div class="col-md-6">
                <form action="">
                <div class="mb-3">
                    <label for="" class="form-label">Dans quelle commune souhaitez-vous faire de l'e-commerce ?</label>
                    <div class="listeC" role="group" aria-label="">
                        <button type="button" class="btn btn-primary btComm">Les Abymes</button>
                        <button type="button" class="btn btn-primary btComm">Anse-Bertrand</button>
                        <button type="button" class="btn btn-primary btComm">Baie-Mahault</button>
                        <button type="button" class="btn btn-primary btComm">Baillif</button>
                        <button type="button" class="btn btn-primary btComm">Bouillante</button>
                        <button type="button" class="btn btn-primary btComm">Capesterre-Belle-Eau</button>
                        <button type="button" class="btn btn-primary btComm">Capesterre-de-Marie-Galante</button>
                        <button type="button" class="btn btn-primary btComm">Deshaies</button>
                        <button type="button" class="btn btn-primary btComm">La Désirade</button>
                        <button type="button" class="btn btn-primary btComm">Le Gosier</button>
                        <button type="button" class="btn btn-primary btComm">Gourbeyre</button>
                        <button type="button" class="btn btn-primary btComm">Goyave</button>
                        <button type="button" class="btn btn-primary btComm">Grand-Bourg</button>
                        <button type="button" class="btn btn-primary btComm">Lamentin</button>
                        <button type="button" class="btn btn-primary btComm">Morne-à-l'Eau</button>
                        <button type="button" class="btn btn-primary btComm">Le Moule</button>
                        <button type="button" class="btn btn-primary btComm">Petit-Bourg</button>
                        <button type="button" class="btn btn-primary btComm">Petit-Canal</button>
                        <button type="button" class="btn btn-primary btComm">Pointe-à-Pitre</button>
                        <button type="button" class="btn btn-primary btComm">Pointe-Noire</button>
                        <button type="button" class="btn btn-primary btComm">Port-Louis</button>
                        <button type="button" class="btn btn-primary btComm">Saint-Claude</button>
                        <button type="button" class="btn btn-primary btComm">Saint-François</button>
                        <button type="button" class="btn btn-primary btComm">Saint-Louis</button>
                        <button type="button" class="btn btn-primary btComm">Sainte-Anne</button>
                        <button type="button" class="btn btn-primary btComm">Sainte-Rose</button>
                        <button type="button" class="btn btn-primary btComm">Terre-de-Bas</button>
                        <button type="button" class="btn btn-primary btComm">Terre-de-Haut</button>
                        <button type="button" class="btn btn-primary btComm">Trois-Rivières</button>
                        <button type="button" class="btn btn-primary btComm">Vieux-Fort</button>
                        <button type="button" class="btn btn-primary btComm">Vieux-Habitants</button>
                        <button type="button" class="btn btn-primary btComm">Basse-Terre</button>
                       
                        
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label"></label>
                    <p>Vous devez choisir un maximum de 5 communes</p>    
                   <div class="reponse">

                   </div>


                </div>
                <div class="hidden"></div>
                <button type="button" class="btn btn-primary" disabled>Précédent</button>
                <button type="button" class="btn btn-primary">Suivant</button>

                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/js/chalandiz.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>