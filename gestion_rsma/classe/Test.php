<?php

include("Email.php");

class Test
{
    # propriete
    private $_nom;
    private $_prenom;
    private $_email;

    private $_message;

    private $_msgPHPM;





    # methode
    public function __construct($db, $phpMailer)
    {
        # timezone America/Guadeloupe
        date_default_timezone_set('America/Guadeloupe');

        $this->set_msgPHPM($phpMailer);
    }


    public function envoi_email()
    {
        $this->set_nom("AMBROSIO");
        $this->set_prenom("Martine");
        $this->set_email("martine.ambrosio@gmail.com");

        $this->set_message("Message Test");


        # envoi email test
        $this->get_msgPHPM()->setFrom('webmaster@coatch-web.fr');
        $this->get_msgPHPM()->addAddress($this->get_email(), $this->get_nom());     // Add a recipient


        $this->get_msgPHPM()->isHTML(false);                                  // Set email format to HTML
        $this->get_msgPHPM()->Subject = "Test envoi email";
        $this->get_msgPHPM()->Body = $this->get_message();
        $this->get_msgPHPM()->AltBody = $this->get_message();

        $this->get_msgPHPM()->send();
        echo 'Message has been sent';

        //print_r($this->get_msgPHPM());
        

    }




    # getter / setter



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

    /**
     * Get the value of _prenom
     */ 
    public function get_prenom()
    {
        return $this->_prenom;
    }

    /**
     * Set the value of _prenom
     *
     * @return  self
     */ 
    public function set_prenom($_prenom)
    {
        $this->_prenom = $_prenom;

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
}

# test
$test = new Test("", $phpMailer);
$test->envoi_email();