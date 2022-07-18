


<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

include("classe/db_connect.php");
$myC = new Connect_pdo; 

include("classe/Email.php");

include("classe/Gestion.php");
include("classe/Admin.php");
include("classe/Agent.php");

try {

    //print_r($myC->getConnectDB());
    $db = $myC->getConnectDB();


    # instancier mes classes
    $gestion = new Gestion($db, $phpMailer);
    $admin = new Admin($db, $phpMailer);
    $agent = new Agent($db, $phpMailer);

} catch(Exception $e){
    echo $e->getMessage(), "\n";
}

//print_r($_POST);


if(isset($_POST["btc"]))
{
    $action = $_POST["btc"];

} else {
    # $_GET

}

switch ($action) {
    case 'btc':
        # se connecter
        //echo "connecter";
        $gestion->connecter($_POST);
        break;

    case 'btv':
        # nouveau mot de passe
        //echo "nouveau passe";
        $gestion->nouveau_passe($_POST["email"]);
        break;

    case 'bta':
        $admin->inscription($_POST);
        break;

    case 'Ok':
        $agent->absence($_POST);
        break;
    default:
        # code...
        break;
}
