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
        <h2 class="middle">Fiche du personnel</h2>
        <hr>
      </div>
      
      <div class="container">
        <div class="row">
          <div class="col">
            <nav class="nav">
            <a class="nav-link active" aria-current="page" href="/gestion/">Accueil</a>
            <i class="bi bi-arrow-right-short"></i>
            <a class="nav-link click" href="/gestion/liste_personnel.php">Liste du personnel</a>
          </nav>
          </div>
        </div>
      </div>
      <style> 
      .nav-link.click {
        padding-bottom:10px; }
        .nav-link.active {
          padding-bottom: 10px;
        }
        i.bi.bi-arrow-right-short {
          padding-top: 10px;
        }
    </style>

      <div class="container">
        <div class="row">
            <div class="col">
            <?php    
                
                $row = $app->fiche($_GET["id"]);
                //print_r($row);

                if($row === FALSE)
                {
                  # pas de résultat
                  /* Ceci produira une erreur. Notez la sortie ci-dessus,
                  * qui se trouve avant l'appel à la fonction header() */
                  header('Location: https://'.$_SERVER["SERVER_NAME"].'/gestion/liste_personnel.php');
                  exit;

                } else {
                ?>
                <form action="#" method="post" novalidate>
                  <h3>Contact et login de connexion</h3>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="email" class="form-control" placeholder="Adresse email" aria-label="login_rsma" aria-describedby="login_rsma" name="email1" value="<?php echo $row["login_rsma"];   ?>" readonly required>
                    <input type="email" class="form-control" placeholder="Adresse email" aria-label="login_intra" aria-describedby="login_intra" name="email2" value="<?php echo $row["login_intra"];   ?>" readonly required>
                  </div>

                  <hr>

                  <h3>Information personnel</h3>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nom" aria-label="Nom" aria-describedby="Nom" name="nom" value="<?php echo $row["nom"];   ?>" readonly required>
                    <input type="text" class="form-control" placeholder="Prénom" aria-label="Prénom" aria-describedby="Prénom" name="prenom" value="<?php echo $row["prenom"];   ?>" readonly required>
                  </div>
                  <div class="input-group mb-3">
                    <input type="tel" class="form-control" placeholder="Téléphone" aria-label="Téléphone" aria-describedby="Téléphone" name="telephone" value="<?php echo $row["telephone"];   ?>" readonly required>
                    <input type="text" class="form-control" placeholder="Status" aria-label="Status" aria-describedby="Status" name="status" value="<?php echo $row["status"];   ?>" readonly required>
                  </div>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Ancienneté" aria-label="Ancienneté" aria-describedby="Ancienneté" name="anciennete" value="<?php echo $row["anciennete"];   ?>" readonly required>
        
                  </div>
                  <hr>

                  <h3>Nombres de jours d'absences disponible au <?php echo date("Y-m-d H:i:s");  ?></h3>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Reliquat" aria-label="Reliquat" aria-describedby="Reliquat" name="reliquat" value="<?php echo $row["reliquat"];   ?>" readonly required>
                    <input type="text" class="form-control" placeholder="Congé" aria-label="Congé" aria-describedby="Congé" name="jour_n" value="<?php echo $row["jour_n"];   ?>" readonly required>
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="RTT" aria-label="RTT" aria-describedby="RTT" name="rtt" value="<?php echo $row["rtt"];   ?>" readonly required>
                    <input type="text" class="form-control" placeholder="RTT Employeur" aria-label="RTT Employeur" aria-describedby="RTT Employeur" name="rtt_employeur" value="<?php echo $row["rtt_employeur"];   ?>" readonly required>
                  </div>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nombre jours déjà pris" aria-label="Déjà pris" aria-describedby="Déjà pris" name="nbr_pris" value="<?php echo $row["nbr_pris"];   ?>" readonly required>
        
                  </div>
                  <hr>
                  <div class="col-auto">
                    <input type="hidden" class="form-control" placeholder="personnel_id" aria-label="personnel_id" aria-describedby="personnel_id" name="id" value="<?php echo $row["personnel_id"];   ?>" readonly required>
                    <button type="submit" class="btn btn-primary mb-3">Modifier</button>
                  </div>
                </form>
                <?php 
                  }
                ?>
              
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

exit;
