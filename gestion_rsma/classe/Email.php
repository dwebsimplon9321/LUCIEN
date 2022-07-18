<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$chemin = $_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php";
require($chemin);

$phpMailer = new PHPMailer(true);

try {

    // config server
    //$phpMailer->SMTPDebug = SMTP::DEBUG_SERVER;                          // Enable verbose debug output
    $phpMailer->isSMTP();
    $phpMailer->Host       = 'mail32.lwspanel.com';                                   // Set the SMTP server to send through
    $phpMailer->SMTPAuth   = TRUE;                                         // Enable SMTP authentication
    $phpMailer->Username   = 'webmaster@coatch-web.fr';                         // SMTP username
    $phpMailer->Password   = 'gW1@SUb57T';                                // SMTP password
    $phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $phpMailer->Port       = 587;  // TCP port to connect to

    return $phpMailer;
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$phpMailer->ErrorInfo}";

} 