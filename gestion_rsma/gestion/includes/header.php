<!doctype html>
  <html lang="fr">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!-- Custom CSS --> 
    <link href="/css/menu.css" rel="stylesheet">
    <link rel="stylesheet"  media="screen" type="text/css" href="/css/index.css" />
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
   
    <!-- JE PENSE QU IL NE FAUT PAS TOUT METTRE LIRE LA DOC
     <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css">
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">
    <link rel="stylesheet" type="text/css" href="https://gestion.coatch-web.fr/gestion/includes/tui.calendar-master/dist/tui-calendar.css">
    <link rel="stylesheet" type="text/css" href="https://gestion.coatch-web.fr/gestion/includes/tui.calendar-master/examples/css/default.css">
    <link rel="stylesheet" type="text/css" href="https://gestion.coatch-web.fr/gestion/includes/tui.calendar-master/examples/css/icons.css">
    --> 

    <title>Tableau de bord - Gestion d'absences</title>
  </head>

  <body >
 
  <header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand bg-light navbar-dark sticky-top px-4 py-0">
      <a href="https://gestion.coatch-web.fr/"><img src="/image/logo_rsma.png" alt="#" class="rsma" style="width:150px;padding:10px"></a>
      <a class="navbar-brand" href="https://<?php echo $_SERVER["SERVER_NAME"];  ?>/gestion/">RSMA - Tableau de bord</a>
      <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-bell me-lg-2"></i>
            <span class="d-none d-lg-inline-flex">Notifications</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
            <a href="#" class="dropdown-item">
              <h6 class="fw-normal mb-0">Exemple</h6>
              <small>Il y a 15 minutes</small> 
            </a>
            <hr class="dropdown-divider">
            <a href="#" class="dropdown-item">
              <h6 class="fw-normal mb-0">Demande envoyée</h6>
              <small>Il y a 15 minutes</small>
            </a>
            <hr class="dropdown-divider">
            <a href="#" class="dropdown-item">
              <h6 class="fw-normal mb-0">Mot de Passe modifié</h6>
              <small>Il y a 15 minutes</small>
            </a>
          </div>
        </div>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img class="rounded-circle me-lg-2" src="https://zupimages.net/up/22/22/7cwo.png" alt="" style="width: 25px; height: 25px;">
            <span class="d-none d-lg-inline-flex"><?php echo isset($_SESSION["nom"], $_SESSION["prenom"] ) ? $_SESSION["nom"]." ".$_SESSION["prenom"] : ""; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
            <a href="/" class="dropdown-item">Déconnexion</a>
          </div>
        </div>
      </div>
    </nav>
    <style> 
  .bg-secondary {
    background-color: white !important;
    border-radius: 10px !important;
  }

  
  </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <?php 
  if($_SESSION["prof"] === "adrh" || $_SESSION["prof"] === "supa")
  {
    include("menu.php");
  }
  ?>
  </header>
  