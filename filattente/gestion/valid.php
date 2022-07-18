<?php
session_start();

# afficher les erreurs php
ini_set('display_errors','1');


include("../classe/db_connect.php");
include("../classe/Gestion.php");


$myC = new Connect_pdo;

try {
    $myC->getConnectDB();

    //print_r($myC->getConnectDB());
    $db = $myC -> getConnectDB();

    # instancier mes classes
    $admin= new Gestion($db);


} catch(Exception $e){
    echo $e->getMessage(),"\n";
}



if( isset($_POST) ){
    $validation = $_POST["btc"];
} else {
    $validation = $_GET;
}

switch ($validation) {
    case 'btc':
        #

        break;

    case 'btp':
        #
        $admin->demander_npasse($_POST["email"]);

        break;
        
    case 'btt':
        $admin->demander_npasse($_POST["code"]);
        break;

    default:
        # code...
        break;
}