<?php 

class Gestion
{

    # propriete privee
    private $_DBC;  # dbconnect - objet PDO
    private $_email;
    private $_passe;

    private $_msgPHPM;
    private $_message;

    private $_nom;




    # methodes
    public function __construct($db, $sendM)
    {
        $this->set_DBC($db);

        # timezone America/Guadeloupe
        date_default_timezone_set('America/Guadeloupe');

        $this->set_msgPHPM($sendM);

        $this->set_nom("ambrosio");
        
    }


    public function connecter(array $datas)
    {

        $this->set_email($datas["email"]);
        $this->set_passe($datas["passe"]);

        # requete selection
       /* $req = "SELECT * FROM users WHERE login_rsma = '".$this->get_email()."' OR login_intra = '".$this->get_email()."'";
        $resultat = $this->get_DBC()->query($req); */

        $req = "SELECT * 
        FROM users
        INNER JOIN personnel ON personnel.id = users.personnel_id
        INNER JOIN profils_users ON user_id = users.id
        INNER JOIN profils ON profils.id = profils_users.profil_id 
        WHERE login_rsma = '".$this->get_email()."' OR login_intra = '".$this->get_email()."'
        "; 
        $resultat = $this->get_DBC()->query($req);
        
        
        $row = $resultat->fetch(PDO::FETCH_ASSOC);

        //print_r($row);

        # verif passe
        if (password_verify($this->get_passe(), $row["password"])) {
            echo 'Le mot de passe est valide !';

            if( $row["code"] === "adrh")
            {
                $_SESSION["prof"] = $row["code"];
                $_SESSION["id"] = $row["personnel_id"];
                $_SESSION["nom"] = $row["nom"];
                $_SESSION["prenom"] = $row["prenom"];

                /* Ceci produira une erreur. Notez la sortie ci-dessus,
                * qui se trouve avant l'appel à la fonction header() */
                header('Location: https://'.$_SERVER["SERVER_NAME"].'/gestion/');
                exit;


            } else if( $row["code"] === "supa" ) {
                # redirection supa

                $_SESSION["prof"] = $row["code"];
                $_SESSION["id"] = $row["personnel_id"];
                $_SESSION["nom"] = $row["nom"];
                $_SESSION["prenom"] = $row["prenom"];

                /* Ceci produira une erreur. Notez la sortie ci-dessus,
                * qui se trouve avant l'appel à la fonction header() */
                header('Location: https://'.$_SERVER["SERVER_NAME"].'/gestion/tab_admin.php');
                exit;


            } else {

                # redirection personnel civil
                $_SESSION["prof"] = $row["code"];
                $_SESSION["id"] = $row["personnel_id"];
                $_SESSION["nom"] = $row["nom"];
                $_SESSION["prenom"] = $row["prenom"];

                /* Ceci produira une erreur. Notez la sortie ci-dessus,
                * qui se trouve avant l'appel à la fonction header() */
                header('Location: https://'.$_SERVER["SERVER_NAME"].'/gestion/');
                exit;
            }

        } else {
            //echo 'Le mot de passe est invalide.';

            /* Ceci produira une erreur. Notez la sortie ci-dessus,
            * qui se trouve avant l'appel à la fonction header() */
            header('Location: https://'.$_SERVER["HTTP_HOST"].'/n_mpasse.php');
            exit;
        }

    }

    public function nouveau_passe(string $email)
    {
        $this->set_email($email);

        # requete selection
        $req = "SELECT * FROM users WHERE login_rsma = '".$this->get_email()."' OR login_intra = '".$this->get_email()."'";
        $resultat = $this->get_DBC()->query($req);

        $row = $resultat->fetch(PDO::FETCH_ASSOC);

        # generer mot de passe
        $this->set_passe($this->generateur_passe());

        $newPass = password_hash($this->get_passe(), PASSWORD_DEFAULT);

        # mise a jour mot de passe dans table users
        $reqU = "UPDATE users set password = '".$newPass."' 
        WHERE login_rsma = '".$this->get_email()."' OR login_intra = '".$this->get_email()."'";

        $resultatU = $this->get_DBC()->query($reqU);
        //print_r($resultatU);

        # envoyer email avec mot de passe
        $msg = "Bonjour, \n Voici le nouveau mot de passe pour vous connecter à votre application de demande d'absence. \n";
        $msg .= "Pour vous connecter utiliser le mot de passe suivant : \n";
        $msg .= "\n";
        $msg .= "".$this->get_passe()."\n";
        $msg .= "\n";
        $msg .= "Voici l'url pour vous connecter à votre espace. \n";
        $msg .= "https://".$_SERVER["HTTP_HOST"]."/gestion/"."\n" ;
        $msg .= "Votre webmaster vous remercie.";
        $this->set_message(nl2br($msg));   # convertis les retour à la ligne

        $this->envoi_email();

    }

    public function envoi_email()
    {
        //print_r($this->get_msgPHPM());

        $this->get_msgPHPM()->setFrom('webmaster@coatch-web.fr');
        $this->get_msgPHPM()->addAddress($this->get_email(), "");     // Add a recipient


        $this->get_msgPHPM()->isHTML(true);                                  // Set email format to HTML
        $this->get_msgPHPM()->Subject = "Votre nouveau mot de passe.";
        $this->get_msgPHPM()->Body = $this->get_message();
        $this->get_msgPHPM()->AltBody = $this->get_message();

        //$this->get_msgPHPM()->send();
        //echo 'Message has been sent';

        if($this->get_msgPHPM()->send())
        {
            /* Ceci produira une erreur. Notez la sortie ci-dessus,
            * qui se trouve avant l'appel à la fonction header() */
            header('Location: https://'.$_SERVER["SERVER_NAME"].'/gestion/');
            exit;
        }
    }


    public function generateur_passe()
    {
        $chaine = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789&#@%~*";
        $chaine = str_shuffle($chaine);

        $p = str_split($chaine, 10);
        $index = rand(0, 5);

        return $p[$index];
    }



    # getter / setter



    /**
     * Get the value of _DBC
     */ 
    public function get_DBC()
    {
        return $this->_DBC;
    }

    /**
     * Set the value of _DBC
     *
     * @return  self
     */ 
    public function set_DBC($_DBC)
    {
        $this->_DBC = $_DBC;

        return $this;
    }

    /**
     * Get the value of _email
     */ 
    public function get_email()
    {
        return $this->_email;
    }

    /**
     * Set the value of _email
     *
     * @return  self
     */ 
    public function set_email($_email)
    {
        $this->_email = $_email;

        return $this;
    }

    /**
     * Get the value of _passe
     */ 
    public function get_passe()
    {
        return $this->_passe;
    }

    /**
     * Set the value of _passe
     *
     * @return  self
     */ 
    public function set_passe($_passe)
    {
        $this->_passe = $_passe;

        return $this;
    }

    /**
     * Get the value of _msgPHPM
     */ 
    public function get_msgPHPM()
    {
        return $this->_msgPHPM;
    }

    /**
     * Set the value of _msgPHPM
     *
     * @return  self
     */ 
    public function set_msgPHPM($_msgPHPM)
    {
        $this->_msgPHPM = $_msgPHPM;

        return $this;
    }

    /**
     * Get the value of _message
     */ 
    public function get_message()
    {
        return $this->_message;
    }

    /**
     * Set the value of _message
     *
     * @return  self
     */ 
    public function set_message($_message)
    {
        $this->_message = $_message;

        return $this;
    }

    /**
     * Get the value of _nom
     */ 
    public function get_nom()
    {
        return $this->_nom;
    }

    /**
     * Set the value of _nom
     *
     * @return  self
     */ 
    public function set_nom($_nom)
    {
        $this->_nom = $_nom;

        return $this;
    }
}