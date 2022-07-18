<?php 
/**
 * FICHIER EXEMPLE
 */
class Inscription
{
    # propriete
    private $_DBC;  # dbconnect - objet PDO
    private $_email;
    private $_passe;



    # methode
    public function __construct($db)
    {
        $this->set_DBC($db);

        # timezone America/Guadeloupe
        date_default_timezone_set('America/Guadeloupe');

        
    }

    public function change_passe(array $datas)
    {
        print_r($datas);
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
}