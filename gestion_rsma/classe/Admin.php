<?php 

class Admin extends Gestion
{

    # propriete privee
    private $_DBC;  # dbconnect - objet PDO
    private $_nom;
    private $_prenom;
    private $_email1;
    private $_email2;








    # methodes
    

    public function inscription(array $datas)
    {
        
       

        //$this->set_nom($this->nettoyer($datas["nom"]));

        

        $_nom = $this->set_nom($this->nettoyer($datas["nom"]));      // $this->get_nom(); pour afficher le nom  // mettre en majuscule
        $_nom = mb_strtoupper($datas["nom"]);

        $_prenom = $this->set_nom($this->nettoyer($datas["prenom"]));
        $_prenom = ucfirst($datas['prenom']);

        $_email1 = $this->set_email1($datas["email1"]);                    // mettre en minuscule
        $_email1 = strtolower($datas["email1"]);

        $_email2 = $this->set_email2($datas["email2"]);                    // mettre en minuscule
        $_email2 = strtolower($datas["email2"]);

        $sql = "INSERT INTO personnel (nom, prenom) VALUES ('".$_nom."', '".$_prenom."')";
        $resultat = $this->get_DBC()->query($sql);

        $newID = $this->get_DBC()->lastInsertId();
        echo $newID;

        // id du personnel   # ref lastid()

        $sql = "INSERT INTO users (personnel_id, login_rsma, login_intra) VALUES ('".$newID."' , '".$_email1."', '".$_email2."')";
        $resultat = $this->get_DBC()->query($sql);

        $this->nouveau_passe($_email1);

        /* Ceci produira une erreur. Notez la sortie ci-dessus,
        * qui se trouve avant l'appel à la fonction header() */
        header('Location: https://'.$_SERVER["SERVER_NAME"].'/confirme.php');
        exit;
    
    }




    public function nettoyer($data)
    {

        // formatage des donnees
        $resultat = htmlentities(htmlspecialchars(strip_tags(addslashes($data))));

        # recherche caractere speciaux et chiffres et remplace par vide
        $pattern = '/[0-9#-&;,.:!()={}]/i';
        $replacement = '';
        $dataFin = preg_replace($pattern, $replacement, $resultat);

        # retourner (afficher) chaine de caractere nettoyer et securise
        return $dataFin;

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
     * Get the value of _email1
     */ 
    public function get_email1()
    {
        return $this->_email1;
    }

    /**
     * Set the value of _email1
     *
     * @return  self
     */ 
    public function set_email1($_email1)
    {
        $this->_email1 = $_email1;

        return $this;
    }

    /**
     * Get the value of _email2
     */ 
    public function get_email2()
    {
        return $this->_email2;
    }

    /**
     * Set the value of _email2
     *
     * @return  self
     */ 
    public function set_email2($_email2)
    {
        $this->_email2 = $_email2;

        return $this;
    }
}