<?php
session_start();

if ($_SESSION["prof"] === "adrh" || $_SESSION["prof"] === "supa") {
  # chargement page
  include("includes/header.php");

  # autoloader
  include("includes/autoloader.php");

  
  $m = isset($_GET["mois"]) ? $_GET["mois"] : date("n");
  $y = isset($_GET["annee"]) ? $_GET["annee"] : date("Y");

  # instanciation classe
  $calendrier = new Calendrier($db, $m, $y);
  $absence = new Absence($db);

  //$premierJour = $calendrier->firstDayInMonth()->modify("last monday"); # précédent lundi // probleme quand lundi est un 1er
  $premierJour = $calendrier->firstDayInMonth();

  # condition ternaire
  $premierJour = $premierJour->format('N') === "1" ? $premierJour : $calendrier->firstDayInMonth()->modify("last monday");


?>
  <style>
    table.mcalendar {
      text-align: center !important;
      border-collapse: collapse;
      
    }
    table.mcalendar tbody tr th {
      padding: 15px;
    }
    table.mcalendar tbody tr td {
      padding: 10px;
      width: 14.29%; /* 100%/7j */
     /* height: calc(100vh - 485.04px);  100vh = 100% hauteur de la fenetre - 485.04px (hauteur des autres elements avant table)   */
     height: 100px !important;
      line-height: 2.5;
    }
    table.mcalendar-6-weeks tbody tr td {
      height: 16.66% !important;
    }
    table.mcalendar tbody tr td.jourAutreMois {
      color: #B5E9FF !important;
    }
    table.mcalendar tbody tr th {
      padding: 10px;
      width: 14.29%; /* 100%/7j */
      height: 100px !important;
      line-height: 5;
    }
    table.mcalendar tbody tr:last-child td {
      border: 1px solid var(--color-light);
    }
    table.mcalendar tbody tr td > span {
      width: 100%;
      display: inline-block;
      line-height: 2 !important;
      font-size: .7em;
    }

    .bg-g {
      background-color: #DCDCDC !important;
      color: #696969 !important;
      
    }
    .jour {
      font-size: 1.2em;
    }

  </style>
  <main>
    <div class="titre">
      <hr>
      
      <div class="d-flex flex-row items-align-center justify-content-between mx-sm-3">
        <h2 class="middle"><?php echo $calendrier->afficher_mois(); ?></h2>
        <div>
          <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/gestion/ma_cal_test.php?mois=<?php echo $calendrier->moisPrecedent(); ?>" class="btn btn-primary">&lt;</a>
          <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/gestion/ma_cal_test.php?mois=<?php echo $calendrier->moisSuivant(); ?>" class="btn btn-primary">&gt;</a>
        </div>
      </div>
      <hr>
    </div>

    <?php
        $allWeeks =  $calendrier->getWeeks();


        $dernierJour = (clone $premierJour)->modify('+'.(6 + 7 * ($allWeeks - 1)).' days'); // 

       $alls = $absence->demande_absence_par_Jour($premierJour, $dernierJour);

       /* echo "<pre>";
        print_r($alls);
        echo "</pre>";*/

    ?>
    <h3>Calendrier temporaire manque les jours fériés.</h3>
    <table class="table table-bordered mcalendar mcalendar-<?php echo $allWeeks;  ?>-weeks">
      <tr>
      <?php 
        foreach ($calendrier->semaine as $key => $jour) :

          if($jour === "Samedi" || $jour === "Dimanche") :
            ?>
          <th class="bg-g ">
            <div class="semaine"><?php echo $jour; ?></div>
          </th>
            <?php
          else :

            ?>
          <th class="table-success">
            <div class="semaine"><?php echo $jour; ?></div>
          </th>
            <?php
          endif;

        endforeach;
      ?>
      </tr>
      <?php
      

      for ($i = 0; $i < $allWeeks; $i++) :
      ?>

        <tr>
          <?php
            foreach ($calendrier->semaine as $key => $jour) : # propriete public $semaine
              $date = (clone $premierJour)->modify("+".($key + $i * 7) ."days");

              $absencesJour = $alls[$date->format('Y-m-d')] ?? []; // si pas defini prend tableau vide

              if($jour === "Samedi" || $jour === "Dimanche")
              {
                /**
                 * $key = index correspondant à la semaine
                 * $i = boucle
                 * * 7 = fois 7 jours
                 * !! priorite multiplication donc 7 * 0, 7 * 1, etc...
                 * ex : 0 + (0 * 7) = 0
                 * ex : 1 + (0 * 7) = 1
                 * ex : 2 + (0 * 7) = 2
                 * ex : 3 + (0 * 7) = 3
                 * ex : 4 + (0 * 7) = 4
                 * ex : 5 + (0 * 7) = 5
                 * ex : 6 + (0 * 7) = 6
                 * ex : 0 + (1 * 7) = 7
                 */
                ?>
                <td class="bg-g <?php echo $calendrier->withInMonth($date)? '': 'jourAutreMois'; ?>"><div class="jour"><?php echo $date->format('d'); ?></div></td>
                <?php

              } else {
                
              ?>

              <td class="<?php echo $calendrier->withInMonth($date)? '': 'jourAutreMois'; ?>">
                <div class="jour"><?php echo $date->format('d'); ?></div>
                <?php 
                foreach($absencesJour as $absenceJour)
                {

                  if($absenceJour["personnel_id"] === "52")
                  {
                    //print_r($absenceJour);
                  ?>
                    <span class="ab" style="background-color:<?php echo $absenceJour["couleur"]; ?> ;"><?php echo  $absenceJour["type"]; ?></span>
                  <?php
                  }

                } // fin foreach

                ?>
              </td>

              <?php
              } // fin else
          ?>
           
          <?php
            endforeach;
          ?>
        </tr>
      <?php
      endfor;
      ?>
    </table>

  </main>

<?php
  include("includes/footer.php");
} else {
  # pas connecte / pas bon profil
  /* Ceci produira une erreur. Notez la sortie ci-dessus,
    * qui se trouve avant l'appel à la fonction header() */
  header('Location: https://' . $_SERVER["SERVER_NAME"] . '/');
  exit;
}
