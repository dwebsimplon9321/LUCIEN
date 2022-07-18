<?php 

class Adherant
{
    #propriete
    private $_nomA;
    private $_prenom;
    private $_naissanceA;
    private $_email;

    private $_nom; // nom du chien
    private $_affixe;
    private $_race;
    private $_naissance; // date naissance du chien
    private $_sexe;
    private $_identification;
    private $_lof;
    private $_ct;
    private $_fapac;







    # methodes
    public function __construct()
    {
        # definir timezone Guadeloupe
        date_default_timezone_set('America/Guadeloupe');
        
    }

    public function adhesion(array $datas, $fichiers)
    {
        # path server web
        $path = $_SERVER["DOCUMENT_ROOT"]."/adherants/";

        # deplacer dans dossier adherants
        //chdir($path); // pas obligatoire

        # adherant
        $nomC = $this->nettoyer($datas["nomA"]);

        // couper chaine pour 150 caracteres uniquement
        $nomC = strtoupper(trim(substr($nomC,0, 150)));
        $this->set_nomA($nomC);

        $prenomC = $this->nettoyer($datas["prenom"]);

        // couper chaine pour 100 caracteres uniquement
        $prenomC = trim(ucfirst(substr($prenomC,0, 100)));
        $this->set_prenom($prenomC);

        $this->set_naissanceA($datas["naissanceA"]);

        // couper chaine pour 300 caracteres uniquement
        $emailC = substr($datas["email"],0, 300);
        $emailC = trim(strtolower($emailC));
        $this->set_email($emailC);

        # formatage dossier
        $dateI = date("Y-m-d");  //2022-04-11

        # nom du dossier adherant
        //$dossier = $nomC."_".$prenomC."_".$dateI;  // NOM_Prenom_2022-04-11
        $dossier = $this->get_nomA()."_".$this->get_prenom()."_".$this->get_naissanceA();

        # creer dossier de l'adherant
        if(  @mkdir($path.$dossier, 0777) )
        {
            # securiser dossier
            touch($path.$dossier."/index.html");

            # dossier du/des chiens

            # nom dossier pour le/les chiens
            $nbrChiens = count($datas["nom"]);

            for($i=0; $i < $nbrChiens; $i++)
            {
                $this->addDirectory($datas["nom"][$i], $datas["identification"][$i], $path.$dossier);
            }

        } else {
            # dossier existe
            echo "dossier existe";

            # nom dossier pour le/les chiens
            $nbrChiens = count($datas["nom"]);

            #boucle pour le nombres de chiens
            for($i=0; $i < $nbrChiens; $i++)
            {
                #verifier si dossier existe pour le/les chiens

                $reponse = $this->addDirectory($datas["nom"][$i], $datas["identification"][$i], $path.$dossier);

                if($reponse != true)
                {


                    # compte les documents
                    $nbrD = count($fichiers['document']['name']);

                    # boucle pour le nombre de documents
                    for($d=0; $d < $nbrD; $d++)
                    {
                        # traitement erreurs fichiers
                        if ($_fichiers['document']['error'][$d] === UPLOAD_ERR_OK) {
                            print_r($fichiers);

                            # chemin du dossier du/des chiens
                            $dossC = $path.$dossier."/".$this->get_identification();
                            

                            # deplacer fichiers dans dossier du/des chiens
                            $this->addFilesForDogs($dossC, $fichiers['document']["tmp_name"][$d], $fichiers["document"]["name"][$d]);
    
                        } else {
                            print_r($_fichier['document']['error'][$d]);
                        }
                    }
                }
            }

        }

        //print_r($_SERVER);



        exit;


        print_r($fichiers["document"]);

        $nbrD = count($fichiers);

        $dossierP = "/var/www/xxxxx/adherants/pako";

        for($c=0; $c < $nbrD; $c++)
        {
            $erreur = $fichiers["document"]["error"][0];

            if($erreur === 0)
            {
                echo $erreur;

                $type = $fichiers["document"]["type"][0];

                if($type === "image/jpeg")
                {
                    $nomFile = $fichiers["document"]["tmp_name"][0];
                    $nomFichierFinal = $fichiers["document"]["name"][0];

                    # deplacer fichier dans dossier pako exemple
                    move_uploaded_file($nomFile, $dossierP."/".$nomFichierFinal);
                }

            }

        }


    }

    public function addDirectory(string $dogName, string $dogID, string $directoryAD)
    {

        # nom dossier pour le/les chiens
        $this->set_nom(strtoupper(trim(substr($this->nettoyer($dogName),0, 10))));
        $this->set_identification(trim(substr($this->nettoyerBis($dogID), 0, 15)));

            # dossier du/des chiens
            $dossierC = $this->get_nom()."_".$this->get_identification();

            #verifier si dossier existe
            if( @mkdir($directoryAD."/".$dossierC, 0777) )
            {
                 # securiser dossier
                touch($directoryAD."/".$dossierC."/index.html");

                return true;
            } else {
                echo "Le dossier pour votre chien existe déjà.";
                return false;
            }

0

           

    }


    public function addFilesForDogs($dossierC)
    {
        print_r($fichiersVO);

        # deplacer fichier dans dossier pako exemple
        move_uploaded_file($fichiers, $dossierP."/".$nomFichierFinal);
    }




    /**
     * nettoyage caracteres speciaux et chiffres
     */
    public function nettoyer($data)
    {

        // formatage des donnees
        $resultat = htmlentities(htmlspecialchars(strip_tags($data)));

        # recherche caractere speciaux et chiffres et remplace par vide
        $pattern = '/[0-9#-&;,.:!()={}]/i';
        $replacement = '';
        $dataFin = preg_replace($pattern, $replacement, $resultat);

        # retourner (afficher) chaine de caractere nettoyer et securise
        return $dataFin;

    }

    /**
     * nettoyage caracteres speciaux et alphabtique
     */
    public function nettoyerBis($data)
    {
        // formatage des donnees
        $resultat = htmlentities(htmlspecialchars(strip_tags($data)));

        # recherche caractere speciaux et chiffres et remplace par vide
        $pattern = '/[a-zA-Z#-&;,.:!()={}]/i';
        $replacement = '';
        $dataFin = preg_replace($pattern, $replacement, $resultat);

        # retourner (afficher) chaine de caractere nettoyer et securise
        return $dataFin;
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
     * Get the value of _affixe
     */ 
    public function get_affixe()
    {
        return $this->_affixe;
    }

    /**
     * Set the value of _affixe
     *
     * @return  self
     */ 
    public function set_affixe($_affixe)
    {
        $this->_affixe = $_affixe;

        return $this;
    }

    /**
     * Get the value of _race
     */ 
    public function get_race()
    {
        return $this->_race;
    }

    /**
     * Set the value of _race
     *
     * @return  self
     */ 
    public function set_race($_race)
    {
        $this->_race = $_race;

        return $this;
    }

    /**
     * Get the value of _naissance
     */ 
    public function get_naissance()
    {
        return $this->_naissance;
    }

    /**
     * Set the value of _naissance
     *
     * @return  self
     */ 
    public function set_naissance($_naissance)
    {
        $this->_naissance = $_naissance;

        return $this;
    }

    /**
     * Get the value of _sexe
     */ 
    public function get_sexe()
    {
        return $this->_sexe;
    }

    /**
     * Set the value of _sexe
     *
     * @return  self
     */ 
    public function set_sexe($_sexe)
    {
        $this->_sexe = $_sexe;

        return $this;
    }

    /**
     * Get the value of _identification
     */ 
    public function get_identification()
    {
        return $this->_identification;
    }

    /**
     * Set the value of _identification
     *
     * @return  self
     */ 
    public function set_identification($_identification)
    {
        $this->_identification = $_identification;

        return $this;
    }

    /**
     * Get the value of _lof
     */ 
    public function get_lof()
    {
        return $this->_lof;
    }

    /**
     * Set the value of _lof
     *
     * @return  self
     */ 
    public function set_lof($_lof)
    {
        $this->_lof = $_lof;

        return $this;
    }

    /**
     * Get the value of _ct
     */ 
    public function get_ct()
    {
        return $this->_ct;
    }

    /**
     * Set the value of _ct
     *
     * @return  self
     */ 
    public function set_ct($_ct)
    {
        $this->_ct = $_ct;

        return $this;
    }

    /**
     * Get the value of _fapac
     */ 
    public function get_fapac()
    {
        return $this->_fapac;
    }

    /**
     * Set the value of _fapac
     *
     * @return  self
     */ 
    public function set_fapac($_fapac)
    {
        $this->_fapac = $_fapac;

        return $this;
    }

    /**
     * Get the value of _nomA
     */ 
    public function get_nomA()
    {
        return $this->_nomA;
    }

    /**
     * Set the value of _nomA
     *
     * @return  self
     */ 
    public function set_nomA($_nomA)
    {
        $this->_nomA = $_nomA;

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
}