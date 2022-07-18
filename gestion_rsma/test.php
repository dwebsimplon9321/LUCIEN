<?php 



$to      = 'savannah75@gmail.com';
     $subject = 'Test';
     $message = 'Bonjour !';
     $headers = 'From: webmaster@coatch-web.fr' . "\r\n" .
     'Reply-To: webmaster@coatch-web.fr' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     

     if( mail($to, $subject, $message, $headers))
     {
        echo "envoi ok";

     } else {
        echo "envoi non ok";
     }