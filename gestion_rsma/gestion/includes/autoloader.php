<?php 
 # afficher les erreurs php
 ini_set('display_errors', '1');

 # autoloader
 spl_autoload_register(function ($class) {
   include $_SERVER["DOCUMENT_ROOT"].'/classe/' . $class . '.php';
 });

 include $_SERVER["DOCUMENT_ROOT"].'/classe/db_connect.php';
 $myC = new Connect_pdo;
 $db = $myC->getConnectDB();